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
		}).filter(':first').click();
	});
</script>
<div id="property_search">
<h1 class="heading">Property Details</h1>
<div class="inner-column">
<div class="left cols1">
<div class="property_id_details"><span>Property ID :</span> <?php echo $property->id; ?><br />
<?php if($property->views){ ?>
<span>Views :</span>
<?php echo $property->views; ?><br />
<?php }?>
<?php if($recentlyViewed){ ?>
<span>Recently Viewed By :</span>
<?php echo $recentlyViewed->first_name; ?><br />
<?php }?>
</div>
<?php if($propertyAgentInfo){ ?>
<div class="white_wrap">
<h2>Agent Information</h2>
<div style="padding: 10px;padding: 10px;border-bottom:1px solid #DADADA">
<p>
<a href="<?php echo Yii::app()->createUrl("/agent/$propertyAgentInfo->user_id");?>" style="margin-top: 5px; display: block; padding:5px; background-color:#E6E6E6">
<b style="font-size:16px"><?php echo $propertyAgentInfo->company_name; ?></b>
</a>
<?php echo $propertyAgent->first_name; ?><br />
<?php echo $propertyAgentInfo->address_line1; ?><br />
<?php echo $propertyAgentInfo->address_line2; ?><br />
<span>Mobile :</span> <?php echo $propertyAgentInfo->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $propertyAgentInfo->email; ?>">
<?php echo $propertyAgentInfo->email; ?></a>
<br />
<a href="<?php echo Yii::app()->createUrl("/agent/$propertyAgentInfo->user_id");?>" class="btn-profile">View Agent Profile</a>
<div class="contact_user" style="padding-top:5px">
<?php if($property->user_id!=Yii::app()->user->id)
{
echo '<a href="/message/reply/'.$property->user_id.'"><image src="'.Yii::app()->theme->baseUrl.'/images/msg.jpg"></a>';
 }?>
</div>
</p>
</div>
</div>
<?php 
} else{	if($propertyBuilderInfo){ ?>
<div class="white_wrap">
<h2>Builder Information</h2>
<div style="padding: 10px;padding: 10px;border-bottom:1px solid #DADADA">
<p>
<a href="<?php echo Yii::app()->createUrl("/builder/$propertyBuilderInfo->user_id");?>" style="margin-top: 5px; display: block; padding:5px; background-color:#E6E6E6">
<b style="font-size:16px"><?php echo $propertyBuilderInfo->company_name; ?></b></a>
<?php echo $propertyBuilder->first_name; ?><br />
<?php echo $propertyBuilderInfo->address_line1; ?><br />
<?php echo $propertyBuilderInfo->address_line2; ?><br />
<span>Mobile :</span> <?php echo $propertyBuilderInfo->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $propertyBuilderInfo->email; ?>"><?php echo $propertyBuilderInfo->email; ?></a>
<br />
<a href="<?php echo Yii::app()->createUrl("/builder/$propertyBuilderInfo->user_id");?>" class="btn-profile">View Builder Profile</a></p>
<div class="contact_user" style="padding-top:5px">
<?php if($property->user_id!=Yii::app()->user->id)
{
echo '<a href="/message/reply/'.$property->user_id.'"><image src="'.Yii::app()->theme->baseUrl.'/images/msg.jpg"></a>';
}?>
</div>
</div>
</div>
<?php } else {	if($propertySpecialistInfo){ ?>
<div class="white_wrap">
<h2>Specialist Information</h2>
<div style="padding: 10px;padding: 10px;border-bottom:1px solid #DADADA">
<p>
<a href="<?php echo Yii::app()->createUrl("/specialist/$propertySpecialist->user_id");?>" style="margin-top: 5px; display: block; padding:5px; background-color:#E6E6E6">
<b style="font-size:16px"><?php echo $propertySpecialistInfo->company_name; ?></b></a>
<?php echo $propertySpecialist->first_name; ?><br />
<?php echo $propertySpecialistInfo->address_line1; ?><br />
<?php echo $propertySpecialistInfo->address_line2; ?><br />
<span>Mobile :</span> <?php echo $propertySpecialistInfo->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $propertySpecialistInfo->email; ?>">
<?php echo $propertySpecialistInfo->email; ?></a>
<br />
<a href="<?php echo Yii::app()->createUrl("/specialist/$propertySpecialist->user_id");?>" class="btn-profile">View Specialist Profile</a></p>
<div class="contact_user" style="padding-top:5px">
<?php if($property->user_id!=Yii::app()->user->id) { 
echo '<a href="/message/reply/'.$property->user_id.'"><image src="'.Yii::app()->theme->baseUrl.'/images/msg.jpg"></a>';
 }?>
</div>
</div>
</div>
<?php } else { ?>
<div class="white_wrap">
<h2>User Information</h2>
<div style="padding: 10px;padding: 10px;border-bottom:1px solid #DADADA">
<p><?php echo $propertyUser['first_name']; ?><br />
<?php echo $propertyUser['last_name']; ?><br />
<?php echo $propertyUser['address_line1']; ?><br />
<?php echo $propertyUser['address_line2']; ?><br />
<span>Mobile :</span> <?php echo $propertyUser['mobile']; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $propertyUser['email_id']; ?>"><?php echo $propertyUser['email_id']; ?></a>
<br />
<!--<a href="<?php echo Yii::app()->createUrl('/profile/$propertyUser["user_id"]');?>" class="btn-profile">View User Profile</a></p>
--><div class="contact_user" style="padding-top:5px">
<?php if($property->user_id!=Yii::app()->user->id)
{
echo '<a href="/message/reply/'.$property->user_id.'"><image src="'.Yii::app()->theme->baseUrl.'/images/msg.jpg"></a>';
 }?>
</div>
</div>
</div>
<?php 
}
}
}
?>

