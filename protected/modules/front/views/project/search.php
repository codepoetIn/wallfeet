<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/script.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.css" />
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
<div id="property_search">
<h1 class="heading" id="heading">Project Search <span>Looking to Buy / Rent / Lease
Project Search Now</span></h1>
<div class="inner-column" id="search_project_content"><?php $this->widget('ProjectSearch',array('modelProject'=>$modelProject,'modelCity'=>$modelCity,'projectAmenities'=>$projectAmenities,'projects'=>$projects,'amenities'=>$amenities)); ?>
<br class="clear" />
</div>
</div>
