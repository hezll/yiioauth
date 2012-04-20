<?php
$this->breadcrumbs=array(
	'问答类型'=>array('admin'),
	'编辑',
);

$this->menu=array(
	array('label'=>'List AskType', 'url'=>array('index')),
	array('label'=>'Create AskType', 'url'=>array('create')),
	array('label'=>'View AskType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AskType', 'url'=>array('admin')),
);
?>

<h1>编辑类型 - <?php echo $model->typename; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>