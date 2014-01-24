<?php
/* @var $this QuestionGroupController */
/* @var $model QuestionGroup */

$this->breadcrumbs=array(
	'Question Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionGroup', 'url'=>array('index')),
	array('label'=>'Create QuestionGroup', 'url'=>array('create')),
	array('label'=>'View QuestionGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionGroup', 'url'=>array('admin')),
);
?>

<h1>Update QuestionGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>