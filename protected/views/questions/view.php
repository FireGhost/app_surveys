<?php
/* @var $this QuestionController */
/* @var $question Question */
?>

<div class="view">

	<b><?php echo CHtml::encode($question->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($question->id), array('questions/view', 'id'=>$question->id)); ?>
	<br />
	<?php echo CHtml::link(CHtml::encode('Delete'), array('questions/delete', 'id'=>$question->id)); ?>
    <?php echo CHtml::link(CHtml::encode('Update'), array('questions/update', 'id'=>$question->id)); ?>
	<br />
	<b><?php echo CHtml::encode($question->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($question->type); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('question_group_id')); ?>:</b>
	<?php echo CHtml::encode($question->question_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($question->title); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($question->position); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('settings')); ?>:</b>
	<?php echo CHtml::encode($question->settings); ?>
	<br />

	<?php
		foreach ($question->propositions as $proposition) {
			echo CController::renderPartial("//propositions/view", array('proposition'=>$proposition));
		}
	?>

	<?php echo CHtml::link("New Proposition", array('questions/' . $question->id . '/propositions/create')); 
	// TODO : don't show for some type of questions? Depending on the number of propositions? ?>

</div>