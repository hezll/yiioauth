<?php
class OpentSina extends WeiboClient implements IOpentStrategy
{
//=$sinaConfig['akey']=$sinaConfig['skey']
	function __construct() 
    {       
        $session = new CHttpSession;
        $session->open();

        if(empty($session['sinalast_key']['oauth_token'])||empty($session['sinalast_key']['oauth_token_secret'])){
             //header('Location: '.OAUTH_ROOT_URL.'/action/modules/opent/sina/index.php'); //此处与sina略有不同，请注意。    
           // echo '<head><meta http-equiv="refresh" content="0;url='.OAUTH_ROOT_URL.'/action/modules/opent/sina/index.php'.'"> </head>';     
            $url = Yii::app()->createUrl('account/loginpage');
            Yii::app()->getRequest()->redirect($url);
                 
        }
        parent::__construct('sina',$session['sinalast_key']['oauth_token'] ,$session['sinalast_key']['oauth_token_secret']  );
        
    } 

	/**
	 * 关注人列表
	 */
//function friends($cursor, $count, $uid_or_name){
//		return parent::friends($cursor, $count, $uid_or_name);
//	}

	function show_user( $uid_or_name = null ) 
    { 
        $uid_or_name = urlencode($uid_or_name);     
        return parent::show_user($uid_or_name);   
    } 
    function verify_credentials(){
        return parent::verify_credentials();
    }

}




?>