<?php
/* @var $this TakingController */
/* @var $taking Taking */
?>

<div class="view">
    <?php 
	echo CHtml::link("Update", array('takings/update', 'id'=>$taking->id));
	?>
    <br />
    <b><?php echo CHtml::encode($taking->survey->title); ?></b>
    <br />
    <?php echo CHtml::encode($taking->comment); ?><br />
    <?php
        foreach ($taking->survey->questionGroups as $questionGroup) {
            echo CController::renderPartial("//questionGroups/viewRespondent", array('questionGroup'=>$questionGroup));
        }
    ?>
</div>