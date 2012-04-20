<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
?><h2><?php echo UserModule::t('Edit profile'); ?> 如果您补全完信息，可以得到勋章哦！</h2>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>
        <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php if(!empty($model->email)):    ?>
        <?php      
            echo $model->email;   
            else:
        ?>   
	<?php echo $form->textField($model,'email'); ?>
	<?php echo $form->error($model,'email'); ?>
        <p class="hint">    
        <?php echo UserModule::t("邮箱以后不能修改，请记住！"); ?>
        </p>
         <?php endif;  ?>
        </div>
        <?php 
        if(empty($model->password)):    ?>
        <div class="row">        
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
        <?php endif; ?>
<?php 
		$profileFields=$profile->getFields();
                
		if ($profileFields) {
			foreach($profileFields as $field) {                           
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($field->widgetEdit($profile)) {
			echo $field->widgetEdit($profile);
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
