<h1>View Survey #<?php echo $survey->id; ?></h1>
	<?php echo CHtml::link("Modifier", array('update', 'id'=>$survey->id)); ?>
	<?php echo CHtml::link("Supprimer", array('delete', 'id'=>$survey->id)); ?>


<div class="view">
	<b><?php echo CHtml::encode($survey->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($survey->title); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($survey->description); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('created_for_id')); ?>:</b>
	<?php echo CHtml::encode($survey->created_for_id); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('created_by_id')); ?>:</b>
	<?php echo CHtml::encode($survey->created_by_id); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($survey->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($survey->getAttributeLabel('updated_by_id')); ?>:</b>
	<?php echo CHtml::encode($survey->updated_by_id); ?>
	<br />
	
	<b><?php echo CHtml::encode($survey->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($survey->updated_at); ?>
	<br /><br />

<?php
	foreach ($survey->questionGroups as $questionGroup) {
		echo CController::renderPartial("//questionGroups/view", array('questionGroup'=>$questionGroup));
	}
  ?>
  <?php echo CHtml::link("Nouveau groupe de questions", array('surveys/' . $survey->id . '/questionGroups/create')); ?>
  
</div>
