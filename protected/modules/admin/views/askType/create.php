<?php
$this->breadcrumbs=array(
	'问答类型'=>array('index'),
	'添加',
);

$this->menu=array(
	array('label'=>'类型管理', 'url'=>array('admin')),
);
?>

<h1>新增类型</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>