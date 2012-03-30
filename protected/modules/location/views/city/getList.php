<ul>
<li><span><?php echo CHtml::activeLabel($modelProfile,'city_id'); ?></span></li>

<li><?php
	if($list){
		if(isset($page) && $page=='register'){
			echo CHtml::activeDropdownList($modelProfile,'city_id',$list,array('empty'=>'Select'));
		} else
		echo CHtml::activeDropdownList($modelProfile,'city_id',$list,array('empty'=>'All'));
	}
	else {
		if(isset($page) && $page=='register'){
			echo CHtml::activeDropdownList($modelProfile,'city_id',$list,array('empty'=>'Select'));
		}else
		echo CHtml::activeDropdownList($modelProfile,'city_id',array('empty'=>'All'));
	}
?></li>

<li><?php echo CHtml::error($modelProfile,'city_id'); ?></li>
</ul>
