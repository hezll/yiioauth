<?php
/**
defined(MODULES_ROOT)?define('OAUTH_ROOT',MODULES_ROOT.'/opent' ):define('OAUTH_ROOT', dirname(__FILE__));
require_once(OAUTH_ROOT.'/config.php');
define('OAUTH_ROOT_URL', 'http://'.$_SERVER['SERVER_NAME'].rtrim(dirname(GetCurUrl()),'\\/'));
**/
class Opent{
    private $_strategy;
    
    public function __construct($strategy){
        
        $this->_strategy = $strategy;
    }
    
    public function show_user( $uid_or_name = null ){

         return $this->_strategy->show_user( $uid_or_name);    
    }
    function follow( $uid_or_name ){
        $uid =  $uid_or_name;
        return $this->_strategy->follow($uid);
    
    }
    function followers( $cursor = false , $count = false , $uid_or_name = null ) 
    { 
        return $this->_strategy->followers( $cursor = false , $count = false , $uid_or_name = null ); 
    }
    public function friends($cursor, $count, $uid_or_name){
        return $this->_strategy->friends($cursor, $count, $uid_or_name);      
    }
    /**
     * 不带图发微博
     */         
    function update($text) 
    { 
        return $this->_strategy->update($text);
    }
    /**
     * 带图发微博
     */         
    function upload( $text , $pic_path ) 
    { 
        return $this->_strategy->upload( $text , $pic_path );
    }     
    
    
    
    public function friends_timeline(){
        return $this->_strategy->friends_timeline();
    }
    public function verify_credentials(){    
        return $this->_strategy->verify_credentials();
    }
    
}



////$weibo = new Opent(new OpentSohu);
//$f =  $weibo->followers();
//$weibo->update('test,test');
//$sweibo = new Opent(new OpentSina);

/////$weibo->upload('大发生的发生','http://i2.itc.cn/20110421/5dc_1bd4078a_461c_6311_64e2_df60ed2fd2c0_1.jpg');

//require_once('OpentSina.php');
//var_dump($weibo);
?>
