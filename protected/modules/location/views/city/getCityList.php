<?php 
	if($list){
		echo CHtml::activeDropdownList($model,'city',$list,array('empty'=>'All',
							'class'=>$class,
		));
	} else {
		echo CHtml::activeDropdownList($model,'city',array(),array('empty'=>'All',
							'class'=>$class,
		));
	}
	if($display=="table"){ 
		
		
		
	} ?>
