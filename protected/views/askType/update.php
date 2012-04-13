<?php
$this->breadcrumbs=array(
	'Ask Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AskType', 'url'=>array('index')),
	array('label'=>'Create AskType', 'url'=>array('create')),
	array('label'=>'View AskType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AskType', 'url'=>array('admin')),
);
?>

<h1>Update AskType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>