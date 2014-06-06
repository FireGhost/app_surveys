<?php
/* @var $this TakingController */
/* @var $taking Taking */
?>

<div class="view">
    <?php echo ($this->isLocked($taking->id) ? '<div class="view locked-element">Ce taking est verrouillé</div>' : '' ); ?>
    <?php echo CHtml::beginForm(array('saveAnswers', 'id' => $taking->id)); ?>
    <b><?php echo CHtml::encode($taking->survey->title); ?></b><br />
    <?php echo CHtml::encode($taking->comment); ?><br />
    <?php
        foreach ($taking->survey->questionGroups as $questionGroup) {
            echo CController::renderPartial("//questionGroups/viewRespondent", array('questionGroup'=>$questionGroup));
        }
    ?>
    <?php echo (! $this->isLocked($taking->id) ? CHtml::submitButton('Envoyer') : ''); ?>
    <?php echo CHtml::endForm(); ?>
</div>