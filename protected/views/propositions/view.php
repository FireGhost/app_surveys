<?php
/* @var $this PropositionsController */
/* @var $proposition Propositions */
?>

<div class="view">

	<b><?php echo CHtml::encode($proposition->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($proposition->id), array('propositions/view', 'id'=>$proposition->id)); ?>
	<br />
	<?php 
	echo CHtml::link("Modifier", array('propositions/update', 'id'=>$proposition->id));
	?>
	<br />
	<?php
	echo CHtml::link("Supprimer", array('delete', 'id'=>$proposition->id)); 
	?>
	<br /> 
	<?php
	echo CHtml::link("Créer", array('create', 'id'=>$proposition->id)); 
	?>
    <br />
   
    <b><?php echo CHtml::encode($proposition->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($proposition->title); ?>
	<br />
    
	<b><?php echo CHtml::encode($proposition->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($proposition->type); ?>
	<br />

	<b><?php echo CHtml::encode($proposition->getAttributeLabel('question_id')); ?>:</b>
	<?php echo CHtml::encode($proposition->question_id); ?>
	<br />

	<b><?php echo CHtml::encode($proposition->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($proposition->position); ?>
	<br />
    
    <b><?php echo CHtml::encode($proposition->getAttributeLabel('answer_format')); ?>:</b>
	<?php echo CHtml::encode($proposition->answer_format); ?>
	<br />

</div>