<?php
require_once(OAUTH_ROOT.'/IOpentStrategy.php');
require_once(OAUTH_ROOT.'/sohu/SohuOAuth.php'); 

class OpentSohu extends WeiboClient implements IOpentStrategy
{
//=$sohuConfig['akey']=$sohuConfig['skey']
function __construct() 
    { 
          
        if(!session_id())
            @session_start(); 
        global $config;
        /* 如果access token不存在，则重定向到connect.php去申请access token*/
        if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
           header('Location: '.OAUTH_ROOT_URL.'/action/modules/opent/sohu/redirect.php'); //此处与sina略有不同，请注意。         
            exit;
        }
       
        parent::__construct( $config['sohu']['akey'] , $config['sohu']['skey'] ,$_SESSION['access_token']['oauth_token'] , $_SESSION['access_token']['oauth_token_secret']  );
        
    }
     function follow( $uid_or_name ) 
    { 
    	
       // $uid_or_name = mb_convert_encoding($uid_or_name, 'utf-8', 'gbk');
        $uid_or_name = urlencode($uid_or_name);     
        return parent::follow(  $uid_or_name);    
    } 
    	/**
	 * 关注人列表
	 */ 


function show_user( $uid_or_name = null ) 
    { 
        return parent::show_user($uid_or_name);   
    }  
}



?>