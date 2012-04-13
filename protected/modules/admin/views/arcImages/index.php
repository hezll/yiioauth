<?php
$this->breadcrumbs=array(
	'Arc Images',
);

$this->menu=array(
	array('label'=>'Create ArcImages', 'url'=>array('create')),
	array('label'=>'Manage ArcImages', 'url'=>array('admin')),
);
?>

<h1>Arc Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
