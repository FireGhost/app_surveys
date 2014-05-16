<?php 
echo CHtml::link("Create new", 'surveys/create');
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view'
));
?>