<?php
session_start();
require_once('../Opent.php');
require_once(OAUTH_ROOT.'/sina/SinaOAuth.php');


$o = new WeiboOAuth($config['sina']['akey'] , $config['sina']['skey']);

$keys = $o->getRequestToken();
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false ,OAUTH_ROOT_URL.'/callback.php');

$_SESSION['sinakeys'] = $keys;



header('location: '.$aurl);
?>
