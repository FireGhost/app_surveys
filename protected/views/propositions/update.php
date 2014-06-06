<?php
    
    echo CHtml::beginForm();
        echo CHtml::label('Titre de la proposition', 'Proposition[title]');
        echo CHtml::textField('Proposition[title]', $proposition->title);
        echo '<br/>';
        echo CHtml::textField('Proposition[position]', $proposition->position);
        echo '<br/>';
        echo CHtml::label('Format de la proposition', 'Proposition[answer_format]');
        echo CHtml::textField('Proposition[answer_format]', $proposition->answer_format);
        echo '<br/>';
        echo CHtml::submitButton('Mettre à jour');
    echo CHtml::endForm();
    
?>