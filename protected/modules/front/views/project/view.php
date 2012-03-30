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
<h1 class="heading">Project Details</h1>
<div class="inner-column">
<div class="left cols1">
<div class="property_id_details"><span>Project ID :</span> <?php echo $project->id; ?><br />

<?php if($projectViews){?><span>Views :</span><?php echo $projectViews->views; ?><br /><?php }?>
<?php if($project->recently_viewed){?><span>Recently Viewed By :</span>
<?php 
$name=UserApi::getUserProfileDetails($projectViews->recently_viewed);
echo $name->first_name," ",$name->last_name;
?><br /><?php }?>
</div>
<?php
if($projectAgentInfo){
?>
<div class="white_wrap">
<h2>Agent Information</h2>
<div style="padding: 10px;">
<p><b><?php echo $projectAgentInfo->company_name; ?></b><br />
<?php echo $projectAgent->first_name; ?><br />
<?php echo $projectAgentInfo->address_line1; ?><br />
<?php echo $projectAgentInfo->address_line2; ?><br />
<span>Mobile :</span> <?php echo $projectAgentInfo->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $projectAgentInfo->email; ?>"><?php echo $projectAgentInfo->email; ?></a>
<br />
<a href="#" class="btn-profile">View Agent Profile</a>
</p>
</div>
</div>
<?php 
}
else{
	if($projectBuilderInfo){
?>
<div class="white_wrap">
<h2>Builder Information</h2>
<div style="padding: 10px;">
<p><b><?php echo $projectBuilderInfo->company_name; ?></b><br />
<?php echo $projectBuilder->first_name; ?><br />
<?php echo $projectBuilderInfo->address_line1; ?><br />
<?php echo $projectBuilderInfo->address_line2; ?><br />
<span>Mobile :</span> <?php echo $projectBuilderInfo->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $projectBuilderInfo->email; ?>"><?php echo $projectBuilderInfo->email; ?></a>
<br />
<a href="#" class="btn-profile">View Builder Profile</a></p>
</div>
</div>
<?php 
}
else{
	if($projectSpecialistInfo){
?>
<div class="white_wrap">
<h2>Specialist Information</h2>
<div style="padding: 10px;">
<p><b><?php echo $projectSpecialistInfo->company_name; ?></b><br />
<?php echo $projectSpecialist->first_name; ?><br />
<?php echo $projectSpecialistInfo->address_line1; ?><br />
<?php echo $projectSpecialistInfo->address_line2; ?><br />
<span>Mobile :</span> <?php echo $projectSpecialistInfo->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $projectSpecialistInfo->email; ?>"><?php echo $projectSpecialistInfo->email; ?></a>
<br />
<a href="#" class="btn-profile">View Specialist Profile</a></p>
</div>
</div>
<?php 
}
else{
?>
<div class="white_wrap">
<h2>User Information</h2>
<div style="padding: 10px;">
<p><?php echo $projectUser['first_name']; ?><br />
<?php echo $projectUser['last_name']; ?><br />
<?php echo $projectUser['address_line1']; ?><br />
<?php echo $projectUser['address_line2']; ?><br />
<span>Mobile :</span> <?php echo $projectUser['mobile']; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $projectUser['email_id']; ?>"><?php echo $projectUser['email_id']; ?></a>
<br />
<a href="#" class="btn-profile">View User Profile</a></p>
</div>
</div>
<?php 
}
}
}
?>
<div class="white_wrap">
<h2>Similar Project</h2>
<?php 
if($projectSimilar){
	foreach($projectSimilar as $similar){
?>
<div style="padding: 10px;">
<p><a href="#" style="margin-top: 10px; display: block;"><b><?php echo $similar->project_name; ?></b></a>
<!--<span>Bedroom(s) :</span>--> <?php //echo $similar->bedrooms; ?><br />
<span>Area Covered:</span> <?php echo $similar->covered_area; ?> Sq-ft<br />
<span>Price:</span> Rs. <?php echo $similar->total_price; ?><br />
<span>Locality:</span>
<?php 
$locality = isset($_POST['GeoLocality']['locality_id'])? $_POST['GeoLocality']['locality_id'] : '';
if($locality)
{
  echo $projectSimilarAddress[$similar->id]['locality']; 
 }
 ?><br>
<span>Agent :</span><?php echo $projectSimilarUser[$similar->id]->first_name; ?><br />
<a href="#" style="margin-top: 10px; display: block;"><img
	src="<?php echo Yii::app()->theme->baseUrl; ?>/images/btn-more-details.jpg" alt="" /></a></p>
</div>
<?php 
	}
}
?>
</div>
<div class="white_wrap">
<h2>Recently Viewed Project</h2>
<?php 
if($projectRecentlyViewed){
	foreach($projectRecentlyViewed as $i=>$recent){
?>
<div style="padding: 10px;">
<p><a href="#" style="margin-top: 10px; display: block;"><b><?php echo $recent->project_name; ?></b></a>
<!--<span>Bedroom(s) :</span>--> <?php //echo $recent->bedrooms; ?><br />
<span>Area Covered:</span> <?php echo $recent->covered_area; ?> Sq-ft<br />
<span>Price:</span> Rs. <?php echo $recent->total_price; ?><br />
<span>Locality:</span> <?php echo $projectRecentlyViewedAddress[$i]['locality']; ?><br />
<span>Agent :</span><?php echo $projectRecentlyViewedUser[$i]->first_name; ?><br />
<a href="#" style="margin-top: 10px; display: block;"><img
	src="<?php echo Yii::app()->theme->baseUrl; ?>/images/btn-more-details.jpg" alt="" /></a></p>
</div>
<?php 
	}
}
?>
</div>
</div>
<div class="right cols2">
<div id="property_details">
<div id="agentsInfo">
<div class="tabs8">
<ul class="tabs">
	<li><a href="#details" class="selected">Project Details</a></li>
	<li><a href="#properties">Properties</a></li>
	<li><a href="#gallery">Gallery</a></li>
	<li><a href="#googleMap">View On Map</a></li>
	<li><a href="#localityInfo">Locality Info</a></li>
