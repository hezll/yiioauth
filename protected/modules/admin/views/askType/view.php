<?php
$this->breadcrumbs=array(
	'问答类型'=>array('admin'),
	'详情',
);

$this->menu=array(
	array('label'=>'添加类型', 'url'=>array('create')),
	array('label'=>'编辑类型', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除类型', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'类型管理', 'url'=>array('admin')),
);
?>

<h1>类型</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pid',
		'typename',
		'sort',
		'created',
		'modified',
	),
)); ?>
