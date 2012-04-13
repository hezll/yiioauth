<?php
//namespace components;
//
//use potato\tools\webservice\oauth\Store;
//use potato\tools\webservice\oauth\credential\Consumer;
//use potato\tools\webservice\oauth\credential\Token;
//use components\oauth\Api;
//use potato\Config;
//use models\User;
//use models\Site;
//use models\SiteUser;
//use models\UserRemote;
//use models\ConsumerToken;
//use potato\Error;
//use potato\error\HttpException;

abstract class Oauth
{
    protected $_api;

    protected $_api_type;
    protected $_api_version;  //版本号 3.14   by hzl
    protected static $_store;
    public static function call($name, $params = array(), $token = array(), $rawdata = false,$api_version = '')
    {
        list ($type, $identify, $name) = self::parseApiName($name);//区别平台
        $class_name = 'components\oauth\\' . ucfirst(strtolower($type));
        $oauth = new $class_name; 
        $oauth->_api_version = $api_version;//   3.14 hzl
        $response = $oauth->api($name, $identify)->request($params, $token, $rawdata);//添加版本号参数
        if ($rawdata === false && $response['status'] === false)
        {
            $error = $oauth->getApi()->getError();
            if ($error === Api::ERROR_TOKEN)
            {
                $oauth->getApi()->loginRequired($identify);
            }
            elseif ($error === Api::ERROR_API_LIMIT)
            {
                throw new Error('接口调用超过限制');
            }
        }
        return $response;
    }

    /**
     * 实例化并返回Api对象
     *
     * @param type $name
     * @param type $identify
     * @return components\oauth\Api
     */
    public function api($name, $identify)
    {
        $class_name = 'components\oauth\\' . strtolower($this->_api_type) . '\\' . ucfirst(strtolower($name));
        $api = new $class_name;
        $api->setBaseUri($identify,$this->_api_version);
        $api->init();
        return $this->_api = $api;
    }

    /**
     * 返回Api对象
     *
     * @return components\oauth\Api
     */
    public function getApi()
    {
        return $this->_api;
    }

