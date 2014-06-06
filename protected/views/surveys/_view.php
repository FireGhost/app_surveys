<?php
/* @var $this SurveyController */
/* @var $data Survey */
?>
<?php $locked = $data->hasStartedTakings() ?>
<div class="view <?php echo ($locked ? 'locked-element' : '');?>">
	<?php 
		if(!$locked) {
			echo CHtml::link("<img ", array('view', 'id'=>$data->id)) . " " .
		  	     CHtml::link("Supprimer", array('delete', 'id'=>$data->id)) . "<br />"; //add icons
		  	$title = "Détails du sondage";
		}
		else {
			$title = "Sondage vérouillé";
		}
	?>
	<?php echo CHtml::link("<h4>".CHtml::encode($data->title)."</h4>", array('view', 'id'=>$data->id), array('title'=>$title)); ?>
	<?php echo CHtml::encode($data->description); ?>

</div>