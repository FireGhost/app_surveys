<div class="view">
<?php
    echo '<b>'. CHtml::encode($question->title) .'</b><br />';
    
    switch ($question->type) {
        case 'UniqueChoiceQuestion':
            foreach ($question->propositions as $proposition) {
                echo CHtml::radioButton($question->id);
                echo ' '. CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition)) .'<br />';
            }
        break;
        
        case 'MultipleChoiceQuestion':
            foreach ($question->propositions as $proposition) {
                echo CHtml::checkBox($question->id);
                echo ' '. CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition)) .'<br />';
            }
        break;
        
        case 'RangeQuestion':
            foreach ($question->propositions as $proposition) {
                
                $settings = json_decode($question->settings);
                if ( !property_exists( $settings, "min" ) )
                    $settings->min = 0;
                if ( !property_exists( $settings, "max" ) )
                    $settings->max = 0;
                if ( !property_exists( $settings, "step" ) )
                    $settings->step = 0;
                
                echo CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition));
                echo '<div id="range_'. $proposition->id .'" style="width: 300px; margin-top: 3px;"></div>';
                echo '<div id="val_'. $proposition->id .'" style="margin-bottom: 2px;">'. $settings->min .'</div>';
                
                
                $this->widget('zii.widgets.jui.CJuiSlider', array(
                    'value'=>intval($settings->min),
                    'id'=>'range_'. $proposition->id,
                    'options'=>array(
                        'min' => intval($settings->min),
                        'max' => intval($settings->max),
                        'step' => intval($settings->step),
                        'slide'=>'js:function(event, ui) { $("#val_'. $proposition->id .'").html(ui.value);}'
                    )
                ));
            }
        break;
        
        case 'RankingQuestion':
            
            $propositionsItems = null;
            foreach ($question->propositions as $key=>$proposition) {
                $content = CController::renderPartial("//propositions/viewRespondent", array('proposition'=>$proposition), true);
                $propositionsItems[$key] = $content;
            }
            
            if (!empty($propositionsItems)) {
                echo '<ul id="sortable_'. $question->id .'">';
                
                $this->widget('zii.widgets.jui.CJuiSortable',array(
                    'items' => $propositionsItems,
                    'id' => 'sortable_'. $question->id,
                    'itemTemplate' => '<li id="{id}">{content}</li>'
                ));
                
                echo '</ul>';
            }
            
        break;
    }
    
?>
</div>