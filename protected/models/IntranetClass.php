<?php
//Yii::import('PhpActiveResource.ActiveResource');
//$ic = new IntranetClass
//$a = $ic->find('all')

//$u = new IntranetUser
//$ui = $u->find(4995)
class IntranetClass extends ActiveResource {
	var $element_name = 'class';
	var $collection_name = 'classes';
}
?>