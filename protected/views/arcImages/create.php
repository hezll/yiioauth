<?php
$this->breadcrumbs=array(
	'Arc Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ArcImages', 'url'=>array('index')),
	array('label'=>'Manage ArcImages', 'url'=>array('admin')),
);
?>

<h1>Create ArcImages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>