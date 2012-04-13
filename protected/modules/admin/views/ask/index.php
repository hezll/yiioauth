<?php
$this->breadcrumbs=array(
	'Asks',
);

$this->menu=array(
	array('label'=>'Create Ask', 'url'=>array('create')),
	array('label'=>'Manage Ask', 'url'=>array('admin')),
);
?>

<h1>Asks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
