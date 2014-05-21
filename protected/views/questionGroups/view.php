<?php
/* @var $this QuestionGroupController */
/* @var $questionGroup QuestionGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($questionGroup->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($questionGroup->id), array('questionGroups/view', 'id'=>$questionGroup->id)); ?>
	<!-- TODO: Verif -->
	<br />
	<?php 
	echo CHtml::link("Update", array('questionGroups/update', 'id'=>$questionGroup->id));
	?>
	<br />
	<?php
	echo CHtml::link("Delete", array('questionGroups/delete', 'id'=>$questionGroup->id));
	?>
	<br />

	<b><?php echo CHtml::encode($questionGroup->getAttributeLabel('survey_id')); ?>:</b>
	<?php echo CHtml::encode($questionGroup->survey_id); ?>
	<br />

	<b><?php echo CHtml::encode($questionGroup->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($questionGroup->title); ?>
	<br />

	<b><?php echo CHtml::encode($questionGroup->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($questionGroup->position); ?>
	<br />
	<!-- TODO: Add a button and dropdown list/filter to add an existing question in the group? -->
	<?php
		foreach ($questionGroup->questions as $question) {
			echo CController::renderPartial("//questions/view", array('question'=>$question));
		}
	?>

	<?php echo CHtml::link("New Question", array('groups/' . $questionGroup->id . '/questions/create')); ?>

</div>