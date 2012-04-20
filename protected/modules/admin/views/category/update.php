<?php
$this->breadcrumbs=array(
	'分类'=>array('admin'),
	'编辑',
);

$this->menu=array(
	array('label'=>'添加分类', 'url'=>array('create')),
	array('label'=>'分类详情', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理分类', 'url'=>array('admin')),
);
?>

<h1>编辑分类 - <?php echo $model->typename; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>