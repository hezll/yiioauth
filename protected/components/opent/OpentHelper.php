<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class OpentHelper{
    public static function getUrl($platform){
        if(isset($platform)){
            $o = new WeiboOAuth($platform);
            $keys = $o->getRequestToken(($platform=='qq')?'http://'.$_SERVER['HTTP_HOST']. Yii::app()->createUrl('account/callback',array('platform'=>$platform)):'');           
            $aurl = $o->getAuthorizeURL($keys['oauth_token'] ,false , 'http://'.$_SERVER['HTTP_HOST']. Yii::app()->createUrl('account/callback',array('platform'=>$platform))); 
            Yii::app()->session->add($platform.'keys',$keys); 
            return $aurl;
        }else{
            throw new Exception('平台没有定义！');
        }
    }
    public static function getUrls(){
        foreach(Yii::app()->params['oauth'] as $platform=>$val){
           $aurl[$platform] = self::getUrl($platform);         
        }
        return $aurl;            
    }
}

