<?php
$this->breadcrumbs=array(
	'分类'=>array('admin'),
	'添加',
);

$this->menu=array(
	array('label'=>'分类管理', 'url'=>array('admin')),
);
?>

<h1>添加分类</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>