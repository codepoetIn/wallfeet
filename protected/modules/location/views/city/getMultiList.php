<?php
	if($list){
		$city_id="";
		echo CHtml::activeCheckBoxList('city_id',$city_id,$list);
	}
	
?>
