<div class="view">
    <b><?php echo CHtml::encode($data->title); ?></b><br />
    <?php
        foreach ($data->questions as $question) {
            echo CController::renderPartial("//questions/viewRespondent", array('question'=>$question));
        }
?>
</div>