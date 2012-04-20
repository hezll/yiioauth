<?php
session_start();
require_once('../Opent.php');
require_once(OAUTH_ROOT.'/sohu/SohuOAuth.php');

/* 创建SohuOAuth对象 */
$oauth = new SohuOAuth($config['sohu']['akey'], $config['sohu']['skey']);

/* 获取request token */
$request_token = $oauth->getRequestToken(OAUTH_CALLBACK);

/* 保存request token，成功获取access token之后用access token代替 */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

switch ($oauth->http_code) {
  case 200:
    /* 获取用户认证地址，并且重定向到SOHU */
    $url = $oauth->getAuthorizeUrl($token,'', OAUTH_ROOT_URL.'/callback.php');
    header('Location: ' . $url); 
    break;
  default:
    /* Show notification if something went wrong. */
    echo '出错了。。。请重试。';
}
?>
