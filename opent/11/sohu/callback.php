<?php
@header('Content-Type:text/html;charset=utf-8'); 
session_start();
require_once('../Opent.php');
include_once(OAUTH_ROOT.'/sohu/SohuOAuth.php' );



$o = new WeiboOAuth($config['sohu']['akey'] , $config['sohu']['skey'], $_SESSION['sohukeys']['oauth_token'] , $_SESSION['sohukeys']['oauth_token_secret']  );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;

$_SESSION['sohulast_key'] = $last_key;
 //授权完成,<a href="weibolist.php">进入你的微博列表页面</a>

//var_dump($o);
?>

<head>
<meta http-equiv="refresh" content="0;url='<?php echo  $config['sohu']['callback'];?>'"> 
</head>
