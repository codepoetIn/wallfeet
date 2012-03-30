<?php
$owner = $requirement->user_id==Yii::app()->user->id;
if($owner) { ?>
<div style="float:right;padding-right:5px">
<?php echo CHtml::link(
    'Delete Requirement',
     array('/requirement/delete','id'=>$requirement->id),
     array('confirm' => 'Are you sure you want to remove this requirement ?','class'=>'red-txt')
 );
?>
</div>
<br clear="all" />
<?php } ?>
<div id="property_details">
<div id="agentsInfo">
<div class="tabs8">
<ul class="tabs">
	<li><a href="#details" class="selected">Requirement Details</a></li>
	<li><a href="#gallery">Gallery</a></li>
	<li><a href="#googleMap">View On Map</a></li>
	<li><a href="#localityInfo">Locality Info</a></li>
</ul>
<div id="details" class="tab_container">
<div class="property_details_wrap">
	<div class="left">
<h1><?php echo "I want to " ; echo $requirement->i_want_to; ?> in, <?php $i=0; foreach($requirementCities as $city){if($i!=0){echo ' or ';}echo $city; $i=1;}?>.</h1>
<br>
<div class="left">Property Type: <b><?php $i=0; foreach($requirementPropertyType as $propertytype){if($i!=0){echo ' or ';}echo $propertytype;$i=1;}?>.</b></div><br>
<br>
<?php if($requirementBedrooms){
	$i=0; 
echo '<div>
<div>Bedroom(s): <b>';foreach($requirementBedrooms as $bedrooms){if($i!=0){echo ' or ';}echo $bedrooms;$i=1;}echo '.</b></div></div><br>';
} ?>
<div class="price-strip">
<h4 class="left"><span>Area Covered From:</span><b><?php echo $requirement->covered_area_from; ?> To <?php echo $requirement->covered_area_to; ?>  Sq.Ft(s)</b></h4>
</div>
<div class="price-strip">
<h4 class="letf"><span>Plot Area From:</span><b>Rs.<?php echo $requirement->plot_area_from; ?> To <?php echo $requirement->plot_area_to; ?>  Sq.Ft(s)</b></h4>
<br class="clear" />
</div>
<div class="price-strip">
<h4 class="left"><span>Budget Ranges From:</span><b>Rs. <?php echo $requirement->min_price; ?> To  Rs.<?php echo $requirement->max_price; ?> </b></h4>
</div>
</div>
<br class="clear" />
<fieldset><legend>Requirement Description</legend>
<p><?php echo $requirement->description; ?></p>
</fieldset>

<fieldset><legend>Amenities</legend>
<?php
if($requirementPropertyAmenities){
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$i=-1;
	foreach($requirementPropertyAmenities as $requirementPropertyAmenity){
		$i++;
		if($i%2==0)
			echo '<tr>';
		echo '<td>'.$requirementPropertyAmenity.'</td>';
		if($i%2==1)
			echo '</tr>';
	}
	if($i%2==0){
		echo'<td></td></tr>';
	}
	echo '</table>';
}
?>
</fieldset>
</div>
</div>


<div id="localityInfo">
<div class="amentiesMarg2">
<div class="brwntxt">Distance From Key Facilities:</div>
<div class="amentCont2">
<ul>

	<li><img style="vertical-align: middle;"
		src="images/icons/icon-hospital.png" title="Hospital" alt="Hospital">
	Hospital: 0 km</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-school.png" title="School" alt="School">
	School: 0 km</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-railway.png" title="Railway" alt="Railway">
	Railway: 10 km</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-airport.png" title="Airport" alt="Airport">
	Airport: 16 km</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-city.png" title="City Center" alt="City Center">
	City Center: 5 km</li>

</ul>
</div>
</div>
<div style="border-bottom: 1px solid rgb(230, 230, 230);">&nbsp;</div>


<div class="brwntxt mar_t10">Landmarks &amp; Neighborhood: <span
	class="grytxt">Opposite to Kalidass Theatre &amp; Adjacent to Subiksha
Hospital.</span></div>

<div class="clear"></div>

</div>
</div>

</div>



</div>