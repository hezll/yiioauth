<?php
session_start();
require_once('../Opent.php');
include_once(OAUTH_ROOT.'/sina/SinaOAuth.php' );


$o = new WeiboOAuth($config['sina']['akey'] , $config['sina']['skey'], $_SESSION['sinakeys']['oauth_token'] , $_SESSION['sinakeys']['oauth_token_secret']  );

$last_key = $o->getAccessToken($_REQUEST['oauth_verifier']) ;

$_SESSION['sinalast_key'] = $last_key;

?>
<head>
<meta http-equiv="refresh" content="0;url='<?php echo  $config['sina']['callback'];?>'"> 
</head>
