<script type="text/JavaScript" src="includes/curvycorners.js"></script>
<script src="includes/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="includes/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/cufon-yui.js"> </script>
<script src="includes/myriad-pro.cufonfonts.js" type="text/javascript"></script>
<script type="text/javascript">Cufon.replace('', { fontFamily: 'Myriad Pro Regular', hover: true });</script>
<link rel="stylesheet" type="text/css" href="includes/styles.css" />
<?php if($agent->user_id==Yii::app()->user->id){
echo '<div style="float:right"><a href="/agent/update" class="red-txt">Edit Profile</a></div>';
}?>
<style type="text/css">
.builders-proj{}
.builders-proj td{ padding:5px 0px 0 10px; border:#CCCCCC 1px solid; line-height:30px;}
.btn-search{ text-align:center;}
</style> 
<div id="property_search">
<h1 class="heading">Agent Profile</h1>
<div class="inner-column">
<div class="left cols1">
<div align="center">
<img src="<?php echo ImageUtils::getImageUrl('agents',$agent->user_id,$agent->image); ?>" alt="" width="223" height="146" />
</div>
<div class="white_wrap">
<h2>Agent Information</h2>
<div style="padding: 10px;">
<p><b><?php echo $agent->company_name; ?></b><br />
<?php echo $agentInfo->first_name; ?><br />
<?php echo $agent->address_line1; ?><br />
<?php echo $agent->address_line2; ?><br />
<span>Mobile :</span> <?php echo $agent->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $agent->email; ?>"><?php echo $agent->email; ?></a>

</p>
</div>
</div>
<div class="white_wrap">
<h2>Search Agent by Locality</h2>
<div style="padding: 15px 10px;">
<form action="#">
<input type="text" name="search_locality" class="txtbox-agent-local" />
<input type="submit" value="" class="btn-search-now" />
</form>
</div>
</div>
</div>
<div class="right cols2">
<div id="property_details">
<div class="property_details_wrap">
<div style="border-bottom:#CCC 1px solid; margin-bottom:5px;">
<h1 class="left"><?php echo $agent->company_name; ?></h1>
<div class="right" style="width:172px;">
<div class="ratings_wrap">
<h3 class="left" style="width:30px">&nbsp;</h3>
<?php if((Yii::app()->user->checkAccess('front-AgentRating'))&&($agent->id)){ 
	$url= 'front/agent/starRatingAjax/userId/'.Yii::app()->user->id.'/agentId/'.$agent->id;
	$this->widget('StarRating',array('rating'=>$agentRating,'url'=>$url,'ratingReadOnly'=>$agentRatingReadOnly)); 
}?>
</div>
</div>
<br class="clear" />
</div>
<p class="left"><b>Address : </b><?php echo $agentAddress['city'].','.$agentAddress['state'].','.$agentAddress['country'] ?>.</p>
<p class="right">Registered since - <?php echo date("F Y", strtotime($agent->created_time));?></p><br class="clear" />
<fieldset><legend>About Us</legend>
<p><?php echo $agent->company_description; ?></p>
</fieldset>

<fieldset><legend>Locations We Deal In</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	style="margin-top: 10px;">
	<?php 
	if($agentPropertyLocations){
		foreach ($agentPropertyLocations as $i=>$agentPropertyLocation){
			if($i%2==0){
				echo '<tr><td bgcolor="#e5e5e5" style="padding-left: 5px;">'.$agentPropertyLocation['city'].'('.$agentPropertyLocation['state'].')</td></tr>';
			}
			else{
				echo '<tr><td style="padding-left: 5px;">'.$agentPropertyLocation['city'].'('.$agentPropertyLocation['state'].')</td></tr>';
			}
		}
	}?>	
</table>
</fieldset>
  <fieldset>
                	<legend>Current Property</legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="builders-proj">
                      <tr style="background-color:#e0e0e0;">
                        <td>Property Type</td>
                        <td>Property Name</td>
                        <td align="center">Details</td>
                      </tr>
                      <?php 
                      if($agentProperties){
							foreach ($agentProperties as $agentProperty){
                      			echo '<tr>
                       				 <td valign="middle">'.$agentPropertyTypes[$agentProperty->property_type_id].'</td>
                       				 <td valign="middle">'.$agentProperty->property_name.'</td>
                       				 <td align="center" valign="middle"><a href="/property/'.$agentProperty->id.'" class="btn-search">View Details</a></td>
                      				 </tr>';
							}
							echo '</table><div style="float:left; margin-top:10px; margin-left:510px"><a href="/search/property#agent_id='.$agent->id.'" class="red-txt">View All Properties</a></div>';
                      }
                      else
                      	echo '</table>';?>
              </fieldset> 
</div>
</div>
</div>
<br class="clear" />
</div>
</div>
