<?php
@header('Content-Type:text/html;charset=utf-8'); 
session_start();        
include_once( 'config.php' );
include_once( 'weibooauth.php' );
                                
$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
$ms  = $c->home_timeline(); // done
$me = $c->verify_credentials();

//--------------------------------记录user信息-----------------------------------------//
$getUserInfo=$c->show_user($_SESSION['last_key']["user_id"]);     

var_dump($getUserInfo);exit;


  $_SESSION['lenovolepad_uid']=array('nick'=>$getUserInfo['screen_name'],'name'=>$getUserInfo['id'],'source'=>'sohu');
  
defined('INIT_ROOT') or define('INIT_ROOT','/opt/projects/2011/lenovolepad/action');
require_once(INIT_ROOT.'/init.php');
global $user;  
$uid=intval($user->uid);       



                                              
header("Location: http://lepadlaile.lenovo.com.cn/index.php?s=1");
         



//$idonum = $me['friends_count'];
//$pnum = (int)($idonum/10)+1;
        ;
$user = $c->friends(-1,5,$me['id']);
//var_dump($user['cursor_id']);

foreach($user['users'] as $k=>$v){
//var_dump($k);
$idohtml.='<option value="@'.$v['name'].'" onclick="javascript:showOptionValue(this);" id=0>'.$v['screen_name'];//'."'@".$v['name']."'".'
}

$morehtml ='';
//if($pnum>0){
	$morehtml='<option value="more" name="more" onclick="javascript:showOptionValue(this);" id="0-'.$user['cursor_id'].'">更多';//onclick="javascript:morefriend(0,'.$pnum.');" 
//}



/*
	*@num: 请求个数(1-30)
	*@start: 起始位置
	*@n:用户名 空表示本人
	*@type: 0 听众 1 偶像
	0表示还有数据idolnum

$user = $c->getUserInfo();
$idonum = $user['data']['idolnum'];
$pnum = (int)($idonum/30);

$idoparam = array('num'=>30,
				  'start'=>0,
				  'type'=>1,
				  'format'=>'json'
					);
$ido = $c->getMyfans($idoparam);
$idohtml='';
foreach($ido['data']['info'] as $k=>$v){
$idohtml.='<option value="@'.$v['name'].'" onclick="javascript:showOptionValue(this);" >'.$v['nick'];//'."'@".$v['name']."'".'
}
if($ido['hasnext']==0){
	$idohtml.='<option value="more" onclick="javascript:showOptionValue(this);" id="0-'.$pnum.'">更多';//onclick="javascript:morefriend(0,'.$pnum.');" 
	*/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sohu 微博发布接口</title>
</head>
<script type="text/javascript" src="../action/js/jquery-1.2.6.min.js"></script>
<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  @您的好友 					<select name="type" id="type" class="iform" onclick="simOptionClick4IE()" >
							<option value="请@您的好友" id=0>请@您的好友
							<?php echo $idohtml;?>
							<?php echo $morehtml;?>
							</select>
							<div id="select" style="display:none;"><option value="请@您的粉丝" id=0>请@您的好友<?php echo $idohtml;?></div>
  内容：<textarea  name="content" id="content" ></textarea>
  图片：<input type="text" name="pic" id="pic" />
  <input type="submit" name="button" id="button" value="提交" />
</form>
<script>
function simOptionClick4IE(){
	var evt=window.event  ;
	var selectObj=evt?evt.srcElement:null;
    // IE Only
	if (evt && selectObj &&  evt.offsetY && evt.button!=2
	&& (evt.offsetY > selectObj.offsetHeight || evt.offsetY<0 ) ) {

	// 记录原先的选中项
	var oldIdx = selectObj.selectedIndex;

	setTimeout(function(){
				var option=selectObj.options[oldIdx];
				// 此时可以通过判断 oldIdx 是否等于 selectObj.selectedIndex
				// 来判断用户是不是点击了同一个选项,进而做不同的处理.
				showOptionValue(option)

				}, 60);
	}
}

function showOptionValue(opt,msg){
	                                if(opt.value=='more'){
										 var id = opt.id;
										 var tmp = id.indexOf('-');
										 var cur = id.substr(0,tmp);
										 var total = id.substr(tmp+1,id.length);


										 var more='';
										 var list='';
										 $.get('friend.php?cur='+cur+'&total='+total,function(data){
											 list = data;
											 var tmp2 = data.indexOf('&&');
											 list = data.substr(0,tmp2);
                                             more = data.substr(tmp2+2,data.length);

                                            
										     $('#type').html($('#select').html()+list+more);
											 $('#select').html($('#select').html()+list);

										 });


										
									}else{

											var resultZone=document.getElementById('content');
											resultZone.innerHTML= (opt.value+resultZone.innerHTML);
									}
}


</script>
</body>
</html>