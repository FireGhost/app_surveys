<?php
/* @var $this PropositionsController */
/* @var $proposition Propositions */
?>

<?php
    echo CHtml::encode($proposition->title);
    
    if ($proposition->type == "OpenedProposition")
        echo ': '. CHtml::textField('userInsert_'. $proposition->id);
?>