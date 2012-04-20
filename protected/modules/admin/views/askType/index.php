<?php
$this->breadcrumbs=array(
	'问答类型',
);

$this->menu=array(
	array('label'=>'添加类型', 'url'=>array('create')),
	array('label'=>'管理类型', 'url'=>array('admin')),
);
?>

<h1>类型</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
