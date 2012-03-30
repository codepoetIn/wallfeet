<script type="text/javascript" charset="utf-8">
		$(function () {
			var tabContainers = $('div.tabs8 > div');
			tabContainers.hide().filter(':first').show();
			
			$('div.tabs8 ul.tabs a').click(function () {
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				$('div.tabs8 ul.tabs a').removeClass('selected');
				$(this).addClass('selected');
				return false;
			})
			
		});
</script>

<div id="property_search">
<h1 class="heading">Requirement Details</h1>
<div class="inner-column">
<div class="left cols1">
<div class="property_id_details"><span>Requirement ID :</span> <?php echo $requirement->id; ?><br />
</div>


<div class="white_wrap">
<h2>User Information</h2>
<div style="padding: 10px;">
<p><?php echo $userDetails->first_name; ?><br />
<?php echo $userDetails->last_name; ?><br />
<?php echo $userDetails->address_line1; ?><br />
<?php echo $userDetails->address_line2; ?><br />
<span>Mobile :</span> <?php echo $userDetails->mobile; ?> <br />
<!--  <span>Email: </span> <a href="mailto:<?php //echo $userDetails->email_id; ?>"><?php //echo $userDetails->email_id; ?></a>-->
<br />
<a href="/profile/<?php echo $userDetails->user_id; ?>" class="btn-profile">View User Profile</a></p>
</div>
</div>


</div>
<div class="right cols2">
<?php
$owner = $requirement->user_id==Yii::app()->user->id;
if($owner) { ?>
<div style="float:right;padding-right:5px">
<div style="float:left;padding-right:25px">
<?php echo CHtml::link(
    'Similar Properties',
     array('/requirement/similar','id'=>$requirement->id));
?>
</div>
<div style="float:left">
<?php echo CHtml::link(
    'Delete Requirement',
     array('/requirement/delete','id'=>$requirement->id),
     array('confirm' => 'Are you sure you want to remove this requirement ?','class'=>'red-txt')
 );
?>
</div>
</div>
<br clear="all" />
<?php } ?>
<div id="property_details">
<div id="agentsInfo">
<div class="tabs8">
<ul class="tabs">
	<li><a href="#details" class="selected">Requirement Details</a></li>
</ul>
<div id="details" class="tab_container">
<div class="property_details_wrap">
	<div>
<h1><?php echo $requirement->i_want_to; ?> </h1>
<div class="countContent">


<fieldset><legend>Property Types</legend>
<?php
if($propertyNames){
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$i=-1;
	foreach($propertyNames as $propertyName){
		$i++;
		if($i%2==0)
			echo '<tr>';
		echo '<td width="50%">'.$propertyName.'</td>';
		if($i%2==1)
			echo '</tr>';
	}
	if($i%2==0){
		echo'<td width="50%"></td></tr>';
	}
	echo '</table>';
}
?>
</fieldset>

<br/>


<?php
if($bedroomsRequirement){?>
<fieldset><legend>Bedroom(s)</legend>
 
	<?php $i=-1;
	foreach($bedroomsRequirement as $bedrooms){
		$i++;
			if ($i)
				echo ", ";
			echo $bedrooms->bedrooms;
	}?>
	</fieldset>
<?php 	
}?>

</div>

<?php if(($requirement->covered_area_from!=null) && $requirement->covered_area_to){?>
<div class="price-strip"><h4 class="left"><span>Cover Area:</span><b> <?php echo '  '.$requirement->covered_area_from.' to '.$requirement->covered_area_to.' '; ?>Sq.Ft</b></h4></div><?php }?>
<?php if(($requirement->plot_area_from!=null) && $requirement->plot_area_to){?>
<div class="price-strip"><h4 class="left"><span>Plot Area:</span><b> <?php echo '  '.$requirement->plot_area_from.' to '.$requirement->plot_area_to.' '; ?>Sq.Ft</b></h4></div><?php }?>
<?php if(($requirement->min_price!=null) && $requirement->max_price){?>
<div class="price-strip">
<h4 class="left"><span>Budget:</span> <b>Rs. <?php echo $requirement->min_price.' to Rs.'.$requirement->max_price; ?>
</b></h4>
<br class="clear" />
</div>
<?php }?>



</div>

<br class="clear" />

<?php if($requirement->requirement_urgency){?>
<fieldset><legend>Requirement Urgency</legend>
<p><?php echo $requirement->requirement_urgency; ?></p>
</fieldset>
<?php }?>


<fieldset><legend>Description</legend>
<p><?php echo $requirement->description; ?></p>
</fieldset>


<?php
if($amenityNames){?>
<fieldset><legend>Amenities</legend>
<?php

	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$i=-1;
	foreach($amenityNames as $amenityName){
		$i++;
		if($i%2==0)
			echo '<tr>';
		echo '<td width="50%">'.$amenityName.'</td>';
		if($i%2==1)
			echo '</tr>';
	}
	if($i%2==0){
		echo'<td width="50%"></td></tr>';
	}
	echo '</table>';
?>
</fieldset>
<?php }?>

<fieldset><legend>Cities</legend>
<?php
if($cityNames){
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$i=-1;
	foreach($cityNames as $cityName){
		$i++;
		if($i%2==0)
			echo '<tr>';
		echo '<td width="50%">'.$cityName.'</td>';
		if($i%2==1)
			echo '</tr>';
	}
	if($i%2==0){
		echo'<td width="50%"></td></tr>';
	}
	echo '</table>';
}
?>
</fieldset>

</div>
</div> 



</div>

</div>


</div>


</div>
<br class="clear" />
</div>
</div>
</div>
