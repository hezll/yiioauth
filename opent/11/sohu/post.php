<?php
@header('Content-Type:text/html;charset=utf-8'); 
session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );
                           
                           $post_SESSION= @$_POST['post_SESSION'];
                           $post_SESSION=str_replace('\"','"',$post_SESSION);
                           $post_SESSION= unserialize($post_SESSION);
                           $_SESSION=$post_SESSION;
                          
$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );	
//发消息
//	*@content: 微博内容
//--------------------------------记录user信息-----------------------------------------//
$getUserInfo=$c->show_user($_SESSION['last_key']["user_id"]);        
  $_SESSION['lenovolepad_uid']=array('nick'=>$getUserInfo['name'],'name'=>$getUserInfo['id'],'source'=>'sina');
  
defined('INIT_ROOT') or define('INIT_ROOT','/opt/projects/2011/lenovolepad/action');
require_once(INIT_ROOT.'/init.php');
global $user;  
$uid=intval($user->uid);


  
//--------------------------------安全认证-----------------------------------------//
$md5key=@$_POST["md5key"];
$md5key=trim($md5key, '\\\'');
$memcache = new Memcache; 
$memcache->pconnect('10.15.6.58', 11211);  
if($memcache->get($md5key)!=1)
{
  echo '<script>alert("安全码出错，请重试！");history.go(-1);</script>';exit; //echo '-7';exit;
}
else
{
  $memcache->delete($md5key);
  unset($_POST["md5key"]);
}
    
    
       
  $post_demo_id=@intval($_POST['post_demo_id']);  
  $sql = "select speak,img1 FROM db2011.lenovolepad_info_demo where id=".$post_demo_id."";
  $info=@db_fetch_object(db_query($sql));
  $file_name=substr(basename($info->img1),0,-4);

	$rr = $c ->upload( @trim($info->speak) , @trim($info->img1) );	 

	echo @$rr['id'];exit;

?>