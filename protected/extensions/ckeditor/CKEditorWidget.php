<?php
class CKEditorWidget extends CInputWidget
{

    public $ckEditor;
    public $ckFinder;
    public $ckBasePath;
    public $name = 'content';
    public $value;
    public $default_config = array('width' => 680, 'height' => 300);
    public $config = array();
    
    public function run()
    {
        if (empty($this->model) || !is_object($this->model))
        {
            throw new CHttpException(500, 'model is not object');
        }
        
        
        $this->ckFinder = Yii::app()->basePath."/../ckfinder/ckfinder.php";
        $this->ckEditor = Yii::app()->basePath."/../ckeditor/ckeditor.php";
        $this->ckBasePath = Yii::app()->baseUrl."/ckeditor/";
        
        $this->config = array_merge($this->default_config, $this->config);
        
        $this->render('CKEditorView',array(
            "ckFinder"=>$this->ckFinder,
            "ckEditor"=>$this->ckEditor,
            "ckBasePath"=>$this->ckBasePath,
            "model"=>$this->model,
            "attribute"=>$this->name,
            "defaultValue"=>$this->value,
            "config"=>$this->config,
        ));
    }
}
?>