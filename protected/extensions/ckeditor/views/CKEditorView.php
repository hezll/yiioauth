<?php
require_once($ckEditor);
require_once($ckFinder);

$oCKeditor = new CKeditor(get_class($model).'['.$attribute.']');
$oCKeditor->basePath = $ckBasePath;

if(isset($config) && is_array($config)){
    foreach($config as $key=>$value){
        $oCKeditor->config[$key] = $value;
    }
}

CKFinder::SetupCKEditor($oCKeditor, Yii::app()->baseUrl . '/ckfinder/');
$oCKeditor->editor(get_class($model).'['.$attribute.']',$defaultValue);
?>