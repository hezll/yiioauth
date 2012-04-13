<?php
$this->breadcrumbs=array(
	'Arc Images'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArcImages', 'url'=>array('index')),
	array('label'=>'Create ArcImages', 'url'=>array('create')),
	array('label'=>'View ArcImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ArcImages', 'url'=>array('admin')),
);
?>

<h1>Update ArcImages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>