    public static function initOauthLogin($access_token, $by)
    {
        $by = strtolower($by);
        // 远端网站用户信息 (ID, 昵称, 头像)
        $remote_uinfo = Oauth::call('weibo.' . $by . '.verifycredentials');
        if(!$remote_uinfo['status'])
        {
            $msg = $remote_uinfo['message'];
             throw new HttpException(400,$msg);
        }
        if (empty($remote_uinfo['content']['id']))
        {
            throw new Error('获取用户信息失败');
        }
        $remote_uinfo = $remote_uinfo['content'];
        $remote_uinfo['platform'] = $by;

        $consumer_key = self::getOAuthConsumerKey($by);
        $consumer_token_mapper = new ConsumerToken;
        // 根据 consumer_key 和 token 获取本地已存 token
        $local_token = $consumer_token_mapper->first(array(
            'consumer_key' => $consumer_key,
            'token' => $access_token->getToken(),
            'version' => $access_token->getVersion(),    
        ));
        $transaction = $consumer_token_mapper->adapter()->beginTransaction();

        // init local user token
        $user_mapper = new User;
        $user_transaction = $user_mapper->adapter()->beginTransaction();
        $site_user_mapper = new SiteUser;

        if (!user()->is_guest)
        {
            $do = 'bind';
            $user = $user_mapper->get(user()->id);

            // 不允许匿名用户继续绑定
            if (empty($user->username))
            {
                throw new HttpException(403, '请使用本站帐号登录或先注册本站帐号');
                return false;
            }
        }
        else
        {
            $do = 'login';
        }

        // 未在本站登录过或 access token 已更改的或token碰撞了
        if ($local_token === false || $local_token->remote_uid != $remote_uinfo['id'])
        {
            // 根据 consumer_key 和远程用户 ID 获取本地用户/Site ID
            $local_id = $consumer_token_mapper->first(array(
                'consumer_key' => $consumer_key,
                'remote_uid' => $remote_uinfo['id'],
                 'version' => $access_token->getVersion(),    
            ));
            if ($local_id === false) // 未在本站登录过的, 初始化本地用户
            {
                if ($local_token !== false) // 未在本站登录过, 但其token存在, 但远程用户不一致(token碰撞), 需清空原token
                {
                    $local_token->token = '';
                    $local_token->token_secret = '';              
                    if ($consumer_token_mapper->save($local_token) === false)
                    {
                        $transaction->rollBack();
                        throw new Error('清除错误绑定失败');
                        return false;
                    }
                }
                $consumer_token = $consumer_token_mapper->get();
                $consumer_token->type = User::TYPE_NORMAL;
                if ($do == 'login')
                {
                    $user = $user_mapper->get();
                    $user->nickname = $remote_uinfo['screen_name'];
                    $user->created = time();
                    $user->type = User::TYPE_NORMAL;
                    if ($user_mapper->save($user) == false)
                    {
                        $transaction->rollBack();
                        $user_transaction->rollBack();
                        throw new Error('初始化用户失败');
                        return false;
                    }
                    $consumer_token->local_id = $user->id;
                }
                else
                {
                    if ($user->type == User::TYPE_COMPANY)
                    {
                        $consumer_token->type = User::TYPE_COMPANY;
                        $site_user = $site_user_mapper->first(array(
                            'user_id' => user()->id,
                        ));
                        $consumer_token->local_id = $site_user->site_id;
                    }
                    else
                    {
                        $consumer_token->local_id = $user->id;
                    }
                }
            }
            else // 登录过但 access token 已更改用户 ($local_id !== false && $local_token === false)
            {
                $consumer_token = $local_token;
                if ($do == 'login')
                {
                    $user = $consumer_token_mapper->getUserByToken($local_id);
                }
                else
                {
                    // 清理已绑定的匿名用户并更新关联
                    $consumer_token = self::clearUser($user, $consumer_token, $user_mapper);
                }
            }

            $consumer_token->consumer_key = $consumer_key;
            $consumer_token->remote_uid = $remote_uinfo['id'];
            $consumer_token->platform = $by;
            $consumer_token->token = $access_token->getToken();
            $consumer_token->token_secret = $access_token->getSecret();
            $consumer_token->expires_in = $access_token->getExpiresIn()+time();
            $consumer_token->version = $access_token->getVersion();
            $consumer_token->status = 0;
            $consumer_token->timestamp = time();

            if ($consumer_token_mapper->save($consumer_token) === false)
            {
                $transaction->rollBack();
                $user_transaction->rollBack();
                throw new Error('用户绑定失败');
                return false;
            }
        }
        else
        {
            $consumer_token = $local_token;
            if ($do == 'login')
            {
                $user = $consumer_token_mapper->getUserByToken($consumer_token);
            }
            else
            {
                // 清理已绑定的匿名用户并更新关联
                $consumer_token = self::clearUser($user, $consumer_token, $user_mapper);
                if ($consumer_token->status == ConsumerToken::STATUS_INACTIVE)
                {
                    $consumer_token->status = ConsumerToken::STATUS_NORMAL;
                    $consumer_token->timestamp = time();
                }

                if ($consumer_token_mapper->save($consumer_token) === false)
                {
                    $transaction->rollBack();
                    $user_transaction->rollBack();
                    throw new Error('设置绑定类型失败');
                    return false;
                }
            }
        }
        $user_transaction->commit();
        $transaction->commit();

        // 更新远程用户缓存信息
        $user_remote_mapper = new UserRemote;
        $user_remote_mapper->updateInfo($remote_uinfo);

        if (user()->is_guest)
        {
            $identity = new OauthUserIdentity($remote_uinfo['screen_name'], null);
            $identity->setId($user->id);
            $identity->setState('username',empty($user->username)?false:$user->username);

            $identity->setState('status', $user->status);
            if (User::isCompanyUser($user) === true)
            {
                $identity->setState('site_id', $consumer_token->local_id);
                // site user return to site index, closed temporarily, lostsnow@2011-12-12
                //user()->setReturnUrl(Site::route($consumer_token->local_id));
            }
            else
            {
                $identity->setState('site_id', 0);
            }
            if ($user->status == User::STATUS_LOCKED)
            {
                throw new Error('您的帐户已经被锁定, 请联系管理员');
                return false;
            }
            elseif ($user->status == User::STATUS_DELETED)
            {
                throw new Error('您的帐户已经被删除, 请联系管理员');
                return false;
            }

            $duration = 3600 * 24 * 30 * 12; // 360 days
            user()->login($identity, $duration);
        }
    }

