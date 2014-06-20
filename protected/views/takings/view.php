<?php
/* @var $this TakingController */
/* @var $taking Taking */

/*
<div class="view">
    <?php echo ($this->isLocked($taking->id) ? '<div class="view locked-element">Ce taking est verrouillé</div>' : '' ); ?>
    <?php echo CHtml::beginForm(array('saveAnswers', 'id' => $taking->id)); ?>
    <b><?php echo CHtml::encode($taking->survey->title); ?></b><br />
    <?php echo CHtml::encode($taking->comment); ?><br />
    <?php
        foreach ($taking->survey->questionGroups as $questionGroup) {
            echo CController::renderPartial("//questionGroups/viewRespondent", array('questionGroup'=>$questionGroup));
        }
    ?>
    <?php echo (! $this->isLocked($taking->id) ? CHtml::submitButton('Envoyer') : ''); ?>
    <?php echo CHtml::endForm(); ?>
</div>
 */
?>
 
<div class="view">
    
    <?php echo ($this->isLocked($taking->id) ? '<div class="view locked-element">Ce taking est verrouillé</div>' : '' ); ?>
    <?php echo CHtml::beginForm(array('saveAnswers', 'id' => $taking->id)); ?>
    <b><?php echo CHtml::encode($taking->survey->title); ?></b><br />
    <?php echo CHtml::encode($taking->comment); ?><br />
    
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView' => '/questionGroups/viewRespondent',
        'ajaxUpdate' => false
    ));
    ?>
    
    <script type="text/javascript">
        $('.yiiPager').click(function() {
            
            /*
            var questions = $('*[name^="Questions"]').serialize();
            var userInputs = $('*[name^="UserInputs"]').serialize();
            console.log(questions);
            */
           
           
           var questions = [];
           questions[3] = 114;
           questions.filter(Boolean);
            
            
            
            
            
            
            $.ajax({
                type: "POST",
                url: "<?php echo CHtml::normalizeUrl(array('saveAnswers', 'id' => $taking->id)); ?>",
                data: {
                    'Questions': questions,
                    //UserInputs: userInputs
                }
            })
            .done(function(msg) {
                console.log('done: '+ msg);
            })
            .fail(function(obj, msg) {
                console.log('fail: '+ msg);
            })
            .always(function() {
                console.log('always');
            });
           
           <?php
           /*
           echo CHtml::ajax(array(
               'url' => CHtml::normalizeUrl(array('saveAnswers', 'id' => $taking->id)),
               'type' => 'POST'
           ));
           */
           ?>
           
        });
    </script>
    
    <?php echo (! $this->isLocked($taking->id) ? CHtml::submitButton('Sauver') : ''); ?>
    <?php echo CHtml::endForm(); ?>
    
</div>