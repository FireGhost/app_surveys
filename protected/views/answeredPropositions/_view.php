<?php
/* @var $this AnsweredPropositionsController */
/* @var $data AnsweredPropositions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('answer_id')); ?>:</b>
	<?php echo CHtml::encode($data->answer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proposition_id')); ?>:</b>
	<?php echo CHtml::encode($data->proposition_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('body')); ?>:</b>
	<?php echo CHtml::encode($data->body); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />


</div>