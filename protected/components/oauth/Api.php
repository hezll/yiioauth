<?php
namespace components\oauth;

use components\Oauth;
use potato\tools\webservice\oauth\credential\Consumer;
use potato\tools\webservice\oauth\credential\Token;
use potato\tools\webservice\oauth\request\Client;
use potato\tools\webservice\oauth\Store;
use potato\Config;
use potato\Error;
use components\spider\Helper;
abstract class Api
{
    const ERROR_UNKNOWN = 11100;
    const ERROR_TOKEN = 11101;
    const ERROR_API_LIMIT = 11102;

    /**
     * API 返回的数据格式 (json|xml)
     * @var string
     */
    protected $_format = 'json';

    /**
     * API HTTP 请求方式 (get|post)
     * @var string
     */
    protected $_method = 'get';

    /**
     * API 是否需要认证
     * @var bool
     */
    protected $_auth = true;

    /**
     * 当前API标识, 标识目标网站/应用 (sina|sohu|qq)
     * @var string
     */
    protected $_identify;

    /**
     * API 请求基础 URI
     * @var string
     */
    protected $_base_uri;

    protected $_token;
    /**
     * API 请求完整 URL
     * @var string
     */
    protected $_url;

    /**
     * API 基础 URI 汇总
     * @var array
     */
    protected $_apis = array(
        'sina' => array(
           '1' => 'http://api.t.sina.com.cn',
           '2' => 'https://api.weibo.com/2',
        ),
        'sohu' => array(
           '1' => 'http://api.t.sohu.com',
        ),
        'qq' => array(
           '1' => 'http://open.t.qq.com/api',
        ),
    );

    /**
     * API 的请求 path 汇总, 不含 base uri 及 format 信息
     * 此值必须在子类中进行定义
     * @var string
     */
    protected $_api_uris;

    /**
     * API 请求附带参数
     * @var array
     */
    protected $_params = array();

    /**
     * token验证失败是否自动跳转登录
     * @var boolean
     */
    protected $_auth_redirect = true;

    protected $_error;

    public function init()
    {}
    public function getApisVersion()   //api版本获取
    {
        return array('sina'=>!empty($this->_api_version)?$this->_api_version:2, //sina微博默认2
                'sohu' => !empty($this->_api_version)?$this->_api_version:1,
                'qq' => !empty($this->_api_version)?$this->_api_version:1,
            );

    }
    public function setBaseUri($identify,$api_version='') //版本号   //重新设定baseUri
    {
        $identify = strtolower($identify);
        $this->_api_version = $api_version;
        $apis_version = $this->getApisVersion();
        $this->_api_version = !empty($api_version)?$api_version:$apis_version[$identify];
        if (isset($this->_apis[$identify][$this->_api_version]))
        {
            $this->_identify = $identify;
            $this->_base_uri = $this->_apis[$identify][$this->_api_version];
        }
        else
        {
            throw new Error('无效的API标识');// 是否需要修改 Helper::errorLog($province_code.'|'.$city_code.'|'.$country_code.'|号码没有记录(province_code not the save)', 'cli.ProvinceCityCodeToName.'.$this->rid );
        }
    }

    public function authRedirect($enable = true)
    {
        $this->_auth_redirect = $enable;
        return $this;
    }

    public function clirequest($params = array(), $token = array(), $rawdata = false)
    {
        // cli 请求必须传 AccessToken
        if (empty($token))
        {
            throw new Error('Access Token 不能为空');
        }

        return $this->request($params, $token, $rawdata);
    }

    public function request($params = array(), $token = array(), $rawdata = false)
    {
        $this->_params = $params;
        if(!isset($this->_api_uris[$this->_identify][$this->_api_version])){
            throw new Error('无效的API标识，API版本对应错误,检查api_uris是否有对应的接口');
        }
        $api_uri = $this->_api_uris[$this->_identify][$this->_api_version];
        $api_uri = $this->parseUri($api_uri);
        $this->_params = $this->parseParams($this->_params);
        $this->genUrl($api_uri);       
        $consumer = Oauth::getConsumer(Oauth::getOAuthConsumerKey($this->_identify), $this->_identify);
        $req = new Client($consumer, $this->_url, $this->_method, $this->_api_version);
        $req->setAuth($this->_auth);
        if (empty($token))
        {
            $token = $this->checkTokenState($consumer->getKey());
        }
        $this->_token = $token;//为了配合verifycredentials在2.0模式下需要重新调用user/show的api接口
        $response = $req->request($this->_params, $token);
        return $this->parseResponse($response, $rawdata);
    }

    public function parseResponse($response, $rawdata = false)
    {
        $response = $this->preParseResponse($response, $rawdata);

        return $response;
    }

    public function preParseResponse($response, $rawdata = false)
    {
        if ($response === false)
        {
            return array('status' => false, 'message' => 'OAUTH ERROR', 'content' => '');
        }
        if ($this->_format === 'json')
        {
            $response = json_decode($response, true);
            if ($rawdata === true)
            {
                return $response;
            }
            $status = true;
            $message = '';
            switch ($this->_identify)
            {
                case 'sina':
                    if (!empty($response['error_code']))
                    {
                        $this->parseError($response);
                        $status = false;
                        $message = isset($response['error']) ? $response['error'] : '40000:API ERROR';
                        $response = '';
                    }
                    break;

                case 'sohu':
                    if (!empty($response['code']))
                    {
                        $this->parseError($response);
                        $status = false;
                        $message = isset($response['error']) ? $response['error'] : '40000:API ERROR';
                        $response = '';
                    }
                    break;

                case 'qq':
                    if (!empty($response['ret']))
                    {
                        $this->parseError($response);
                        $status = false;
                        $message = isset($response['msg']) ? $response['msg'] : '40000:API ERROR';
                        $response = '';
                    }
                    else
                    {
                        $response = $response['data'];
                    }
                    break;

                default:
                    break;
            }
            $result = array('status' => $status, 'message' => $message, 'content' => $response);
            return $result;
        }
        return $response;
    }

