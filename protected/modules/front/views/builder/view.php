<script type="text/JavaScript" src="includes/curvycorners.js"></script>
<script src="includes/jquery.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="includes/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/cufon-yui.js"> </script>
<script src="includes/myriad-pro.cufonfonts.js" type="text/javascript"></script>
<script type="text/javascript">Cufon.replace('', { fontFamily: 'Myriad Pro Regular', hover: true });</script>
<link rel="stylesheet" type="text/css" href="includes/styles.css" />
<?php if($builder->user_id==Yii::app()->user->id){
echo '<div style="float:right"><a href="/builder/update" class="red-txt">Edit Profile</a></div>';
}?>
<div id="property_search">
<h1 class="heading">Builder Profile</h1>
<div class="inner-column">
<div class="left cols1">
<div align="center">
<img src="<?php echo ImageUtils::getImageUrl('builders',$builder->user_id,$builder->image); ?>" alt="" width="223" height="146" />
</div>
<div class="white_wrap">
<h2>Builder Information</h2>
<div style="padding: 10px;">
<p><b><?php echo $builder->company_name; ?></b><br />
<?php echo $builderInfo->first_name; ?><br />
<?php echo $builder->address_line1; ?><br />
<?php echo $builder->address_line2; ?><br />
<span>Mobile :</span> <?php echo $builder->mobile; ?> <br />
<span>Email: </span> <a href="mailto:<?php echo $builder->email; ?>"><?php echo $builder->email; ?></a>

</p>
</div>
</div>
<div class="white_wrap">
<h2>Search Builder by Locality</h2>
<div style="padding: 15px 10px;">
<form action="#">
<input type="text" name="search_locality" class="txtbox-builder-local" />
<input type="submit" value="" class="btn-search-now" />
</form>
</div>
</div>
</div>
<div class="right cols2">
<div id="property_details">
<div class="property_details_wrap">
<div style="border-bottom:#CCC 1px solid; margin-bottom:5px;">
                	<h1 class="left"><?php echo $builder->company_name; ?></h1>
                    <div class="right" style="width:172px;">
                	<div class="ratings_wrap">
                  <h3 class="left" style="width:30px">&nbsp;</h3>
					<?php if((Yii::app()->user->checkAccess('front-BuilderRating'))&&($builder->id)){ 
              				$url= 'front/builder/starRatingAjax/userId/'.Yii::app()->user->id.'/builderId/'.$builder->id;
                			$this->widget('StarRating',array('rating'=>$builderRating,'url'=>$url,'ratingReadOnly'=>$builderRatingReadOnly)); 
			  		}?>
                  </div>
        </div>
        	<br class="clear" />
            </div>
<p class="left"><b>Address : </b><?php echo $builderAddress['city'].','.$builderAddress['state'].','.$builderAddress['country'] ?>.</p>
<p class="right">Registered since - <?php echo date("F Y", strtotime($builder->created_time));?></p><br class="clear" />
<fieldset><legend>About Us</legend>
<p><?php echo $builder->company_description; ?></p>
</fieldset>

<fieldset><legend>Locations We Deal In</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	style="margin-top: 10px;">
	<?php 
	if($builderProjectLocations){
		foreach ($builderProjectLocations as $i=>$builderProjectLocation){
			if($i%2==0){
				echo '<tr><td bgcolor="#e5e5e5" style="padding-left: 5px;">'.$builderProjectLocation['city'].'('.$builderProjectLocation['state'].')</td></tr>';
			}
			else{
				echo '<tr><td style="padding-left: 5px;">'.$builderProjectLocation['city'].'('.$builderProjectLocation['state'].')</td></tr>';
			}
		}
	}?>	
</table>
</fieldset>
<fieldset><legend>Current Projects</legend>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="builders-proj">
                      <tr style="background-color:#e0e0e0;">
                        <td width="23%">Project Type</td>
                        <td width="37%">Project Name</td>
                        <td width="18%" align="left">No of Properties</td>
                        <td width="22%" align="center">Details</td>
                      </tr>
                      <?php 
                      if($builderProjects){
							foreach ($builderProjects as $builderProject){
                      			echo '<tr>
                        			  <td valign="middle">'.$builderProjectTypes[$builderProject->project_type_id].'</td>
                   				      <td valign="middle">'.$builderProject->project_name.'</td>
                        			  <td align="center" valign="middle">'.ProjectPropertiesApi::getPropertyCount($builderProject->id).'</td>
                        			  <td align="center" valign="middle"><a href="/project/'.$builderProject->id.'" class="btn-search">View Details</a></td>
                      				</tr>';
							}
							echo '</table>
									<div style="float:left; margin-top:10px; margin-left:510px"><a href="/search/project#builder_id='.$builder->id.'" class="red-txt">View All Projects</a></div>';
							
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
