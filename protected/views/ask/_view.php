<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asktype_id')); ?>:</b>
	<?php echo CHtml::encode($data->asktype_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asktype_subid')); ?>:</b>
	<?php echo CHtml::encode($data->asktype_subid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_del')); ?>:</b>
	<?php echo CHtml::encode($data->is_del); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_top')); ?>:</b>
	<?php echo CHtml::encode($data->is_top); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_recommend')); ?>:</b>
	<?php echo CHtml::encode($data->is_recommend); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('answer_count')); ?>:</b>
	<?php echo CHtml::encode($data->answer_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visit_count')); ?>:</b>
	<?php echo CHtml::encode($data->visit_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastanswer_time')); ?>:</b>
	<?php echo CHtml::encode($data->lastanswer_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expired_time')); ?>:</b>
	<?php echo CHtml::encode($data->expired_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('solve_time')); ?>:</b>
	<?php echo CHtml::encode($data->solve_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>