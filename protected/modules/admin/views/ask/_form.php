<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ask-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'asktype_id'); ?>
		<?php echo $form->textField($model,'asktype_id'); ?>
		<?php echo $form->error($model,'asktype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'asktype_subid'); ?>
		<?php echo $form->textField($model,'asktype_subid'); ?>
		<?php echo $form->error($model,'asktype_subid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_del'); ?>
		<?php echo $form->textField($model,'is_del'); ?>
		<?php echo $form->error($model,'is_del'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_top'); ?>
		<?php echo $form->textField($model,'is_top'); ?>
		<?php echo $form->error($model,'is_top'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_recommend'); ?>
		<?php echo $form->textField($model,'is_recommend'); ?>
		<?php echo $form->error($model,'is_recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'answer_count'); ?>
		<?php echo $form->textField($model,'answer_count'); ?>
		<?php echo $form->error($model,'answer_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visit_count'); ?>
		<?php echo $form->textField($model,'visit_count'); ?>
		<?php echo $form->error($model,'visit_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastanswer_time'); ?>
		<?php echo $form->textField($model,'lastanswer_time'); ?>
		<?php echo $form->error($model,'lastanswer_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expired_time'); ?>
		<?php echo $form->textField($model,'expired_time'); ?>
		<?php echo $form->error($model,'expired_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'solve_time'); ?>
		<?php echo $form->textField($model,'solve_time'); ?>
		<?php echo $form->error($model,'solve_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->