<?php
$this->breadcrumbs=array(
	'Asks'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Ask', 'url'=>array('index')),
	array('label'=>'Create Ask', 'url'=>array('create')),
	array('label'=>'Update Ask', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ask', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ask', 'url'=>array('admin')),
);
?>

<h1>View Ask #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'asktype_id',
		'asktype_subid',
		'title',
		'content',
		'uid',
		'username',
		'is_del',
		'is_top',
		'is_recommend',
		'status',
		'answer_count',
		'visit_count',
		'lastanswer_time',
		'expired_time',
		'solve_time',
		'ip',
		'created',
		'modified',
	),
)); ?>
