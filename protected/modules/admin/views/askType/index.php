<?php
$this->breadcrumbs=array(
	'�ʴ�����',
);

$this->menu=array(
	array('label'=>'�������', 'url'=>array('create')),
	array('label'=>'��������', 'url'=>array('admin')),
);
?>

<h1>����</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
