<?php
$this->breadcrumbs=array(
	'Arc Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArcArticle', 'url'=>array('index')),
	array('label'=>'Manage ArcArticle', 'url'=>array('admin')),
);
?>

<h1>Create ArcArticle</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>