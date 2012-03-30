<?php $ratingReadOnly = false;
$owner = $property->user_id==Yii::app()->user->id;
if($owner) { ?>
<div style="float:right;padding-right:5px">
<a class="red-txt" href="<?php echo Yii::app()->createUrl('/property/update/'.$property->id)?>">
Update Property
</a> | 
<?php echo CHtml::link(
    'Delete Property',
     array('/property/deleteProperty','id'=>$property->id),
     array('confirm' => 'Are you sure you want to remove this property ?','class'=>'red-txt')
 );
?>
</div>
<br clear="all" />
<?php } ?>
<div id="property_details">
<div id="agentsInfo">
<div class="tabs8">
<ul class="tabs">
	<li><a href="#details" class="selected">Property Details</a></li>
	<li><a href="#gallery">Gallery</a></li>
	<li><a href="#googleMap">View On Map</a></li>
	<li><a href="#localityInfo">Locality Info</a></li>
	<?php if($property->featured) {?>
	<li><a href="#localityInfo" class="featured">Featured</a></li>
	<?php }?>
	<?php if($property->jackpot_investment) {?>
	<li><a href="#localityInfo" class="jackpot">Jackpot Investment</a></li>
	<?php }?>
	<?php if($property->instant_home) {?>
	<li><a href="#localityInfo" class="instant">Instant</a></li>
	<?php }?>
</ul>
<div id="details" class="tab_container" style="display: block; ">
<div class="property_details_wrap">
<div class="left property_details_view">
<h1><?php if($property->bedrooms){echo $property->bedrooms.' BHK ';} echo $property->property_name; ?> for <?php if($property->i_want_to=='sell') { ?>Sale<?php  } else { echo $property->i_want_to; ?> <?php }?>
 in <?php if($propertyAddress['locality']!='') { echo $propertyAddress['locality'] . ', '; }?>
	<?php echo $propertyAddress['city']; ?></h1>
<div class="countContent"><?php if($property->bedrooms!='') {?>
<div class="roomCount">Bedroom(s): <b><?php echo $property->bedrooms; ?></b></div>
<?php }?> <?php if($property->bathrooms!='') {?>
<div class="roomCount">Bathroom(s): <b><?php echo $property->bathrooms; ?></b></div>
<?php }?>
<div class="left">Property Type: <b><?php echo $propertyType; ?></b></div>
</div>

<?php if($property->covered_area!=''){?>
<div>Area Covered: <b><?php echo $property->covered_area; ?> Sq.Ft</b></div>
<?php }?> 

<div>Location of the Property : <b><?php if($propertyAddress['locality']!='') { echo $propertyAddress['locality'] . ', '; } ?>
<?php echo $propertyAddress['city']; ?>, <?php echo $propertyAddress['state']; ?></b></div>
<div>Available From : <b><?php if($property->available_from) { echo $property->available_from; } else { ?>Immediate<?php } ?></b></div>
<br/>
<?php if($property->display_price=='' || $property->display_price){?>
<div class="price-strip">
<h4 class="left"><span>Price:</span> <b><?php if($property->total_price){?>Rs.
<?php echo $property->total_price; ?><?php } else {?> - <?php }?></b></h4>
<h4 class="right"><span>Price per sq.Ft:</span> <b><?php if($property->per_unit_price){?>Rs.
<?php echo $property->per_unit_price; ?><?php } else {?> - <?php }?></b></h4>
<br class="clear" />
<?php if($property->price_negotiable){?> (--negotiable--) <?php }?></div>
<?php }?>

</div>
<div class="right" style="width: 100px;">
<div class="ratings_wrap"><?php 
$session=new CHttpSession;
$session->open();
if($owner)
$ratingReadOnly = true;

if(Yii::app()->user->checkAccess('front-PropertyStarRatingAjax')&&!isset($session['property']))
{
	$url= 'front/Property/starRatingAjax/userid/'.Yii::app()->user->id.'/id/'.$property->id;
	$this->widget('StarRating',array('rating'=>(int)$propertyRating,'url'=>$url,'ratingReadOnly'=>$ratingReadOnly));
}?>
<?php if(!$owner) {?>
<div class="addwishlist"><?php if(Yii::app()->user->checkAccess('front-PropertyAddWishlist'))
{
	if($propertyWishlist)
	{
		echo "<h2>Added to Wishlist</h2>";
	}
	else
	{
		echo CHtml::ajaxLink(
			'<img
			src="'.Yii::app()->theme->baseUrl.'/images/btn-add-wishlist.jpg" alt="" />',          
		array('/front/Property/addWishlist/userid/'.Yii::app()->user->id.'/propertyid/'.$property->id),
		array(
				'update'=>'.addwishlist'
				)
				);
	}
}
?></div>
<?php }?>
</div>
</div>
<br class="clear" />
<fieldset><legend>Property Description</legend>
<p><?php if($property->description):?> <?php echo $property->description; ?>
<?php else:?> <i>No description yet.</i> <?php endif;?></p>
</fieldset>

