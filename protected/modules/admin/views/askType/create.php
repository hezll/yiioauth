<?php
$this->breadcrumbs=array(
	'Ask Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AskType', 'url'=>array('index')),
	array('label'=>'Manage AskType', 'url'=>array('admin')),
);
?>

<h1>Create AskType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>