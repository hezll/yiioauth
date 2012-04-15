<?php
@header('Content-Type:text/html;charset=utf-8');             // echo '内测中';exit;
session_start();
session_unset();
//if( isset($_SESSION['last_key']) ) header("Location: weibolist.php");
include_once( 'config.php' );
include_once( 'weibooauth.php' );

$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );

$keys = $o->getRequestToken();
$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , 'http://220.181.118.174/x7/action/modules/opent/sohu2/callback.php');
$_SESSION['sohukeys'] = $keys;
?>

<head>
<meta http-equiv="refresh" content="0;url=<?php echo $aurl?>"> 
</head>