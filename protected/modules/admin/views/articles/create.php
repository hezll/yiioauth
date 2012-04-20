<?php
$this->breadcrumbs=array(
	'文章'=>array('admin'),
	'发布',
);

$this->menu=array(
	array('label'=>'文章管理', 'url'=>array('admin')),
);
?>

<h1>发布文章</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'arcmodel' => $arcmodel, 'categorymodel' => $categorymodel)); ?>