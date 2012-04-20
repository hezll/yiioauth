<?php
$this->breadcrumbs=array(
	'文章'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'发布文章', 'url'=>array('create')),
	array('label'=>'编辑文章', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除文章', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'文章管理', 'url'=>array('admin')),
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/detailview/style.css" />
<h1>文章详情</h1>

<table id="yw0" class="detail-view">
    <tbody>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></th>
        <td><?php echo CHtml::encode($model->id); ?></td>
    </tr>
    <tr class="even">
        <th><?php echo CHtml::encode($model->getAttributeLabel('category_id')); ?></th>
        <td><?php echo CHtml::encode($model->category->typename); ?></td>
    </tr>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->getAttributeLabel('title')); ?></th>
        <td><?php echo CHtml::encode($model->title); ?></td>
    </tr>
    <tr class="even">
        <th><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
        <td><?php echo CHtml::encode($model->username); ?></td>
    </tr>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->getAttributeLabel('author')); ?></th>
        <td><?php echo CHtml::encode($model->author); ?></td>
    </tr>
    <tr class="even">
        <th><?php echo CHtml::encode($model->getAttributeLabel('thumb')); ?></th>
        <td><?php echo CHtml::image($model->thumb); ?></td>
    </tr>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->getAttributeLabel('flag')); ?></th>
        <td><?php echo CHtml::encode($model->flag); ?></td>
    </tr>
    <tr class="even">
        <th><?php echo CHtml::encode($model->getAttributeLabel('redirecturl')); ?></th>
        <td><?php echo CHtml::encode($model->redirecturl); ?></td>
    </tr>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->getAttributeLabel('visit_count')); ?></th>
        <td><?php echo CHtml::encode($model->visit_count); ?></td>
    </tr>
    <tr class="even">
        <th><?php echo CHtml::encode($model->getAttributeLabel('description')); ?></th>
        <td><?php echo CHtml::encode($model->description); ?></td>
    </tr>
    <?php if ($model->arcArticles !== null):?>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->arcArticles->getAttributeLabel('content')); ?></th>
        <td><?php echo CHtml::decode($model->arcArticles->content); ?></td>
    </tr>
    <?php endif;?>
    <tr class="even">
        <th><?php echo CHtml::encode($model->getAttributeLabel('created')); ?></th>
        <td><?php echo Yii::app()->format->formatDateTime($model->created); ?></td>
    </tr>
    <tr class="odd">
        <th><?php echo CHtml::encode($model->getAttributeLabel('modified')); ?></th>
        <td><?php if ($model->modified) echo Yii::app()->format->formatDateTime($model->modified); ?></td>
    </tr>
    </tbody>
</table>
<?php
//$this->widget('zii.widgets.CDetailView', array(
//	'data'=>$model,
//	'attributes'=>array(
//		'id',
//		'category_id',
//		'title',
//		'username',
//		'author',
//        'thumb:image',
//		'flag',
//		'redirecturl',
//		'visit_count',
//		'description',
//		'created:datetime',
//		'modified:datetime',
//	),
//));
?>
