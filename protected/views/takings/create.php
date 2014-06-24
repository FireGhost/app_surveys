<?php

	$baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/chosen.jquery.min.js');
    $cs->registerCssFile($baseUrl.'/css/chosen.min.css');
	
    $cs->registerScriptFile($baseUrl.'/js/jquery.datetimepicker.js');
    $cs->registerCssFile($baseUrl.'/css/datetimepicker.css');

	
    echo CHtml::beginForm();
    	echo CHtml::label('Enquête anonyme ?', 'Taking[anonymous]'); // TODO : Touver une meilleure définition en Français
    	echo CHtml::radioButtonList('Taking[anonymous]', '0', ['0'=>'Non', '1'=>'Oui']);
        echo CHtml::label("Commentaire", 'Taking[comment]');
        echo CHtml::textField('Taking[comment]', '');
        echo CHtml::label('Date de début', 'Taking[starts_at]');
        echo CHtml::textField('Taking[starts_at]', '0000-00-00 00:00');

        echo CHtml::encode('Participants');
        //radiobuttons select participants type (students, collaborators, classes, (sections/schools?))

        //Classes
        echo CHtml::label('Ajouter des classes', 'Taking[target_classes]');
        echo CHtml::listBox('Taking[target_classes]', null, $targetClasses, array('class'=>'chosen-select target-classes', 'multiple'=>'true', 'style'=>'width:350px;'));

        //People
        //echo CHtml::label('Ajouter des personnes', 'Taking[target_people]');
        //chkbx students/collaborators
        //http://intranet.cpnv.ch/classes/1243.xml?alter[include]=students


        echo CHtml::submitButton('Envoyer');
    echo CHtml::endForm();
    echo '<script type="text/javascript">$(".chosen-select").chosen({})</script>';
?>

<script>
    jQuery('#Taking_starts_at').datetimepicker({
        lang:'fr',
        format:'d.m.Y H:i:s'    
    });
</script>