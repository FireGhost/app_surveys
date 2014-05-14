<?php
    echo CHtml::beginForm();
        echo CHtml::label('Titre de la question', 'Question[title]');
        echo CHtml::textField('Question[title]', $question->title);
        echo '<br/>';
        echo CHtml::label('Position de la question', 'Question[position]');
        echo CHtml::textField('Question[position]', $question->position);
        echo '<br/>';
        echo CHtml::label('Options de la question', 'Question[settings]');
        echo CHtml::textField('Question[settings]', $question->settings);
        echo '<br/>';
        echo CHtml::submitButton('Mettre à jour');
        echo CHtml::link('Supprimer', array('questions/delete', 'id'=>$question->id));

    echo CHtml::endForm();
?>
