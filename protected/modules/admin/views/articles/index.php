<?php
$this->breadcrumbs=array(
	'Articles',
);

$this->menu=array(
	array('label'=>'发布文章', 'url'=>array('create')),
	array('label'=>'文章管理', 'url'=>array('admin')),
);
?>

<h1>Articles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
