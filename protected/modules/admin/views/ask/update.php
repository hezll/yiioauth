<?php
$this->breadcrumbs=array(
	'Asks'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ask', 'url'=>array('index')),
	array('label'=>'Create Ask', 'url'=>array('create')),
	array('label'=>'View Ask', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ask', 'url'=>array('admin')),
);
?>

<h1>Update Ask <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>