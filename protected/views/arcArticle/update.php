<?php
$this->breadcrumbs=array(
	'Arc Articles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ArcArticle', 'url'=>array('index')),
	array('label'=>'Create ArcArticle', 'url'=>array('create')),
	array('label'=>'View ArcArticle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ArcArticle', 'url'=>array('admin')),
);
?>

<h1>Update ArcArticle <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>