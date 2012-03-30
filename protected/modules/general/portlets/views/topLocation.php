<script type="text/javascript">
function changeCity(city){
	document.getElementById("top-city-input").value = city;
	document.getElementById("top-current-input").value = 'city';
	document.getElementById("top-location-form").submit();
}
function changeCountry(country){
	document.getElementById("top-country-input").value = country;
	document.getElementById("top-current-input").value = 'country';
	document.getElementById("top-location-form").submit();
}
</script>
<form action="<?php echo Yii::app()->createUrl('/home'); ?>" method="POST" id="top-location-form">
<input type="hidden" name="top-city" id="top-city-input" />
<input type="hidden" name="top-country" id="top-country-input" />
<input type="hidden" name="top-current" id="top-current-input" />
</form>

<div class="sub-nav">
<ul>
	<li><a href="#"class="menu-nri">NRI Section</a></li>
	<?php if($current=="country"):?>
	
	<?php if($country=="international"):?>
	<li><a href="#" onClick="changeCountry('international')" class="current">International</a></li>
	<?php else:?>
	<li><a href="#" onClick="changeCountry('<?php echo $country->country;?>')" class="current">All <?php echo $country->country;?></a></li>
	<?php endif;?>
	
	<?php else:?>
	
	<?php if($country=="international"):?>
	<li><a href="#" onClick="changeCountry('international')">International</a></li>
	<li><a href="#" class="current"><?php echo $city->city;?></a></li>
	<?php else:?>
	<li><a onClick="changeCountry('<?php echo $country->country;?>')" href="#">All India</a></li>
	<li><a href="#" class="current"><?php echo $city->city;?></a></li>
	<?php endif;?>
	
	<?php endif;?>
	
	<?php if($current=="country"):
	$count = 0;	
	foreach($cities as $city){
		$model = array_shift($cities);
		echo $this->render('_location', array('model'=>$model));
		$count++;
		if($count>11)
		break;
		?>
		<?php }
		else:
	$count = 0;	
	foreach($cities as $city){
		$model = array_shift($cities);
		echo $this->render('_location', array('model'=>$model));
		$count++;
		if($count>10)
		break;
		?>
		<?php }
		endif;
		?>

	<li class="right"
		onmouseout="document.getElementById('ct_more').style.display='none'; document.getElementById('baseFrm').style.display='none'"
		onmouseover="document.getElementById('ct_more').style.display='block'; document.getElementById('baseFrm').style.display='block'"><a
		href="#" class="more-icon"></a>

	<ul id="ct_more" class="ct_more" style="display: none;">
	<?php if(!is_object($country) && strtolower($country)=="international"): ?>
	<li><a href="#" onClick="changeCountry('india')">India</a></li>
	<?php else: ?>
	<!--<li><a href="#" onClick="changeCountry('international')">International</a></li>
	--><?php endif;?>
	<?php
	foreach($cities as $city){
		$model = array_shift($cities);
		
		echo $this->render('_location', array('model'=>$model));
		?>
		<?php }?>
	</ul>
	</li>
	

</ul>
</div>
