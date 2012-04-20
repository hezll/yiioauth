<?php
$this->breadcrumbs=array(
	'Categories',
);

$this->menu=array(
	array('label'=>'添加分类', 'url'=>array('create')),
	array('label'=>'分类管理', 'url'=>array('admin')),
);
?>

<h1>Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
