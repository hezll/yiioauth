<?php
session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );


$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
$ms  = $c->home_timeline(); // done
$me = $c->verify_credentials();


$idonum = $me['friends_count'];
$cur = (int)($_GET['cur']+1);
$start = 20*(int)($_GET['cur']+1);


$user = $c->friends($start,20,$me['id']);
//var_dump($user);
foreach($user as $k=>$v){
//var_dump($k);
$idohtml.='<option value="@'.$v['id'].'" onclick="javascript:showOptionValue(this);" >'.$v['screen_name'];//'."'@".$v['name']."'".'
}

$morehtml ='';
if($idonum>$start+30){
	$morehtml.='<option value="more" onclick="javascript:showOptionValue(this);" id="0-'.$_GET['total'].'">更多';//onclick="javascript:morefriend(0,'.$pnum.');" 
}


echo $idohtml.'&&'.$morehtml;

exit;

?>
