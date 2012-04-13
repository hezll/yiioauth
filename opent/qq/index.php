<?php
session_start();
require_once('../Opent.php');
require_once(OAUTH_ROOT.'/qq/api_client.php');
$o = new MBOpenTOAuth($config['qq']['akey'] , $config['qq']['skey']);

//$keys = $o->getRequestToken('null');
//$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false ,OAUTH_ROOT_URL.'/callback.php');
$keys = $o->getRequestToken(OAUTH_ROOT_URL.'/callback.php');//这里的*********************填上你的回调URL
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false,'');
$_SESSION['qqkeys'] = $keys;


header('location: '.$aurl);
?>
