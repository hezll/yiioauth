<?php
$this->breadcrumbs=array(
	'Arc Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ArcImages', 'url'=>array('index')),
	array('label'=>'Create ArcImages', 'url'=>array('create')),
	array('label'=>'Update ArcImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ArcImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ArcImages', 'url'=>array('admin')),
);
?>

<h1>View ArcImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'articles_id',
		'category_id',
		'images',
		'image_path',
		'content',
	),
)); ?>
