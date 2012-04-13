<?php
$this->breadcrumbs=array(
	'Ask Types',
);

$this->menu=array(
	array('label'=>'Create AskType', 'url'=>array('create')),
	array('label'=>'Manage AskType', 'url'=>array('admin')),
);
?>

<h1>Ask Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
