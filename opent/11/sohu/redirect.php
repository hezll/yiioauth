<?php
@header('Content-Type:text/html;charset=utf-8');             // echo '内测中';exit;
session_start();
//session_unset();
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");
require_once('../Opent.php');
include_once(OAUTH_ROOT.'/sohu/SohuOAuth.php' );

$o = new WeiboOAuth($config['sohu']['akey'] , $config['sohu']['skey']);

$keys = $o->getRequestToken();
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , OAUTH_ROOT_URL.'/callback.php');

$_SESSION['sohukeys'] = $keys;

?>

<head>
<meta http-equiv="refresh" content="0;url=<?php echo $aurl?>"> 
</head>