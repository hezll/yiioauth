<?php
require_once(OAUTH_ROOT.'/IOpentStrategy.php');
require_once(OAUTH_ROOT.'/qq/api_client.php');
error_reporting(0);
class OpentQq extends MBApiClient implements IOpentStrategy
{

function __construct() 
    {        
	
	unset($_SESSION['sinalast_key']);
	unset($_SESSION['sinalast_key']['oauth_token']);
	unset($_SESSION['sinalast_key']['oauth_token_secret']);	
	unset($_SESSION['sinakeys']);
	unset($_SESSION['sohulast_key']);
	unset($_SESSION['sohulast_key']['oauth_token']);
	unset($_SESSION['sohulast_key']['oauth_token_secret']);
	unset($_SESSION['sohukeys']);
       if(!session_id())
            @session_start();
    
        global $config;
        
        
        if(empty($_SESSION['qqlast_key']['oauth_token'])||empty($_SESSION['qqlast_key']['oauth_token_secret'])){
             //header('Location: '.OAUTH_ROOT_URL.'/action/modules/opent/qq/index.php'); //此处与sina略有不同，请注意。
			 echo '<head><meta http-equiv="refresh" content="0;url='.OAUTH_ROOT_URL.'/action/modules/opent/qq/index.php'.'"> </head>';
        }
        //var_dump($_SESSION['last_key']['oauth_token']);
        parent::__construct( $config['qq']['akey'] ,  $config['qq']['skey'] ,$_SESSION['qqlast_key']['oauth_token'] , $_SESSION['qqlast_key']['oauth_token_secret']  );
        
    } 


/**      
 * 粉丝列表
 */ 
function follow($uid_or_name){} 
      
function followers(){}
/**
 * 发微薄
 */ 
function update($text){
    $p['c'] = $text;
    $p['type'] = 1;
    $this->postOne($p);
}
/**
 * 发图片微薄
 */  
function upload($text,$img){

	$p =array(
			'c' => @trim($text),
			'ip' => '', 
			'j' => '',
			'w' => '',
			'p' => array('jpg',$img,file_get_contents(@trim($img))),
			'type' => 0
	);
   return parent::postOne($p);
 
 }
/**
 * 个人资料
 */ 
function show_user( $uid_or_name = null ) 
{ 
        $uid_or_name = urlencode($uid_or_name);     
        return parent::getUserInfo($uid_or_name);   
} 
/**
 * 关注人列表
 */ 
function friends($cursor, $count, $uid_or_name,$p){
	
    return parent::getfans($p);
}


}




?>