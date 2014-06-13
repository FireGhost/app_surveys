<?php

    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/css/chosen.min.css');

    echo CHtml::beginForm();
        echo CHtml::label('Titre du sondage', 'Survey[title]');
        echo CHtml::textField('Survey[title]', '');
        echo CHtml::label('Description du sondage', 'Survey[description]');
        echo CHtml::textField('Survey[description]', '');
        
        echo CHtml::label('Pour qui créez-vous ce sondage?', 'Survey[created_for_id]');
        echo CHtml::dropDownList('Survey[created_for_id]', null, $users, array('class'=>'chosen-select'));

        echo CHtml::submitButton('Envoyer');
    echo CHtml::endForm();
    echo '<script type="text/javascript">$(".chosen-select").chosen({allow_single_deselect:true})</script>'
?>