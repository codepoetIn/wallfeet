<script type="text/JavaScript" src="includes/curvycorners.js"></script>
<script src="includes/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="includes/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/cufon-yui.js"> </script>
<script src="includes/myriad-pro.cufonfonts.js" type="text/javascript"></script>
<script type="text/javascript">Cufon.replace('', { fontFamily: 'Myriad Pro Regular', hover: true });</script>
<link rel="stylesheet" type="text/css" href="includes/styles.css" />
<?php if($specialist->user_id==Yii::app()->user->id){
echo '<div style="float:right"><a href="/specialist/update" class="red-txt">Edit Profile</a></div>';
}?>
<div id="property_search">
<h1 class="heading">Specialist Profile</h1>
<div class="inner-column">
<div class="left cols1">
<div align="center">
<img src="<?php echo ImageUtils::getImageUrl('specialists',$specialist->user_id,$specialist->image); ?>" alt="" width="223" height="146" />
</div>
<div class="white_wrap">
<h2>Specialist Information</h2>
<div style="padding: 10px;">
<p><b><?php echo $specialist->company_name; ?></b><br />
<?php echo $specialistInfo->first_name; ?><br />
<?php echo $specialist->address_line1; ?><br />
<?php echo $specialist->address_line2; ?><br />
<span>Mobile :</span> <?php echo $specialist->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $specialist->email; ?>"><?php echo $specialist->email; ?></a>

</p>
</div>
</div>
<div class="white_wrap">
<h2>Search Specialist by Locality</h2>
<div style="padding: 15px 10px;">
<form action="#">
<input type="text" name="search_locality" class="txtbox-specialist-local" />
<input type="submit" value="" class="btn-search-now" />
</form>
</div>
</div>
</div>
<div class="right cols2">
<div id="property_details">
<div class="property_details_wrap">
<div style="border-bottom:#CCC 1px solid; margin-bottom:5px;">
<h1 class="left"><?php echo $specialist->company_name; ?></h1>
<div class="right" style="width:172px;">
<div class="ratings_wrap">
<h3 class="left" style="width:30px">&nbsp;</h3>
<?php if((Yii::app()->user->checkAccess('front-SpecialistRating'))&&($specialist->id)) 
{ 
	$url= 'front/specialist/starRatingAjax/userId/'.Yii::app()->user->id.'/specialistId/'.$specialist->id;
	$this->widget('StarRating',array('rating'=>$specialistRating,'url'=>$url,'ratingReadOnly'=>$specialistRatingReadOnly)); 
}?>
</div>
</div>
<br class="clear" />
</div>
<p class="left"><b>Address : </b><?php echo $specialistAddress['city'].','.$specialistAddress['state'].','.$specialistAddress['country'] ?>.</p>
<p class="right">Registered since - <?php echo date("F Y", strtotime($specialist->created_time));?></p><br class="clear" />

<fieldset><legend>About Us</legend>
<p><?php echo $specialist->company_description; ?></p>
</fieldset>
<fieldset><legend>Locations We Deal In</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	style="margin-top: 10px;">
	<?php 
	if($specialistLocations){
		foreach ($specialistLocations as $specialistLocation){?>
	<tr>
		<td bgcolor="#e5e5e5" style="padding-left: 10px;"><?php echo $specialistLocation['city'].'('.$specialistLocation['state']; ?>)</td>
	</tr>
	<tr>
		<td style="padding-left: 10px;">All Localities in <?php echo $specialistLocation['city']; ?></td>
	</tr>
	<?php }}?>	
</table>
</fieldset>
<fieldset><legend>Projects We Deal In</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	style="margin-top: 10px;">
	<?php 
	if($specialistPropertyLocations){
		foreach ($specialistPropertyLocations as $i=>$specialistPropertyLocation){
			if($i%2==0){
				echo '<tr><td bgcolor="#e5e5e5" style="padding-left: 5px;">'.$specialistPropertyLocation['city'].'('.$specialistPropertyLocation['state'].')</td></tr>';
			}
			else{
				echo '<tr><td style="padding-left: 5px;">'.$specialistPropertyLocation['city'].'('.$specialistPropertyLocation['state'].')</td></tr>';
			}
		}
	}?>	
</table>
<div>
<p>We deal in the following specialist types:</p>
<?php 
	if($specialistTypes){
		foreach($specialistTypes as $i=>$specialistType){
			if($i){
				echo '<p class="grybrd mar_t15">&nbsp;</p>';
			}
			echo '<p class="red-txt mar_t10 font12">'.$specialistType->specialist.'</p>';
			if($specialistProjects){
				foreach ($specialistProjects as $specialistProject){
					echo '<p class="Loc_list3 font12 grytxt flt_lft">';
					if($specialistProject->specialist_type_id ==$specialistType->id){
						echo '<span><label>'.$specialistProject->project_name.'</label></span>'; 
					}
				}
			}
			echo '</p>';
		}
	}
?>
</div>
</fieldset>
</div>
</div>
</div>
<br class="clear" />
</div>
</div>
