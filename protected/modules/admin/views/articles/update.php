<?php
$this->breadcrumbs=array(
	'文章'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'编辑',
);

$this->menu=array(
    array('label'=>'发布文章', 'url'=>array('create')),
	array('label'=>'编辑文章', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'文章详情', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'文章管理', 'url'=>array('admin')),
);
?>

<h1>编辑文章</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'arcmodel' => $arcmodel, 'categorymodel' => $categorymodel)); ?>