<?php
$this->breadcrumbs=array(
	'Ask Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AskType', 'url'=>array('index')),
	array('label'=>'Create AskType', 'url'=>array('create')),
	array('label'=>'Update AskType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AskType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AskType', 'url'=>array('admin')),
);
?>

<h1>View AskType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pid',
		'typename',
		'is_del',
		'sort',
		'created',
		'modified',
	),
)); ?>
