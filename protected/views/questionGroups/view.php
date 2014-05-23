<?php
/* @var $this QuestionGroupController */
/* @var $questionGroup QuestionGroup */
?>

<div class="view">
	<b>Groupe de questions</b>
	<br />
	<?php echo CHtml::link("Modifier", array('questionGroups/update', 'id'=>$questionGroup->id));?>
	<?php echo CHtml::link("Supprimer", array('questionGroups/delete', 'id'=>$questionGroup->id));?>
	<br />

	<b><?php echo CHtml::encode($questionGroup->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($questionGroup->title); ?>
	<br />

	<br />
	<!-- TODO: Add a button and dropdown list/filter to add an existing question in the group? -->
	<?php
		foreach ($questionGroup->questions as $question) {
			echo CController::renderPartial("//questions/view", array('question'=>$question));
		}
	?>

	<?php echo CHtml::link("Nouvelle question", array('groups/' . $questionGroup->id . '/questions/create')); ?>

</div>