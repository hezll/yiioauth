<?php

/**
 * 设置应用的key
 */
define('CONSUMER_KEY', 'nEzjtXCw7qnGnPRsJeo9');
/**
 * 设置应用key对应的密钥
 */
define('CONSUMER_SECRET', 'JEhk8ULm3w6buBPkv00V8I#Z69kKtDyzBrm2TA5W');
/**
 * 
 * 桌面应用请设置OAUTH_CALLBACK为小写的oob，Web应用请填写你应用程序的callback url，
 * 以便用户对应用授权之后我们访问并传回确认信息。
 */
define('OAUTH_CALLBACK', 'http://'.$_SERVER['SERVER_NAME'].'/opent/sohu/callback.php');

?>