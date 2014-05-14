<div class="view">
    <b><?php echo CHtml::encode($questionGroup->title); ?></b><br />
    <?php
        foreach ($questionGroup->questions as $question) {
            echo CController::renderPartial("//questions/viewRespondent", array('question'=>$question));
        }
    ?>
</div>