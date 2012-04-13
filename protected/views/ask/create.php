<?php
$this->breadcrumbs=array(
	'Asks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ask', 'url'=>array('index')),
	array('label'=>'Manage Ask', 'url'=>array('admin')),
);
?>

<h1>Create Ask</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>