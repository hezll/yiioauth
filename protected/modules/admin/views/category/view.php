<?php
$this->breadcrumbs=array(
	'分类'=>array('admin'),
    '详情'
);

$this->menu=array(
	array('label'=>'添加分类', 'url'=>array('create')),
    array('label'=>'编辑分类', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'删除分类', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除吗？该操作不可恢复')),
	array('label'=>'管理分类', 'url'=>array('admin')),
);
?>

<h1>分类详情</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'topid',
		'pid',
		'typename',
		'sort',
		'created',
		'modified',
	),
)); ?>
