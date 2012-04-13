<?php
$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Articles', 'url'=>array('index')),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
?>

<h1>Create Articles</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>