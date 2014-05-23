<?php
/* @var $this QuestionController */
/* @var $question Question */
?>

<div class="view">

	<b>Question</b>
	<br />
	<?php echo CHtml::link(CHtml::encode('Modifier'), array('questions/update', 'id'=>$question->id)); ?>
	<?php echo CHtml::link(CHtml::encode('Supprimer'), array('questions/delete', 'id'=>$question->id)); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('Titre')); ?>:</b>
	<?php echo CHtml::encode($question->title); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($question->type); ?>
	<br />

	<b><?php echo CHtml::encode($question->getAttributeLabel('Options')); ?>:</b>
	<?php echo CHtml::encode($question->settings); ?>
	<br />

	<?php
		foreach ($question->propositions as $proposition) {
			echo CController::renderPartial("//propositions/view", array('proposition'=>$proposition));
		}
	?>

	<?php echo CHtml::link("Nouvelle proposition", array('questions/' . $question->id . '/propositions/create')); ?>

</div>