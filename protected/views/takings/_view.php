<?php
/* @var $this TakingController */
/* @var $data Taking */
?>

<?php $locked = $this->isLocked($data->id); ?>
<div class="view <?php echo ($locked ? 'locked-element' : '');?>">
    
    <?php echo CHtml::link("<h4>".CHtml::encode($data->survey->title)."</h4>", array('view', 'id'=>$data->id), array('title' => $data->comment)); ?>
    <?php echo CHtml::encode($data->survey->description); ?><br />
    <?php echo 'Comment: '. CHtml::encode($data->comment); ?>
    
</div>

