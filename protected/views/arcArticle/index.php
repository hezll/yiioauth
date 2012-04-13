<?php
$this->breadcrumbs=array(
	'Arc Articles',
);

$this->menu=array(
	array('label'=>'Create ArcArticle', 'url'=>array('create')),
	array('label'=>'Manage ArcArticle', 'url'=>array('admin')),
);
?>

<h1>Arc Articles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
