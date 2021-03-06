<?php
/* Start session and load lib */
session_start();

require_once('../Opent.php');
require_once(OAUTH_ROOT.'/sohu/SohuOAuth.php');
/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['sohukeys']['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new SohuOAuth($config['sohu']['akey'], $config['sohu']['skey'], $_SESSION['sohukeys']['oauth_token'], $_SESSION['sohukeys']['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['sohulast_key'] = $access_token;

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use $config['sohu']['callback'] */ 
  $_SESSION['status'] = 'verified';
  header('Location: '.'http://220.181.118.174/x7/plateuser_check.back.php?status=back&plate=sohu');
} else {
  /* Save HTTP status for error dialog on connnect page.*/
  header('Location: ./clearsessions.php');
}