<div class="white_wrap">
<h2>Similar Properties</h2>
<?php 
if($propertySimilar){
	foreach($propertySimilar as $similar){
		if($similar->id!=$property->id){
?>
<div style="padding: 10px;border-bottom:1px solid #DADADA">
<p>
<a href="<?php echo Yii::app()->createUrl("/property/$similar->id");?>" style="margin-top: 5px; display: block; padding:5px; background-color:#E6E6E6">
<b style="font-size:16px"><?php if($similar->bedrooms){echo $similar->bedrooms.' '.'BHK';} echo ucfirst($similar->property_name);?></b>
</a>
<span>Property Type : </span><?php echo $similar->propertyType->property_type;?></span><br />
<span>Area Covered:</span> <?php if($similar->covered_area){echo $similar->covered_area . ' Sq-ft';} else {echo '-';} ?><br />
<span>City:</span> <?php echo $propertySimilarAddress[$similar->id]['city']; ?><br />
<a href="<?php echo Yii::app()->createUrl("/property/$similar->id");?>" style="margin-top: 10px; display: block;"><img
	src="<?php echo Yii::app()->theme->baseUrl; ?>/images/btn-more-details.jpg" alt="" /></a></p>
</div>
<?php } } } ?>
</div>
<div class="white_wrap">
<h2>Recently Viewed Properties</h2>
<?php 
if($propertyRecentlyViewed){
	foreach($propertyRecentlyViewed as $i=>$recent){
		if($recent->id!=$property->id){
?>
<div style="padding: 10px;border-bottom:1px solid #DADADA">
<p>
<a href="<?php echo Yii::app()->createUrl("/property/$recent->id");?>" style="margin-top: 5px; display: block; padding:5px; background-color:#E6E6E6">
<b style="font-size:16px"><?php if($recent->bedrooms){echo $recent->bedrooms.' '.BHK;} echo ucfirst($recent->property_name); ?></b></a>
<span>Property Type : </span><?php echo $recent->propertyType->property_type;?></span><br />
<span>Area Covered:</span><?php if($recent->covered_area){echo $recent->covered_area . ' Sq-ft';} else {echo '-';} ?><br />
<span>City:</span> <?php echo $propertyRecentlyViewedAddress[$i]['city']; ?><br />
<a href="<?php echo Yii::app()->createUrl("/property/$recent->id");?>" style="margin-top: 10px; display: block;"><img
	src="<?php echo Yii::app()->theme->baseUrl; ?>/images/btn-more-details.jpg" alt="" /></a></p>
</div>
<?php } } } ?>
</div>
</div>
<div class="right cols2">

<?php 	
	$propertyFeatures=array('transactionType'=>$transactionType,'ownershipType'=>$ownershipType,'propertyAge'=>$propertyAge);
	$this->widget("PropertyView",
	  array('property'=>$property,
			'propertyAddress'=>$propertyAddress,
	  		'propertyType'=>$propertyType,
	  		'propertyRating'=>$propertyRating,
	  		'propertyWishlist'=>$propertyWishlist,
	  		'propertyFeatures'=>$propertyFeatures,
	  		'propertyAmenities'=>$propertyAmenities,
	  		'propertyImages'=>$propertyImages,
				));?>
				
</div>
<br class="clear" />
</div>
</div>
