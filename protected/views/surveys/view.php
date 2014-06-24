<h1>View Survey #<?php echo $survey->id; ?></h1>
	<?php echo CHtml::link("Modifier", array('update', 'id'=>$survey->id)); ?>
	<?php echo CHtml::link("Supprimer", array('delete', 'id'=>$survey->id)); ?>
	<?php $locked = $survey->hasStartedTakings() ?>
	<?php 
		if(!$locked) {
            echo CHtml::link("Créer un taking", array('surveys/' . $survey->id . '/takings/create')); 
        }
    ?>


<div class="view">
	<b><?php echo CHtml::encode($survey->getAttributeLabel('Titre')); ?>:</b>
	<?php echo CHtml::encode($survey->title); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($survey->description); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('Créé pour')); ?>:</b>
	<?php echo CHtml::encode($survey->createdforname); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('Créé par')); ?>:</b>
	<?php echo CHtml::encode($survey->createdbyname); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('Date de création')); ?>:</b>
	<?php echo CHtml::encode($survey->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('Modifié par')); ?>:</b>
	<?php echo CHtml::encode($survey->updatedbyname); ?>
	<br />
	
	<b><?php echo CHtml::encode($survey->getAttributeLabel('Date de modification')); ?>:</b>
	<?php echo CHtml::encode($survey->updated_at); ?>
	<br /><br />

<?php
	foreach ($survey->questionGroups as $questionGroup) {
		echo CController::renderPartial("//questionGroups/view", array('questionGroup'=>$questionGroup));
	}
  ?>
  <?php echo CHtml::link("Nouveau groupe de questions", array('surveys/' . $survey->id . '/questionGroups/create')); ?>
  
</div>
