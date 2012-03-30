<label>State</label><br />
<?php 
	if($list)
		echo CHtml::activeDropdownList($model,'id',$list,array('empty'=>'All'));
	else
		echo CHtml::activeDropdownList($model,'id',array(),array('empty'=>'All'));
?>