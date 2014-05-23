<?php 
echo CHtml::link("Nouveau sondage", 'create');
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view'
));
?>