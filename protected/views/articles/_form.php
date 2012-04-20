<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_path'); ?>
		<?php echo $form->textField($model,'category_path',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'category_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thumb'); ?>
		<?php echo $form->textField($model,'thumb',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'thumb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flag'); ?>
		<?php echo $form->textField($model,'flag',array('size'=>0,'maxlength'=>0)); ?>
		<?php echo $form->error($model,'flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'redirecturl'); ?>
		<?php echo $form->textField($model,'redirecturl',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'redirecturl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visit_count'); ?>
		<?php echo $form->textField($model,'visit_count'); ?>
		<?php echo $form->error($model,'visit_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textField($model,'seo_keywords',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textField($model,'seo_title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->