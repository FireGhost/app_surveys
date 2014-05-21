<?php
    echo CHtml::beginForm();
        echo CHtml::label('Titre de la question', 'Question[title]');
        echo CHtml::textField('Question[title]', $question->title);
        
        echo CHtml::label('Type de question', 'Question[type]');
        echo CHtml::dropDownList('Question[type]', $question->type, array(
            'UniqueChoiceQuestion' => 'Question à choix unique',
            'MultipleChoiceQuestion' => 'Question à choix multiple',
            'RangeQuestion' => 'Etendue de nombre',
            'RankingQuestion' => 'Question à évaluer'));
        
        
        echo CHtml::label('Valeur minimum', 'Question[settings][min]', array("class" => "Question_settings_multiple_choice Question_settings_range"));
        echo CHtml::textField('Question[settings][min]', '', array("class" => "Question_settings_multiple_choice Question_settings_range"));
        
        echo CHtml::label('Valeur maximum', 'Question[settings][max]', array("class" => "Question_settings_multiple_choice Question_settings_range"));
        echo CHtml::textField('Question[settings][max]', '', array("class" => "Question_settings_multiple_choice Question_settings_range"));
        
        echo CHtml::label('Saut de valeur', 'Question[settings][step]', array("class" => "Question_settings_range"));
        echo CHtml::textField('Question[settings][step]', '', array("class" => "Question_settings_range"));
        
        
        echo CHtml::submitButton('Modifier');
    echo CHtml::endForm();
?>

<script type="text/javascript">
    
    $('#Question_type').change(function(){
        $("*[class*='Question_settings_']").val('').hide();
        
        switch( $('option:selected', this).val() )
        {
            case 'MultipleChoiceQuestion':
                $("*[class*='Question_settings_multiple_choice']").show();
                break;
            
            case 'RangeQuestion':
                $("*[class*='Question_settings_range']").show();
                break;
        }
    });
    
    $('#Question_type').trigger('change');
    
</script>