<fieldset><legend>Property Features</legend> <?php 
$transactionType=isset($propertyFeatures['transactionType'])?$propertyFeatures['transactionType']:null;
$ownershipType=isset($propertyFeatures['ownershipType'])?$propertyFeatures['ownershipType']:null;
$propertyAge=isset($propertyFeatures['propertyAge']->age)?$propertyFeatures['propertyAge']->age:null;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span>Furnished : </span><b><?php echo $property->furnished; ?></b></td>
		<td><span>Transaction Type : </span><b><?php echo $transactionType; ?></b></td>
	</tr>
	<tr>
		<td><span>Type of Ownership : </span><b><?php echo $ownershipType; ?></b></td>
		<td><span>Floor Number : </span><b><?php echo $property->floor_number; ?></b></td>
	</tr>
	<tr>
		<td><span>Total Floors : </span><b><?php echo $property->total_floors; ?></b></td>
		<td><span>Construction Age : </span><b><?php echo $propertyAge; ?></b></td>
	</tr>
	<tr>
		<td><span>Facing : </span><b><?php echo $property->facing; ?></b></td>
		<td></td>
	</tr>
</table>
</fieldset>

<fieldset><legend>Amenities</legend> <?php
if($propertyAmenities){
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$i=-1;
	foreach($propertyAmenities as $propertyAmenity){
		$i++;
		if($i%2==0)
		echo '<tr>';
		echo '<td>'.ucfirst($propertyAmenity).'</td>';
		if($i%2==1)
		echo '</tr>';
	}
	if($i%2==0){
		echo'<td></td></tr>';
	}
	echo '</table>';
} else { ?> <i>No amenities listed yet.</i> <?php }
?></fieldset>
</div>
</div>
<div id="gallery" class="tab_container">

<?php
if($propertyImages){
	echo '<h1 class="heading">Images</h1>';
	Yii::import('ext.jqPrettyPhoto');
	$options = array(
		    'slideshow'=>5000,
		    'autoplay_slideshow'=>false, 
		    'show_title'=>false
	);
	jqPrettyPhoto::addPretty('.gallery_prettyphoto a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);
	echo '<div class="gallery_prettyphoto"><ul>';
	foreach($propertyImages as $propertyImage){
		echo '<li><a href="'.$propertyImage.'" rel="property[gallery]"><img src="'.$propertyImage.'" width="100" alt="" /></a></li>';
	}
	echo '</ul>';
	echo '</div>';
}
else { ?> <i>No Images Available.</i> <?php }
?><br clear="all" />
<?php 
if($property->video_url)
{
	
	echo '<h1 class="heading">Video</h1>';
	echo '<div style="margin-top:10px">';
	echo '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.$property->video_url.'" frameborder="0" allowfullscreen></iframe>';
	echo '</div>';
	//echo '<iframe type="text/html" width="560" height="315" src="'.$property->video_url.'" frameborder="0" allowfullscreen /></div>';
	
}
?> 
</div>
<div id="googleMap" style="display: none;"><?php Yii::app()->clientScript->registerScriptFile('http://maps.google.com/maps/api/js?sensor=false');?>
<script type="text/javascript">
var geocoder;

  function codeAddress(country,gMap) {
		geocoder = new google.maps.Geocoder();
	    geocoder.geocode( { 'address': country}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
		    lat = results[0].geometry.location;
	        return results[0].geometry.location;	        
	      } else {
	        return ;
	      }
	    });
	  }	  
</script> <?php Yii::import('ext.gmaps.*');?> <?php 
$gMap = new EGMap();

$gMap->setWidth(625);
$gMap->setHeight(350);
$gMap->zoom = 14;
$gMap->setOptions(array('zoomControl'=>true,
					    'scaleControl'=>true,
					    'disableDefaultUI'=>true,
					    'panControl'=>true,
					    'draggable'=>true,
					    'scrollwheel'=>true));

if($property->latitude && $property->longitude){
	$marker = new EGMapMarker($property->latitude,$property->longitude);
	$gMap->addMarker($marker);
	$gMap->setCenter($property->latitude,$property->longitude);
}elseif($propertyAddress['country']){
	$country = $gMap->geocode($propertyAddress['city'].",".$propertyAddress['state'].",".$propertyAddress['country']);
	if($country){
		if($country->getLat() && $country->getLng()){
			$marker = new EGMapMarker($country->getLat(),$country->getLng());
			$gMap->addMarker($marker);
			$gMap->setCenter($country->getLat(),$country->getLng());
		}
	}
}
$gMap->renderMap();
?></div>
<div id="localityInfo">
<div class="amentiesMarg2">
<div class="brwntxt"><b>Distance From Key Facilities</b></div>
<div class="amentCont2">
<ul>

	<li><img style="vertical-align: middle;"
		src="images/icons/icon-hospital.png" title="Hospital" alt="Hospital">
	<b><?php echo $property->hospital ? $property->hospital : '-';?></b> km(s)</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-school.png" title="School" alt="School">
	<b><?php echo $property->school ? $property->school : '-';?></b> km(s)</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-railway.png" title="Railway" alt="Railway">
	<b><?php echo $property->railway ? $property->railway : '-';?></b> km(s)</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-airport.png" title="Airport" alt="Airport">
	<b><?php echo $property->airport ? $property->airport : '-';?></b> km(s)</li>


	<li><img style="vertical-align: middle;"
		src="images/icons/icon-city.png" title="City Center" alt="City Center">
	<b><?php echo $property->city_centre ? $property->city_centre : '-';?></b> km(s)</li>

</ul>
</div>
</div>
<div style="border-bottom: 1px solid rgb(230, 230, 230);">&nbsp;</div>



<div class="brwntxt mar_t10">Landmarks &amp; Neighborhood:
<?php if($property->landmarks){?> 
<span class="grytxt"><b><?php echo ucfirst($property->landmarks);?></b></span>
<?php } else {?>
<i>No landmarks listed yet.</i>
<?php }?>
</div>


<div class="clear"></div>

</div>
</div>

</div>



</div>
