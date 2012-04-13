<?php
@header('Content-Type:text/html;charset=utf-8'); 
session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );



$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['sohukeys']['oauth_token'] , $_SESSION['sohukeys']['oauth_token_secret']  );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;

$_SESSION['sohulast_key'] = $last_key;
 //授权完成,<a href="weibolist.php">进入你的微博列表页面</a>

//var_dump($o);
?>

<head>
<meta http-equiv="refresh" content="0;url=http://220.181.118.174/x7/plateuser_check.php?status=back&plate=sohu"> 
</head>
