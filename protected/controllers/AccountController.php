<?php
/**
 * $Id$ 
 */
class AccountController extends Controller
{   
    private $_oauth;
    public function __construct($id,$module=null)
    {
        parent::__construct($id, $module);
        $this->_oauth = Yii::app()->params['oauth'];
    }
    public function actionLoginPage($platform='sina'){
        echo 'WelcomeToLogin';
        $o = new WeiboOAuth($platform);
        $keys = $o->getRequestToken();
        Yii::app()->session->add($platform.'keys',$keys);  
       // echo 'http://'.$_SERVER['HTTP_HOST'].$this->createUrl('callback');exit;
        $aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , 'http://'.$_SERVER['HTTP_HOST'].$this->createUrl('callback',array('platform'=>$platform)));
        echo "<a href=\"$aurl\">登录$platform</a>";

        
        
    }
    public function actionCallback($platform=''){
        $session = new CHttpSession;
        $session->open();
        $o = new WeiboOAuth($platform, $session[$platform.'keys']['oauth_token'] , $session[$platform.'keys']['oauth_token_secret']  );
        $last_key = $o->getAccessToken($_REQUEST['oauth_verifier']) ;
        $session[$platform.'last_key'] = $last_key;
        Yii::app()->getRequest()->redirect(Yii::app()->createUrl('site/index'));
    }
    public function actionClear(){
        $session = new CHttpSession;
        $session->destroy();
        var_dump($session);
        $session->close();
    }
    
    
    
    
    
    
    
    ///////////////////////////////////////////////////
    public function actionLogin()
    {
        if (!empty($by))
        {
            $consumer_key = Oauth::getOAuthConsumerKey($by);
            if ($consumer_key === false)
            {
                throw new HttpException(404, '您访问的页面不存在');
            }
            resp()->redirect(url(array('account/oauthlogin', 'by' => $by, 'do' => $do)));
            exit;
        }
//        $form = new LoginForm();
//        $post_data = post('LoginForm');
//        if ($post_data)
//        {
//            $form->attributes = $post_data;
//
//            if ($form->validate() && $form->login())
//            {
//                resp()->redirect(user()->return_url);
//            }
//            else
//            {
//                $error = $form->errorMessages(null, 'array');
//                if (!empty($error[0]))
//                {
//                    $error = $error[0];
//                }
//                else
//                {
//                    $error = '登录失败, 请联系管理员';
//                }
//                user()->setFlash('error_login', $error);
//            }
//        }
//
//        $this->render('login', array(
//            'form' => $form,
//        ));
    }

    public function actionOAuthLogin()
    {      
        $callback = get('callback');
        $consumer_key = Oauth::getOAuthConsumerKey($by);
        if ($consumer_key === false)
        {
            throw new HttpException(404, '您访问的页面不存在');
        }

        $logincallback = user()->return_url;
        $logincallback = !empty($logincallback[0]) ? $logincallback[0] : '/';
        $callback = url(array('account/oauthcallback', 'by' => $by, 'do' => $do, 'logincallback' => $logincallback), true);
        //http://localhost/weibo1.1/htdocs/?q=account%2Foauthcallback&by=sina&do=bind&logincallback=profile%2Faccount&
        $authorize_url = Client::getAuthorizeURL($consumer_key, $by,$callback);
        if ($authorize_url === false)
        {
            throw new HttpException(400, '认证地址请求错误');
        }
        resp()->redirect($authorize_url);
        exit;
    }

    public function actionOAuthCallback()
    {
        $do = strtolower(get('do'));
        $by = strtolower(get('by'));
        $code = strtolower(get('code'));
        $logincallback = get('logincallback');
        $this->checkLogin($do, $by);

        $verifier = get('oauth_verifier');
        $token = get('oauth_token');
        
        $consumer_key = Oauth::getOAuthConsumerKey($by);
        if ($consumer_key === false || empty($verifier) || empty($token))
        {
            if(!isset($code))
            {
                throw new HttpException(404, '您访问的页面不存在');
            }
            else
            {
                $verifier = $code;//应对oauth 2.0情况
            }
        }
        $access_token = Client::getAccessToken($consumer_key, $verifier, $by ,$logincallback);
        if ($access_token === false)
        {
            throw new HttpException(400, 'OAuth请求错误');
        }

       
        logger()->trace('AccC::logincallback: ' . $logincallback, 'app.oauth');
        // 用户初始化
        Oauth::initOauthLogin($access_token, $by);
        if (empty($logincallback) || $logincallback == '/')
        {
            $site_id = user()->getState('site_id');
            if (empty($site_id))
            {
                $logincallback = array('/');
            }
            else
            {
                $logincallback = Site::route($site_id);
            }
        }
        else
        {
            $logincallback = array($logincallback);
        }

        $do_text = $do === 'bind' ? '绑定' : '登录';
        user()->setFlash('success_bind', $by . $do_text . '成功');

        // login success, redirect return_url
        resp()->redirect($logincallback);
    }

    public function actionBind()
    {
        $user_mapper = new User;
        if ($user_mapper->checkBind() === false)
        {
            throw new HttpException(403, '请使用本站帐号登录或先注册本站帐号');
        }
        // TODO: oauth bind page
        user()->setReturnUrl(array('account/bind'));
        $this->render('bind');
    }

    public function actionRegister()
    {
        if (!user()->is_guest)
        {
            resp()->redirect(array('/'));
            exit;
        }

        $form = new RegisterForm;
        $post_data = post('RegisterForm');
        if ($post_data)
        {
            if (Config::get('user.enable_register', false) === false)
            {
                user()->setFlash('error_register', '未开放注册');
            }
            else
            {
                //*
                $form->attributes = $post_data;
                $user_mapper = new User;

                if ($form->validate() && $user_mapper->register($form->username, $form->password))
                {
                    // 重置登录返回地址
                    user()->setReturnUrl(array('/'));

                    // TODO: 发注册邮件
                    //$mail = new Mailer;

                    // 注册完登录
                    $identity = new DbUserIdentity($form->username, $form->password);
                    $identity->authenticate();
                    user()->login($identity);

                    $this->render('register_ok', array(
                        'form' => $form,
                    ));
                }
                else
                {
                    $error = $form->errorMessages(null, 'array');
                    if (!empty($error[0]))
                    {
                        $error = $error[0];
                    }
                    else
                    {
                        $error = $user_mapper->errorMessages(null, 'array');
                        if (!empty($error[0]))
                        {
                            $error = $error[0];
                        }
                        else
                        {
                            $error = '注册错误, 请联系管理员';
                        }
                    }
                    user()->setFlash('error_register', $error);
                }
                //*/
            }
        }

        $this->render('register', array(
            'form' => $form,
        ));
    }

    public function actionActive()
    {
        // TODO: 初始注册用户激活操作, 邮件内链接激活
    }

    public function actionLogout()
    {
        user()->logout();
        resp()->redirect(user()->login_url);
    }

    private function checkLogin($do, $by = '')
    {
        if ($do === 'bind' && user()->is_guest) // 绑定oauth, 未在本站登录时跳转到登录页面
        {
            user()->loginRequired();
        }
        elseif ($do === 'bind' && !user()->is_guest)
        {
            $user_mapper = new User;
            if ($user_mapper->checkBind() === false)
            {
                throw new HttpException(403, '请使用本站帐号登录或先注册本站帐号');
            }

            if (empty($by)) // 绑定操作未传目标平台, 跳转到所有平台绑定页
            {
                resp()->redirect(array('account/bind'));
            }
        }
        elseif ($do !== 'bind' && !user()->is_guest) // 已登录用户进行登录操作返回默认首页
        {
            resp()->redirect(array('/'));
            exit;
        }
    }
}
