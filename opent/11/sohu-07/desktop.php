<?php
/**
 * 搜狐(SOHU)的php示例代码是 基于Abraham Williams发布的开源twitteroauth库的。
 * https://github.com/abraham/twitteroauth *
 * 桌面应用申请access token
 */
require_once('oauth/SohuOAuth.php');
require_once('config.php');

/**
 * get a string from stdin
 * @param $length string length
 */
function getInput($length=255){
    $fr=fopen("php://stdin","r");
    $input = fgets($fr,$length);
    $input = rtrim($input);
    fclose ($fr);
    return $input;
}

/**
 * Get the access token at your fist time of using the open api, you should save it.
 */
function get_access_token(){
    /* 使用token创建SohuOauth对象*/
    $oauth = new SohuOAuth(CONSUMER_KEY, CONSUMER_SECRET);
    /**
     * get a request token for the desktop app
     */
    $request_token = $oauth->getRequestToken(OAUTH_CALLBACK);
    /**
     * get the authorize url for the app and direct the current user to authorize the app.
     */
    $authorize_url = $oauth->getAuthorizeURL($request_token);
    echo "Now please visit the url \r\n".$authorize_url."\r\nto get this app authorized.";
    echo "Enter the verification code and hit ENTER when you're done.\r\n";
    /**
     * read the verification code from stdin.
     */
    $verifier= getInput();
    /**
     * get the access token, and you can save it to somewhere else like a file.
     * You should not get access token every time.
     */
    $access_token = $oauth->getAccessToken($verifier);
    echo $access_token['oauth_token']." = ".$access_token['oauth_token_secret'];
    return  $access_token;
}
/**
 * Get access token. If you aready have one,
 * please use it and do not get it except that you really want to refresh your access token.
 */
$access_token = get_access_token();

/**
 * Create the SohuOauth object, need the consumer token and the accesss token.
 */
$oauth = new SohuOAuth(CONSUMER_KEY, CONSUMER_SECRET,$access_token['oauth_token'],$access_token['oauth_token_secret']);

/**
 * A test case, you can do others things like this one.
 * Please visit http://open.t.sohu.com/ for details.
 */
$url = "http://api.t.sohu.com/statuses/friends.json";
$response = $oauth->get($url);
echo  "\r\n".json_encode($response);

?>