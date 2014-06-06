<?php

    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery.datetimepicker.js');
    $cs->registerCssFile($baseUrl.'/css/datetimepicker.css');

    echo CHtml::beginForm();

        echo CHtml::label('Commentaire', 'Taking[comment]');
        echo CHtml::textField('Taking[comment]', $taking->comment);
        echo '<br/>';

        echo CHtml::label('Anonyme', 'Taking[anonymous]');
        echo CHtml::textField('Taking[anonymous]', $taking->anonymous);
        echo '<br/>';

        echo CHtml::label('Début', 'Taking[starts_at]');
        echo CHtml::textField('Taking[starts_at]', date('d.m.Y H:i:s',strtotime($taking->starts_at)));

        echo '<br/>';
        echo CHtml::label('Fin', 'Taking[ends_at]');
        echo CHtml::textField('Taking[ends_at]', date('d.m.Y H:i:s',strtotime($taking->ends_at)));
 
        echo '<br/>';
        echo CHtml::submitButton('Mettre à jour');

    echo CHtml::endForm();
?>
<script>
    jQuery('#Taking_starts_at').datetimepicker({
        lang:'fr',
        format:'d.m.Y H:i:s'    
    });
    jQuery('#Taking_ends_at').datetimepicker({
        lang:'fr',
        format:'d.m.Y H:i:s'    
    });
</script>