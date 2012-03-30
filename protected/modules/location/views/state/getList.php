<label>State</label><br />
<?php 
	if($list){
		if(isset($page) && $page=='register'){
			echo CHtml::activeDropdownList($modelProfile,'state_id',$list,array('empty'=>'Select'));
		} else
		echo CHtml::activeDropdownList($modelProfile,'state_id',$list,array('empty'=>'All'));
	}
	else{
		if(isset($page) && $page=='register'){
			echo CHtml::activeDropdownList($modelProfile,'state_id',array('empty'=>'Select'));
		} else
		echo CHtml::activeDropdownList($modelProfile,'state_id',array('empty'=>'All'));
	}
?>
<div id="city_content" class="pad10">
	<label>City</label><br />
	<?php if(isset($page) && $page=='register'){ 
			echo CHtml::activeDropdownList($modelProfile,'city_id',array('empty'=>'Select'));
		} else
		echo CHtml::activeDropdownList($modelProfile,'city_id',array('empty'=>'All')); ?>
</div>	