    public function parseError($response)
    {
        switch ($this->_identify)
        {
            case 'sina':
                $error_array = explode(':', $response['error']);
                /**
                 * 40072: 授权关系已经被删除
                 * 40112: access token 错误 (token_revoked)
                 * 40113: access token 错误 (token_rejected)
                 */
                if (in_array(intval($error_array[0]), array(40072, 40112, 40113), true))
                {
                    $this->_error = self::ERROR_TOKEN;
                }
                /**
                 * 40011: 私信发布超过上限
                 * 40070: 第三方应用访问api接口权限受限制
                 * 40304: 发布微博超过上限
                 * 40305: 发布评论超过上限
                 * 40308: 发布微博超过上限
                 * 40310:
                 * 40312:
                 * 40314: 该资源需要appkey拥有更高级的授权
                 * 40358:
                 */
                elseif (in_array(intval($error_array[0]),
                    array(40011, 40070, 40304, 40305, 40308, 40310, 40312, 40314, 40358), true))
                {
                    $this->_error = self::ERROR_API_LIMIT;
                }
                logger()->error($this->_url . ': ' . $response['error'], 'app.oauth.api');
                break;

            case 'sohu':
                if (intval($response['code']) === 401)
                {
                    $this->_error = self::ERROR_TOKEN;
                }
                logger()->error($this->_url . ': ' . $response['error'], 'app.oauth.api');
                break;

            case 'qq':
                /**
                 * 1: 无效TOKEN,被吊销
                 * 3: access_token不存在
                 * 4: access_token超时
                 */
                if (intval($response['ret']) === 3
                    && in_array(intval($response['errcode']), array(-103, 1, 3, 4), true))
                {
                    $this->_error = self::ERROR_TOKEN;
                }
                elseif (intval($response['ret']) === 2)
                {
                    $this->_error = self::ERROR_API_LIMIT;
                }
                logger()->error($this->_url . ': ' . $response['msg'], 'app.oauth.api');
                break;

            default:
                break;
        }
    }

    public function parseUri($api_uri)
    {
        if (preg_match_all('/<:(.*?)>/', $api_uri, $matches))
        {
            foreach ($matches[1] as $key => $value)
            {
                if (!empty($value))
                {
                    if (!isset($this->_params[$value]))
                    {
                        throw new Error('参数不足--params required!');
                    }
                    else
                    {
                        $api_uri = str_replace($matches[0][$key], $this->_params[$value], $api_uri);
                        unset($this->_params[$value]);
                    }
                }
            }
        }
        return $api_uri;
    }

    public function genUrl($api_uri)
    {
        switch ($this->_identify)
        {
            case 'sina':
            case 'sohu':
                $api_uri .= '.' . $this->_format;
                break;

            case 'qq':
                $this->_params['format'] = $this->_format;
                break;

            default:
                break;
        }
        return $this->_url = $this->_base_uri . $api_uri;
    }

    public function parseParams($params)
    {
        return $params;
    }

    public function loginRequired($identify)
    {
        if (user()->is_guest)
        {
            user()->loginRequired();
        }
        else
        {
            user()->setReturnUrl(req()->requestUri());
            logger()->trace('API::loginRequired: ' . req()->requestUri(), 'app.oauth');
            resp()->redirect(array('account/login', 'by' => $identify, 'do' => 'bind'));
        }
    }

    /**
     * 检查 SESSION 中是否存在 access token, 没有则查库进行设置
     *
     * @param string $consumer_key
     * @return boolean
     */
    public function checkTokenState($consumer_key)
    {
        
        $token = user()->getState(Token::ACCESS_TOKEN_SESS . $consumer_key);
        if (!$token)
        {
            //return $this->setTokenState($consumer_key);
            throw new Error('token is missed!');
        }

        return $token;
    }

    /**
     * 设置 access token state
     *
     * @param string $consumer_key
     * @return boolean
     */
    public function setTokenState($consumer_key)
    {
        // get stored token from db
        // TODO: get tiken by user
        if (($token = Oauth::store()->getServerToken($consumer_key, user()->id)) !== false)
        {
            $token = array('token' => $token->token, 'token_secret' => $token->token_secret);
            user()->setState(Token::ACCESS_TOKEN_SESS . $consumer_key, $token);
        }
        else
        {
            if ($this->_auth_redirect == false)
            {
                return false;
            }
            $this->loginRequired($this->_identify);
        }

        return true;
    }

    public function getGender($platform, $gender)
    {
        $genders = array(
            'sina' => array(
                'm' => '1', // 男
                'f' => '2', // 女
                'n' => '0', // 未知
            ),
            'sohu' => array(
                '1' => '1', // 男
                '0' => '2', // 女
            ),
            'qq' => array(
                '1' => '1', // 男
                '2' => '2', // 女
                '0' => '0', // 未知
            ),
        );

        return (isset($genders[$platform][$gender]))
                ? $genders[$platform][$gender]
                : 0;
    }

    public function getError()
    {
        return $this->_error;
    }
}