</ul>
<div id="details" class="tab_container">
<div class="property_details_wrap">
<div class="left">
<h1><?php echo $project->project_name; ?> in <?php echo $projectAddress['locality']; ?>, <?php echo $projectAddress['city']; ?></h1>
<div class="countContent">
<!--<div class="roomCount">Bedroom(s): <b><?php //echo $project->bedrooms; ?></b></div>-->
<div class="left">Project Type: <b><?php echo $projectType; ?></b></div>
</div>
<div class="countContent clear">Area Covered: <?php echo $project->covered_area; ?>Sq.Ft</div>
<div class="countContent clear">Land Area: <?php echo $project->land_area; ?>Sq.Ft</div>
<div class="countContent clear">Area Type: <?php echo $project->area_type; ?>Sq.Ft</div>
<div class="price-strip">
<h4 class="left"><span>Price:</span> <b>Rs. <?php echo $project->total_price; ?>
Lac(s)</b></h4>
<h4 class="right"><span>Price per sq.Ft:</span> <b>Rs. <?php echo $project->per_unit_price; ?></b></h4>
<br class="clear" />
</div>
<div>Location of the Project : <?php echo $projectAddress['locality']; ?>, <?php echo $projectAddress['city']; ?>,
<?php echo $projectAddress['state']; ?></div>
</div>
<div class="right" style="width: 100px;">
<div class="ratings_wrap">
<?php  

if(Yii::app()->user->checkAccess('front-ProjectStarRatingAjax'))
{
$url= 'front/Project/starRatingAjax/userid/'.Yii::app()->user->id.'/id/'.$project->id;
 $this->widget('StarRating',array('rating'=>(int)$projectRating,'url'=>$url));
}
  ?>
  <div class="addwishlist"> 
 <?php if(Yii::app()->user->checkAccess('front-Projectaddwishlist'))
 {
	 if($projectWishlist)
		 {
		 	echo "<h2>Added to Wishlist</h2>";
		 }
	 else
		 {
		 echo CHtml::ajaxLink(
			'<img
			src="'.Yii::app()->theme->baseUrl.'/images/btn-add-wishlist.jpg" alt="" />',          
			array('/front/project/addWishlist/userid/'.Yii::app()->user->id.'/propertyid/'.$project->id), 
			array(
				'update'=>'.addwishlist'
			)
		);
		 }
 }
?>

	</div>
</div>
</div>
<br class="clear" />
<fieldset><legend>Project Description</legend>
<p><?php echo $project->description; ?></p>
</fieldset>

<fieldset><legend>Project Features</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td>Type of Ownership: <?php echo $ownershipType; ?></td></tr>
	<tr><td>Features: <br /><?php echo $project->features; ?></td></tr>
</table>
</fieldset>

<fieldset><legend>Amenities</legend>
<?php 
	if($projectAmenities!=null){
		echo '<table width="60%" border="0" cellspacing="0" cellpadding="0">';
		$i = 0;
		foreach($projectAmenities as $projectAmenity){
			if($i%2==0)
				echo '<tr>';
			echo '<td>'.$projectAmenity.'</td>';				
			if($i%2==1)
				echo '</tr>';
			$i++;
		}
		if($i%2==0)
			echo '<td></td></tr>';
		echo '</table>';
	}
?>
</fieldset>
</div>
</div>
<div id="properties" class="tab_container">
<?php 
	if($projectProperties)
		$this->widget('PropertyList',array('properties'=>$projectProperties));
	else
		echo '<b class="red">Properties not found.</b>';
?>
</div>
<div id="gallery" class="tab_container">
<?php
if($projectImages){
	Yii::import('ext.jqPrettyPhoto');
	$options = array(
		    'slideshow'=>5000,
		    'autoplay_slideshow'=>false, 
		    'show_title'=>false
	);
	jqPrettyPhoto::addPretty('.gallery_prettyphoto a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);
	echo '<div class="gallery_prettyphoto"><ul>';
	foreach($projectImages as $projectImage){
		echo '<li><a href="'.$projectImage.'" rel="project[gallery]"><img src="'.$projectImage.'" width="100" alt="" /></a></li>';
	}
	echo '</ul></div>';
}
else
	echo 'No Images Available...!';
?>	
<br clear="all" />
</div>
<div id="googleMap" style="display: none;">
<?php Yii::app()->clientScript->registerScriptFile('http://maps.google.com/maps/api/js?sensor=false');?>
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
</script>
 <?php Yii::import('ext.gmaps.*');?>
<?php 
	$gMap = new EGMap();
	$gMap->setWidth(625);
	$gMap->setHeight(350);
	$gMap->zoom = 12;
	$gMap->setOptions(array('zoomControl'=>false,'scaleControl'=>false,'disableDefaultUI'=>true,'panControl'=>false,'draggable'=>false,'scrollwheel'=>false));
	if($projectAddress['country']){
	$country = $gMap->geocode($projectAddress['city'].",".$projectAddress['state'].",".$projectAddress['country']);
	if($country){
		if($country->getLat() && $country->getLng()){
			$gMap->setCenter($country->getLat(),$country->getLng());	
		}
	}
	}
	$gMap->renderMap();
?>
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
<br class="clear" />
</div>
</div>
