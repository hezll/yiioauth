<?php
session_start();
require_once('../Opent.php');
include_once(OAUTH_ROOT.'/qq/api_client.php' );


$o = new MBOpenTOAuth($config['qq']['akey'] , $config['qq']['skey'], $_SESSION['qqkeys']['oauth_token'] , $_SESSION['qqkeys']['oauth_token_secret']  );

$last_key = $o->getAccessToken($_REQUEST['oauth_verifier']) ;

$_SESSION['qqlast_key'] = $last_key;

?>
<head>
<meta http-equiv="refresh" content="0;url='<?php echo  $config['qq']['callback'];?>'"> 
</head>
