<?php
/* @var $this PropositionsController */
/* @var $proposition Propositions */
?>

<div class="view">
	<b>Proposition</b><br />
	<?php echo CHtml::link("Modifier", array('propositions/update', 'id'=>$proposition->id));?>
	<?php echo CHtml::link("Supprimer", array('delete', 'id'=>$proposition->id));?>
	<br /> 

    <b><?php echo CHtml::encode($proposition->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($proposition->title); ?>
	<br />
    
	<b><?php echo CHtml::encode($proposition->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($proposition->type); ?>
	<br />
    
    <b><?php echo CHtml::encode($proposition->getAttributeLabel('answer_format')); ?>:</b>
	<?php echo CHtml::encode($proposition->answer_format); ?>
	<br />

</div>