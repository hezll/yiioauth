<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"> <span class="required">*</span>必填项</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($arcmodel); ?>

	
	<div class="row width1">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    
    <div class="row width1">
        <label class="required" for="Category_top_typename">
            文章分类    
            <span class="required">*</span>
        </label>
        <select id="Category_top_typename" name="Articles[category_id]">
            <?php
				$this->widget('CategoryList',
							  array(
									'model' => $categorymodel,
									'condition' => 'is_del=0',
								)
							);
			?>
        </select>
    </div>

	<div class="row width1">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>
    
	<div class="row width1">
		<?php echo $form->labelEx($model,'thumb'); ?>
		<?php echo $form->fileField($model,'thumb',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'thumb'); ?>
	</div>
    
    <?php if ($model->thumb):?>
	<div class="row width1">
        <label for="Articles_thumb">&nbsp;</label>
		<?php echo CHtml::image($model->thumb); ?>
	</div>
    <?php endif;?>
    
	<div class="row width1">
		<?php echo $form->labelEx($model,'flag'); ?>
		<?php echo $form->textField($model,'flag',array('size'=>0,'maxlength'=>0)); ?>
		<?php echo $form->error($model,'flag'); ?>
	</div>

	<div class="row width1">
		<?php echo $form->labelEx($model,'redirecturl'); ?>
		<?php echo $form->textField($model,'redirecturl',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'redirecturl'); ?>
	</div>
	<div class="row width1">
        <label class="required" for="Category_top_typename">
            内容    
            <span class="required">*</span>
        </label>
		<div style="margin-left:80px;">
		<?php
		$this->widget('application.extensions.ckeditor.CKEditorWidget', array(
			'model'=>$model,
			'name'=>'content',
			'value' => isset($model->arcArticles) ? $model->arcArticles->content : '',
		));
		?>
		</div>
	</div>
	<div class="row width1">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '保存' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->