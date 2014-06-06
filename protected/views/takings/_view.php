<?php
/* @var $this TakingController */
/* @var $data Taking */
?>


<div class="view">
    
    <?php echo CHtml::link("<h4>".CHtml::encode($data->survey->title)."</h4>", array('view', 'id'=>$data->id), array('title' => $data->comment)); ?>
    <?php echo CHtml::encode($data->survey->description); ?>
    
</div>

