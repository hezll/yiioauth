<?php
/**
 * 搜狐(SOHU)的php示例代码是 基于Abraham Williams发布的开源twitteroauth库的。
 * https://github.com/abraham/twitteroauth
 * 
 * 此文件用户申请access token，成功获取Access Token后存储在session中，如$_SESSION['access_token']。
 * 
 */

session_start();
require_once('oauth/SohuOAuth.php');
require_once('config.php');

/* 如果access token不存在，则重定向到connect.php去申请access token*/
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
	header('Location: ./clearsessions.php');
}
/*从 session 中获取access token*/
$access_token = $_SESSION['access_token'];

/* 使用token创建SohuOauth对象*/
$oauth = new SohuOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/*使用open api*/
$url = 'http://api.t.sohu.com/users/show.json';
$content = $oauth->get($url);


include('html.inc');
?>