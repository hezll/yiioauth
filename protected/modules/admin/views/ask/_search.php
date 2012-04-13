<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asktype_id'); ?>
		<?php echo $form->textField($model,'asktype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asktype_subid'); ?>
		<?php echo $form->textField($model,'asktype_subid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_del'); ?>
		<?php echo $form->textField($model,'is_del'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_top'); ?>
		<?php echo $form->textField($model,'is_top'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_recommend'); ?>
		<?php echo $form->textField($model,'is_recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'answer_count'); ?>
		<?php echo $form->textField($model,'answer_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visit_count'); ?>
		<?php echo $form->textField($model,'visit_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastanswer_time'); ?>
		<?php echo $form->textField($model,'lastanswer_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expired_time'); ?>
		<?php echo $form->textField($model,'expired_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'solve_time'); ?>
		<?php echo $form->textField($model,'solve_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->