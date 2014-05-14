<?php
    echo CHtml::beginForm();
        echo CHtml::label('Titre du groupe de questions', 'QuestionGroup[title]');
        echo CHtml::textField('QuestionGroup[title]', $questionGroup->title);
        echo '<br/>';
        echo CHtml::label('Position du groupe de questions', 'QuestionGroup[position]');
        echo CHtml::textField('QuestionGroup[position]', $questionGroup->position);
        echo '<br/>';
        echo CHtml::submitButton('Mettre à jour');
    echo CHtml::endForm();
?>
