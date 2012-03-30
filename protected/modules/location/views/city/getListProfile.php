<ul>
<li><span><?php echo CHtml::activeLabel($modelProfile,'city_id'); ?></span><?php 
	if($list)
		echo CHtml::activeDropdownList($modelProfile,'city_id',$list,array('empty'=>'All'));
	else
		echo CHtml::activeDropdownList($modelProfile,'city_id',array('empty'=>'All'));
?></li>
<li><?php echo CHtml::error($modelProfile,'city_id'); ?></li>
</ul>
