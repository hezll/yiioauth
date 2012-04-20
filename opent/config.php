<?php
//sohu
/*
$config=array('sohu'=>array(
                            'akey'=>'0O91XibW3ROrouXgmp4k',
                            //'akey'=>'nEzjtXCw7qnGnPRsJeo9',
                            //'skey'=>'JEhk8ULm3w6buBPkv00V8I#Z69kKtDyzBrm2TA5W',
                            'skey'=>'MV4JhXLBi=^CWiDXHv493YbWs%!%MOA#oILiGJMn',
                            'callback'=>'http://220.181.118.174/x7/xxx.old.php'),
              'sina'=>array(
                            'akey'=>1718701185,
                            'skey'=>'a8dbddfcb321d3e1550372c1227608b3',
                            'callback'=>'http://220.181.118.174/x7/xxx.old.php'              
                            ),
              'qq'=>array(
                            'akey'=>'748b95b5e36a4a18b03f2eb05fd6903c',
                            'skey'=>'4d5b0b652f6240d5c5a1d5b62c71d6a5',
                            'callback'=>'http://220.181.118.174/x7/xxx.old.php'              
                            ),
);
define( "WB_AKEY" , 'nEzjtXCw7qnGnPRsJeo9' );
define( "WB_SKEY" , 'JEhk8ULm3w6buBPkv00V8I#Z69kKtDyzBrm2TA5W' );


'sina'=>array(
                            'akey'=>3433019979,
                            'skey'=>'d4fbabb8e84f1c75ad4302eaf059f0cf',
                            'callback'=>'http://220.181.118.174/x7/plateuser_check.php?status=back&plate=sina'              
                            ),

App Key：
1071527006
App Secret：
2fb1a9498e44e0e874b20252d378d2ca


'sohu'=>array(
                            'akey'=>'lkVHUBMb2ASknc5eBzle',
                            'skey'=>'p03-3d$nMc6Xk%-8QFQ%QOZY%2x$lOFq#j5%m%sV',

*/

$config=array('sohu'=>array(
                            'akey'=>'QhSv11Uns2oFA7yz3XNs',
                            'skey'=>'ODj=puBAVazZfSa!-7iCLXa7Bp)n2lMs458Ghh1l',
                            'callback'=>'http://220.181.118.174/x7/plateuser_check.php?status=back&plate=sohu'),
              'sina'=>array(
                            'akey'=>1071527006,
                            'skey'=>'2fb1a9498e44e0e874b20252d378d2ca',
                            'callback'=>'http://220.181.118.174/x7/plateuser_check.php?status=back&plate=sina'              
                            ),
              'qq'=>array(
                            'akey'=>'b6999ab54c7c4f4aa740aa4a9e44e2a6',
                            'skey'=>'e8f3123ba52f4c8991005a53b6fd7aff',
                            'callback'=>'http://220.181.118.174/x7/plateuser_check.php?status=back&plate=qq'              
                            ),
);



//获得当前的脚本网址 
function GetCurUrl() 
{ 
    if(!empty($_SERVER["REQUEST_URI"])) 
    { 
        $scriptName = $_SERVER["REQUEST_URI"]; 
        $nowurl = $scriptName; 
    } 
    else 
    { 
        $scriptName = $_SERVER["PHP_SELF"]; 
        if(empty($_SERVER["QUERY_STRING"])) 
        { 
            $nowurl = $scriptName; 
        } 
        else 
        { 
            $nowurl = $scriptName."?".$_SERVER["QUERY_STRING"]; 
        } 
    } 
    return $nowurl; 
}

/**
 * 获取302后的跳转地址，新浪微博获取某条微博接口不支持302
 */  
function getContents($url){
    $header = array("Referer: http://www.sohu.com/");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); //是否抓取跳转后的页面
    ob_start();
    curl_exec($ch);
    $contents = ob_get_contents();
    ob_end_clean();
    $x = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $x;
}



?>