<div class="view">
<?php
    $isLocked = $this->isLocked($_GET['id']);
    
    echo '<b>'. CHtml::encode($question->title) .'</b><br />';
    
    switch ($question->type) {
        
        
        case 'UniqueChoiceQuestion':
            foreach ($question->propositions as $proposition) {
                $isChecked = ($proposition->answeredProposition(1) ? true : false); // TODO: get automatically the good participation id
                echo CHtml::radioButton('Questions['. $question->id .']', $isChecked, array('value' => $proposition->id, 'disabled' => ($isLocked ? 'disabled':'') ));
                echo ' '. CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition)) .'<br />';
            }
        break;
        
        
        
        case 'MultipleChoiceQuestion':
            foreach ($question->propositions as $proposition) {
                $isChecked = ($proposition->answeredProposition(1) ? true : false); // TODO: get automatically the good participation id
                echo CHtml::checkBox('Questions['. $question->id .']['. $proposition->id .']', $isChecked, array('value' => $proposition->id, 'disabled' => ($isLocked ? 'disabled':'')));
                echo ' '. CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition)) .'<br />';
                echo CHtml::hiddenField('Questions['. $question->id .']');
            }
        break;
        
        
        
        case 'RangeQuestion':
            
            $settings = json_decode($question->settings);
            if ( !property_exists( $settings, "min" ) )
                $settings->min = 0;
            if ( !property_exists( $settings, "max" ) )
                $settings->max = 0;
            if ( !property_exists( $settings, "step" ) )
                $settings->step = 0;
            
            
            foreach ($question->propositions as $proposition) {
                
                $answeredProposition = $proposition->answeredProposition(1); // TODO: get automatically the good participation id
                $defaultValue = ($answeredProposition ? $answeredProposition->value : $settings->min);
                
                echo CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition));
                echo '<div id="range_'. $proposition->id .'" style="width: 300px; margin-top: 3px;"></div>';
                echo '<div class="val_'. $proposition->id .'" style="margin-bottom: 2px;">'. $defaultValue .'</div>';
                if (!$isLocked) {
                    echo '<input type="hidden" name="Questions['. $question->id .']['. $proposition->id .']" class="val_'. $proposition->id .'" value="'. $defaultValue .'"/>';
                    
                    
                    $this->widget('zii.widgets.jui.CJuiSlider', array(
                        'value'=>intval($defaultValue),
                        'id'=>'range_'. $proposition->id,
                        'options'=>array(
                            'min' => intval($settings->min),
                            'max' => intval($settings->max),
                            'step' => intval($settings->step),
                            'slide'=>'js:function(event, ui) {
                                $("div.val_'. $proposition->id .'").html(ui.value);
                                $("input.val_'. $proposition->id .'").val(ui.value);
                            }'
                        )
                    ));
                }
            }
        break;
        
        
        
        case 'RankingQuestion':
            
            $propositionsItems = null;
            
            echo '<div id="rank_'. $question->id .'">';
            foreach ($question->propositions as $proposition) {
                $answeredProposition = $proposition->answeredProposition(1); // TODO: get automatically the good participation id
                $position = ($answeredProposition ? $answeredProposition->value : $proposition->id);
                
                $propositionsIds[$position] = $proposition->id;
                $propositionsItems[$position] = CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition), true);
                echo '<input type="hidden" name="Questions['. $question->id .']['. $proposition->id .']" value="'. $position .'" />';
            }
            echo '</div>';
            
            
            if (!empty($propositionsItems)) {
                
                echo '<ul id="'. 'question_'.  $question->id .'">';
                ksort($propositionsItems);
                foreach($propositionsItems as $position=>$content) {
                    echo '<li id="'. $propositionsIds[$position] .'">'. $content .'</li>';
                }
                echo '</ul>';
            
            
                if (!$isLocked) {
                    $this->widget('zii.widgets.jui.CJuiSortable',array(
                        'id' => 'question_'.  $question->id,
                        'options' => array(
                            'update' => 'js:function(event, ui) {
                                $(this).find("li").each( function(i) {
                                    $("div#rank_'. $question->id .'").find("input[name=\'Questions['. $question->id .']["+ $(this).attr("id") +"]\']").val(i+1);
                                });
                            }',
                            'cursor' => 'move'
                        )
                    ));
                }
            }
            
        break;
    }
    
?>
</div>