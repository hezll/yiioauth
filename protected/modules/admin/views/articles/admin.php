<?php
$this->breadcrumbs=array(
	'文章'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'发布文章', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('articles-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>文章管理</h1>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'articles-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'typename' => array(
                    'name' => 'category.typename',
                ),
		'title',
		'uid',
		'username',
		/*
		'author',
		'thumb',
		'flag',
		'redirecturl',
		'visit_count',
		'description',
		'seo_keywords',
		'seo_title',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));

?>
