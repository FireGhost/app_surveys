<?php
/* @var $this TakingsController */
/* @var $proposition Propositions */

    $isLocked = $this->isLocked($_GET['id']);
    
    if ($answeredProposition = $proposition->answeredProposition(1)) // TODO: Get automatically the good participation id
        $value = $answeredProposition->body;
    else
        $value = '';


    echo CHtml::encode($proposition->title);
    
    if ($proposition->type == "OpenedProposition")
        echo ': '. CHtml::textField('UserInputs['. $proposition->question->id .']['. $proposition->id .']', $value, array('disabled' => ($isLocked ? 'disabled' : '') ));
?>