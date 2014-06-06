<?php
/* @var $this TakingController */
/* @var $data Taking */
?>


<div class="view">
    
    <?php echo CHtml::link( CHtml::encode($data->survey->title), array('view', 'id'=>$data->id) ); ?><br />
    
</div>

