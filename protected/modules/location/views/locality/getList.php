<?php 
	if($list) {
		echo CHtml::activeDropdownList($modelProperty,'locality_id',$list,array(''=>'All','class'=>$class,));
	}
	else {
		echo CHtml::activeDropdownList($modelProperty,'locality_id',array(),array(''=>'All','class'=>$class,));
	} 
?>