<?php
/**
 * $Id$ 
 */
class AccountController extends Controller
{   
    private $_oauth;
    private $_identity;
    public function __construct($id,$module=null)
    {
        parent::__construct($id, $module);
        $this->_oauth = Yii::app()->params['oauth'];
    }
//    public function actionLoginPage($platform='sina'){
//        echo 'WelcomeToLogin';
//        $o = new WeiboOAuth($platform);
//        $keys = $o->getRequestToken(($platform=='qq')?'http://'.$_SERVER['HTTP_HOST'].$this->createUrl('callback',array('platform'=>$platform)):'');
//        Yii::app()->session->add($platform.'keys',$keys);  
//        $aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , 'http://'.$_SERVER['HTTP_HOST'].$this->createUrl('callback',array('platform'=>$platform)));
//        echo "<a href=\"$aurl\">登录$platform</a>";
//
//        
//        
//    }
    public function actionCallback($platform=''){
        $session = new CHttpSession;
        $session->open();
        $o = new WeiboOAuth($platform, $session[$platform.'keys']['oauth_token'] , $session[$platform.'keys']['oauth_token_secret']  );
        if(!isset($_REQUEST['oauth_verifier'])){
            throw new Exception('授权失败！请稍后重试！');
        }
        $last_key = $o->getAccessToken($_REQUEST['oauth_verifier']) ;
        $wei = new WeiboClient($platform,$last_key['oauth_token'],$last_key['oauth_token_secret']);  
        if($platform!='qq'){
            $user = $wei->verify_credentials();
        }else{
            $user = $wei->get_qq_user_info();
        }
        $this->_identity=new UserIdentity($user,$platform);
        $this->_identity->authenticate();
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE){        
            Yii::app()->user->login($this->_identity,0);          
        }
        //$this->redirect(Yii::app()->controller->module->returnUrl);
        Yii::app()->getRequest()->redirect(Yii::app()->createUrl('user/profile/edit'));
    }
    public function actionClear(){
        $session = new CHttpSession;
        $session->destroy();
        $session->close();
    }                
}
