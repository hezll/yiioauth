<?php
require_once(OAUTH_ROOT.'/IOpentStrategy.php');
require_once(OAUTH_ROOT.'/sina/SinaOAuth.php');
error_reporting(0);
class OpentSina extends WeiboClient implements IOpentStrategy
{
//=$sinaConfig['akey']=$sinaConfig['skey']
function __construct() 
    {   
	
	unset($_SESSION['sohulast_key']);
	unset($_SESSION['sohulast_key']['oauth_token']);
	unset($_SESSION['sohulast_key']['oauth_token_secret']);
	unset($_SESSION['sohukeys']);
	unset($_SESSION['qqlast_key']);
	unset($_SESSION['qqlast_key']['oauth_token']);
	unset($_SESSION['qqlast_key']['oauth_token_secret']);	
	unset($_SESSION['qqkeys']);

       if(!session_id())
            @session_start();
    
        global $config;
        
        
        if(empty($_SESSION['sinalast_key']['oauth_token'])||empty($_SESSION['sinalast_key']['oauth_token_secret'])){
             //header('Location: '.OAUTH_ROOT_URL.'/action/modules/opent/sina/index.php'); //此处与sina略有不同，请注意。    
			 echo '<head><meta http-equiv="refresh" content="0;url='.OAUTH_ROOT_URL.'/action/modules/opent/sina/index.php'.'"> </head>';
        }
        //var_dump($_SESSION['last_key']['oauth_token']);
        parent::__construct( $config['sina']['akey'] ,  $config['sina']['skey'] ,$_SESSION['sinalast_key']['oauth_token'] , $_SESSION['sinalast_key']['oauth_token_secret']  );
        
    } 

	/**
	 * 关注人列表
	 */ 
function friends($cursor, $count, $uid_or_name,$p){
		return parent::friends($cursor, $count, $uid_or_name);
	}

	function show_user( $uid_or_name = null ) 
    { 
        $uid_or_name = urlencode($uid_or_name);     
        return parent::show_user($uid_or_name);   
    } 

}




?>