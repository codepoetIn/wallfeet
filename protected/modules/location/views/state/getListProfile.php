<ul>
	<li>
		<span>State</span>
		<?php 
			if($list)
				echo CHtml::activeDropdownList($modelProfile,'state_id',$list,array('empty'=>'All'),array('class'=>'slctbox'));
			else
				echo CHtml::activeDropdownList($modelProfile,'state_id',array(''=>'All'),array('class'=>'slctbox'));
		?>
	</li>
	<li class="error_message"><?php echo CHtml::error($modelProfile,'state_id'); ?></li>
</ul>
<div id="city_content">
	<ul>
	<li><span>City</span>
	<?php echo CHtml::activeDropdownList($modelProfile,'city_id',array(''=>'All'),array('class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($modelProfile,'city_id'); ?></li>
</ul>
</div>
</div>	