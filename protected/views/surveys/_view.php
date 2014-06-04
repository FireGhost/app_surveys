<?php
/* @var $this SurveyController */
/* @var $data Survey */
?>
<?php $locked = $data->hasStartedTakings() ?>
<div class="view <?php echo ($locked ? 'locked-survey' : '');?>">
	<?php 
		if(!$locked) {
			echo CHtml::link("Détails", array('view', 'id'=>$data->id)) . " " .
		  	     CHtml::link("Supprimer", array('delete', 'id'=>$data->id)) . "<br />";
		}
		else {
			echo "Sondage vérouillé. <br />";
		}
	?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Titre')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Créé pour')); ?>:</b>
	<?php echo CHtml::encode($data->createdforname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Créé par')); ?>:</b>
	<?php echo CHtml::encode($data->createdbyname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Date de création')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Modifié par')); ?>:</b>
	<?php echo CHtml::encode($data->updatedbyname); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Date de modification')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

</div>