<?php
$this->breadcrumbs=array(
	'问答类型'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'添加类型', 'url'=>array('create')),
	array('label'=>'管理类型', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ask-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>类型管理</h1>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ask-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'pid',
		'typename',
		'sort',
		'created',
		/*
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