    public static function clearUser($user, $token, $user_mapper)
    {
        // 当前登录用户为普通用户
        $user_type = $user_mapper->getUserType($user);
        $user_transaction = $user_mapper->adapter()->getCurrentTransaction();
        if ($user_type === User::TYPE_NORMAL)
        {
            if ($token->type == User::TYPE_NORMAL)
            {
                // token 被匿名绑定过, 清理掉, 这里不存在重复匿名绑定情形(已禁止匿名多账户绑定)
                if (user()->id != $token->local_id)
                {
                    if ($user_mapper->delete(array('id' => $token->local_id)) === false)
                    {
                        $user_transaction->rollBack();
                        throw new Error('清理用户失败');
                        return false;
                    }
                    $token->local_id = user()->id;
                }
            }
            // 此token 为企业 token
            else
            {
                throw new Error('此用户已经被绑定');
                return false;
            }
        }
        // 当前登录用户为企业主帐号
        else if ($user_type === User::TYPE_COMPANY)
        {
            $site = $user_mapper->getSite($user);
            if ($token->type == User::TYPE_NORMAL)
            {
                // token 被匿名绑定过, 清理掉
                if ($user_mapper->delete(array('id' => $token->local_id)) === false)
                {
                    $user_transaction->rollBack();
                    throw new Error('清理用户失败');
                    return false;
                }
                $token->local_id = $site->id;
                $token->type = User::TYPE_COMPANY;
            }
            // 此token 为企业 token
            else
            {
                if ($token->local_id != $site->id)
                {
                    throw new Error('该账户已被其他用户绑定过');
                    return false;
                }
            }
        }
        else // 无此用户或企业附属用户, 不允许绑定.
        {
            throw new HttpException(403, '没有权限绑定');
            return false;
        }

        return $token;
    }

    public static function parseApiName($name)
    {
        $name_arr = explode('.', $name, 3);
        if (count($name_arr) === 2)
        {
            $type = 'weibo';
            $identify = $name_arr[0];
            $name = $name_arr[1];
        }
        elseif (count($name_arr) < 2)
        {
            throw new Error('API解析错误');
        }
        else
        {
            $type = $name_arr[0];
            $identify = $name_arr[1];
            $name = $name_arr[2];
        }

        return array($type, $identify, $name);
    }

    public static function store()
    {
        if (!self::$_store)
        {
            self::$_store = Store::instance('db');
        }
        return self::$_store;
    }

    public static function getOAuthConsumerKey($by)
    {
        $consumer = Config::get('webservice.oauth.' . $by . '.consumer');
        if (!empty($consumer) && is_array($consumer))
        {
            return key($consumer);
        }
        else
        {
            throw new Error('无效的API标识');
        }
    }

    public static function getConsumer($consumer_key, $platform)
    {
        $consumer_secret = Config::get('webservice.oauth.' . $platform . '.consumer.' . $consumer_key);
        if (empty($consumer_secret))
        {
            throw new Error('无效的Consumer');
        }
        return new Consumer($consumer_key, $consumer_secret);
    }
}
