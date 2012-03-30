<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#tabs-profile").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
		$("#tabs-profile li").removeClass('ui-corner-top');
	});
</script>
<style type="text/css">
	#tabs-profile .ui-widget-content{
		border:1px solid #C3D0E1 !important;
		background:#f4f4f4 !important;
	}
</style>
<div id="property_search">
<h1 class="heading" id="heading">Profile</h1>
<div id="tabs-profile">
    <ul>
        <li><a href="#profile"><span>Profile</span></a></li>
        <?php 
        	if($agentProfile)
        		echo '<li><a href="#agent"><span>Agent Profile</span></a></li>';
        	if($builderProfile)
        		echo '<li><a href="#builder"><span>Builder Profile</span></a></li>';
        	if($specialistProfile)
        		echo '<li><a href="#specialist"><span>Specialist Profile</span></a></li>';
        ?>
    </ul>
    <div id="profile" class="tab_profile_container">
    <div class="left"><img src="<?php echo $userImages[0]; ?>" alt="" width="150" height="98" /></div>
    
    <table width="550" border="0" cellspacing="0" cellpadding="0" class="right">
      <tr>
        <td> <label class="left">First Name </label> <p class="left"> <?php echo $userProfile->first_name; ?></p>
        	<br class="clear" />
            <label class="left" >Last Name </label> <p class="left"><?php echo $userProfile->last_name; ?></p>
        	<br class="clear" />
             <label class="left">Gender </label> <p class="left"><?php echo $userProfile->gender; ?></p>
        	<br class="clear" />
            <label class="left">Address</label> <p class="left"><?php echo $userProfile->address_line1.", ".$userProfile->address_line2; ?>,<br />
			<?php echo $userAddress['city']." - ". $userProfile->zip.", ".$userAddress['state'].", ".$userAddress['country']; ?></p>
            <br class="clear" />
             
        </td>
        <td><label class="left">Mobile</label> <p class="left"><?php echo $userProfile->mobile; ?></p>
        <br class="clear" />
             <label class="left">Telephone</label>  <p class="left"><?php echo $userProfile->telephone; ?></p>
             <br class="clear" />
             </td>
      </tr>
    </table>
            <br class="clear" />
            <div class="profile_img">
            <h1>Images</h1>
            
            <?php 
            	if($userImages){
	            	Yii::import('ext.jqPrettyPhoto');
					$options = array(
						    'slideshow'=>5000,
						    'autoplay_slideshow'=>false, 
						    'show_title'=>false
					);
					jqPrettyPhoto::addPretty('.gallery_prettyphoto a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);
					echo '<div class="gallery_prettyphoto"><ul>';
					foreach($userImages as $userImage){
						echo '<li><a href="'.$userImage.'" rel="profile[gallery]"><img src="'.$userImage.'" width="180" height="150" alt="" /></a></li>';
					}
					echo '</ul></div>';
            	}
            ?>
        <br class="clear" />
        </div>
        <br class="clear" />
    </div>
    <?php if($agentProfile) { ?>
    <div id="agent" class="tab_profile_container">
    
    <div class="left">
    <?php
    	echo '<a href="'.$agentImage.'" rel="agent[gallery]"><img src="'.$agentImage.'" alt="" width="150" height="98" /></a>';
    ?></div>
    <table width="580" border="0" cellspacing="0" cellpadding="0" class="right">
      <tr>
        <td> <label class="left" style="width:105px;">Company Name </label> <p class="left"><?php echo $agentProfile->company_name; ?></p>
        	<br class="clear" />
            <label class="left" style="width:105px;">Address</label> <p class="left"><?php echo $agentProfile->address_line1 .", ". $agentProfile->address_line2 .", "; ?><br />
			<?php echo $agentAddress['city'].", ".$agentAddress['state'].", ".$agentAddress['country']; ?></p>
            <br class="clear" />
             
        </td>
        <td><label class="left">Mobile</label> <p class="left"><?php echo $agentProfile->mobile; ?></p>
        <br class="clear" />
             <label class="left">Phone</label>  <p class="left"><?php echo $agentProfile->telephone; ?></p>
             <br class="clear" />
             <label class="left">Email</label> <p class="left"><?php echo $agentProfile->email; ?></p>
             <br class="clear" />
             </td>
      </tr>
    </table>
    <br class="clear" />
    <label>Company Description </label>
    <p> <?php echo $agentProfile->company_description; ?> </p>

            <br class="clear" />
    </div>
    <?php } ?>
    <?php if($builderProfile) { ?>
    <div id="builder" class="tab_profile_container">
    <div class="left">
    <?php 
    echo '<a href="'.$builderImage.'" rel="builder[gallery]"><img src="'.$builderImage.'" alt="" width="150" height="98" /></a>';
    ?></div>
	<table width="580" border="0" cellspacing="0" cellpadding="0" class="right">
      <tr>
        <td> <label class="left" style="width:105px;">Company Name </label> <p class="left"><?php echo $builderProfile->company_name; ?></p>
        	<br class="clear" />
            <label class="left" style="width:105px;">Address</label> <p class="left"><?php echo $builderProfile->address_line1 .", ". $builderProfile->address_line2 .", "; ?><br />
			<?php echo $builderAddress['city'].", ".$builderAddress['state'].", ".$builderAddress['country']; ?></p>
            <br class="clear" />
             
        </td>
        <td><label class="left">Mobile</label> <p class="left"><?php echo $builderProfile->mobile; ?></p>
        <br class="clear" />
             <label class="left">Phone</label>  <p class="left"><?php echo $builderProfile->telephone; ?></p>
             <br class="clear" />
             <label class="left">Email</label> <p class="left"><?php echo $builderProfile->email; ?></p>
             <br class="clear" />
             </td>
      </tr>
    </table>
    <br class="clear" />
    <label>Company Description </label>
    <p> <?php echo $builderProfile->company_description; ?></p>
            <br class="clear" />
    </div>
    <?php } ?>
    <?php if($specialistProfile) { ?>
    <div id="specialist" class="tab_profile_container">
    <div class="left">
    <?php //<img src="images/photo1.jpg" alt="" width="150" height="98" /></div>?>
    <?php 
    echo '<a href="'.$specialistImage.'" rel="specialist[gallery]"><img src="'.$specialistImage.'" alt="" width="150" height="98" /></a>'; 
    ?></div>
		<table width="580" border="0" cellspacing="0" cellpadding="0" class="right">
      <tr>
        <td> <label class="left" style="width:135px;">Company Name </label> <p class="left"><?php echo $specialistProfile->company_name; ?></p>
        	<br class="clear" />
             <label class="left" style="width:135px;">Contact Person Name  </label> <p class="left"><?php echo $specialistProfile->contact_person_name; ?></p>
            <br class="clear" />
            <label class="left" style="width:135px;">Address</label> <p class="left"><?php echo $specialistProfile->address_line1 .", ". $specialistProfile->address_line2 .", "; ?><br />
			<?php echo $specialistAddress['city'].", ".$specialistAddress['state'].", ".$specialistAddress['country']; ?></p>
            <br class="clear" />
             
        </td>
        <td><label class="left">Mobile</label> <p class="left"><?php echo $specialistProfile->mobile; ?></p>
        <br class="clear" />
             <label class="left">Phone</label>  <p class="left"><?php echo $specialistProfile->telephone; ?></p>
             <br class="clear" />
             <label class="left">Email</label> <p class="left"><?php echo $specialistProfile->email; ?></p>
             <br class="clear" />
             </td>
      </tr>
    </table>

            <br class="clear" />
        <?php 
        	if($specialistProjects){
        		$specialistIds = null;
        		foreach($specialistProjects as $specialistProject){
        			$specialistIds[] = $specialistProject->specialist_type_id;
        		}
        		$specialists = DbUtils::getDbValues(new Specializations,'id',$specialistIds,'specialist');
				echo '<div class="specialist_project_details"><h1>Project Details</h1><ul>';
				foreach($specialistProjects as $specialistProject){
					echo '<li><img src="images/photo1.jpg" alt="" class="left" /> 
		                <div class="right" style="width:550px;">
		                <h2>'.$specialistProject->project_name.'</h2>
		                <p class="red-txt"><b>'.$specialists[$specialistProject->specialist_type_id].'</b> </p>
		                <p>'.$specialistProject->description.'</p>
		                </div>
		                <br class="clear" />
		                </li>';
				}	
				echo '</ul></div>';
        	}
        ?>
    </div>
    <?php } ?>
    <br class="clear" />
</div>
</div>
