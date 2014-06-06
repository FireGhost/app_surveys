<?php
/* @var $this TakingsController */
/* @var $proposition Propositions */

    $isLocked = $this->isLocked($_GET['id']);


    echo CHtml::encode($proposition->title);
    
    if ($proposition->type == "OpenedProposition")
        echo ': '. CHtml::textField('UserInputs['. $proposition->question->id .']['. $proposition->id .']', '', array('disabled' => ($isLocked ? 'disabled' : '') ));
?>