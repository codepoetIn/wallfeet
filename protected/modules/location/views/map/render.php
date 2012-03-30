<input id="<?php echo ucfirst($name) ?>_city" type="hidden" name="<?php echo ucfirst($name) ?>[city]" value="<?php echo $data['city']?>">
<input id="<?php echo ucfirst($name) ?>_state" type="hidden" name="<?php echo ucfirst($name) ?>[state]" value="<?php echo $data['state']?>">
<input id="<?php echo ucfirst($name) ?>_country" type="hidden" name="<?php echo ucfirst($name) ?>[country]" value="<?php echo $data['country']?>">
<input id="<?php echo ucfirst($name) ?>_zip" type="hidden" name="<?php echo ucfirst($name) ?>[zip]" value="">
<input id="<?php echo ucfirst($name) ?>_address2" type="hidden" name="<?php echo ucfirst($name) ?>[address2]" value="">		
	
<li>
	<span><?php echo CHtml::activeLabelEx($model,'locality_id'); ?></span>
	<div id="locality_content" class="dis_inline">
		<?php echo CHtml::activeDropdownList($model,'locality_id',$list,array('empty'=>'Select','class'=>'slctbox'));?>
	</div>
</li>
<li class="error_message"><?php echo CHtml::error($model,'locality_id'); ?></li>

       

<script type="text/javascript">
$('#<?php echo ucfirst($name)?>_city').val('<?php echo $data["city"] ?>').change();
$('#<?php echo ucfirst($name)?>_state').val('<?php echo $data["state"] ?>').change();
$('#<?php echo ucfirst($name)?>_country').val('<?php echo $data["country"] ?>').change();
</script>