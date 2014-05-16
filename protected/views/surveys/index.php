<?php 
echo CHtml::link("Create new", 'create');
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view'
));
?>