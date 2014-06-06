<?php

echo CHtml::beginForm();

        echo CHtml::label('Commentaire', 'Taking[comment]');
        echo CHtml::textField('Taking[comment]', $taking->comment);
        echo '<br/>';

        echo CHtml::label('Anonyme', 'Taking[anonymous]');
        echo CHtml::textField('Taking[anonymous]', $taking->anonymous);
        echo '<br/>';

        echo CHtml::label('Début', 'Survey[starts_at]');
        echo CHtml::textField('Survey[starts_at]', $taking->starts_at);
        echo '<br/>';

        echo CHtml::label('Fin', 'Survey[ends_at]');
        echo CHtml::textField('Survey[ends_at]', $taking->ends_at);
 
        echo '<br/>';

        echo CHtml::submitButton('Mettre à jour');
    echo CHtml::endForm();
?>