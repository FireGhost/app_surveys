<div class="view">
<?php
    $isLocked = $this->isLocked($_GET['id']);
    
    echo '<b>'. CHtml::encode($question->title) .'</b><br />';
    
    switch ($question->type) {
        
        
        case 'UniqueChoiceQuestion':
            foreach ($question->propositions as $proposition) {
                echo CHtml::radioButton('Questions['. $question->id .']', false, array('value' => $proposition->id, 'disabled' => ($isLocked ? 'disabled':'') ));
                echo ' '. CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition)) .'<br />';
            }
        break;
        
        
        
        case 'MultipleChoiceQuestion':
            foreach ($question->propositions as $proposition) {
                echo CHtml::checkBox('Questions['. $question->id .']['. $proposition->id .']', false, array('value' => $proposition->id, 'disabled' => ($isLocked ? 'disabled':'')));
                echo ' '. CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition)) .'<br />';
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
                
                echo CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition));
                echo '<div id="range_'. $proposition->id .'" style="width: 300px; margin-top: 3px;"></div>';
                echo '<div class="val_'. $proposition->id .'" style="margin-bottom: 2px;">'. $settings->min .'</div>';
                if (!$isLocked) {
                    echo '<input type="hidden" name="Questions['. $question->id .']['. $proposition->id .']" class="val_'. $proposition->id .'" value="'. $settings->min .'"/>';
                    
                    
                    $this->widget('zii.widgets.jui.CJuiSlider', array(
                        'value'=>intval($settings->min),
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
            foreach ($question->propositions as $key=>$proposition) {
                $propositionsItems[$proposition->id] = CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition), true);
                echo '<input type="hidden" name="Questions['. $question->id .']['. $proposition->id .']" value="'. $proposition->position .'" />';
            }
            echo '</div>';
            
            if (!empty($propositionsItems)) {
                if (!$isLocked) {
                    $this->widget('zii.widgets.jui.CJuiSortable',array(
                        'items' => $propositionsItems,
                        'id' => 'question_'.  $question->id,
                        'itemTemplate' => '<li id="{id}">{content}</li>',
                        'options' => array(
                            'update' => 'js:function(event, ui) {
                                $(this).find("li").each( function(i) {
                                    $("div#rank_'. $question->id .'").find("input[name=\'Questions['. $question->id .']["+ $(this).attr("id") +"]\']").val(i+1);
                                });
                            }'
                        )
                    ));
                }
                else {
                    echo '<ul>';
                    foreach($propositionsItems as $propositionItem) {
                        echo '<li>'. $propositionItem .'</li>';
                    }
                    echo '</ul>';
                }
            }
            
        break;
    }
    
?>
</div>