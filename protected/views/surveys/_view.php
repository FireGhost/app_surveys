<?php
/* @var $this SurveyController */
/* @var $data Survey */
?>

<div class="view">
	<?php echo CHtml::link("View", array('view', 'id'=>$data->id)); ?>
	<?php echo CHtml::link("Update", array('update', 'id'=>$data->id)); ?>
	<?php echo CHtml::link("Delete", array('delete', 'id'=>$data->id)); ?>
	<br />
	<?php echo ($data->hasStartedTakings() ? 'LOCKED' : ''); //TODO : in the end we should just add a class to the div and color the background in red?><br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_for_id')); ?>:</b>
	<?php echo CHtml::encode($data->created_for_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by_id')); ?>:</b>
	<?php echo CHtml::encode($data->created_by_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by_id')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by_id); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

</div>