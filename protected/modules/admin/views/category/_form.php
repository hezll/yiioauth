<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"> <span class="required">*</span>必填项</p>

	<?php echo $form->errorSummary($model); ?>

	<?php if ($model->isNewRecord):?>
	<div class="row width1">
        <label class="required" for="Category_top_typename">
            隶属分类    
            <span class="required">*</span>
        </label>
        <select id="Category_top_typename" name="Category[pid]">
			<option value="0">顶级分类</option>
            <?php
				$this->widget('CategoryList',
							  array(
									'model' => $model,
									'condition' => 'is_del=0 AND pid=0',
								)
							);
			?>
        </select>
    </div>
	<?php endif;?>

	<div class="row width1">
		<?php echo $form->labelEx($model,'typename'); ?>
		<?php echo $form->textField($model,'typename',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'typename'); ?>
	</div>

	<div class="row width1">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->