<ul>
<li><span><?php echo CHtml::activeLabel($modelProfile,'state_id'); ?></span></li>
 <li>
<?php
 	echo CHtml::activeDropdownList($modelProfile,'state_id',$list,array('empty'=>'Select'));
?>
</li>
<li class="error_message"><?php echo CHtml::error($modelProfile,'state_id'); ?></li>
</ul>
<div id="city_content">
<ul>
	<li><span><?php echo CHtml::activeLabel($modelProfile,'city_id'); ?></span></li>
	<li>
	<?php echo CHtml::activeDropdownList($modelProfile,'city_id',array('empty'=>'Select')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($modelProfile,'city_id'); ?></li>
</ul>
</div>