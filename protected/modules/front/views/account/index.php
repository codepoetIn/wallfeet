<!--Dashboard Accordion-->

<link
	rel="stylesheet"
	href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/cupertino/jquery-ui.css"
	type="text/css" />
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
	</script>

<?php  $this->widget('ProfileDetails')?>
<?php $this->widget('PropertyOwnerMenu')?>
<?php $this->widget('PropertySeekerMenu')?>
<?php $this->widget('ProfileOwnerMenu')?>
<?php $this->widget('ManageOwnerProfile')?>
<div id="accordion">
<h3><a href="#">My Messages</a>
<div><?php  echo $countUnread;?> New</div>
</h3>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	class="my_messages">
	<thead>
		<tr>
			<th width="14%" style="padding-left: 8px;">From</th>
			<th width="23%">Subject</th>
			<th width="63%" align="left">Message</th>
		</tr>
	</thead>
	<?php
	if($inbox)
	{
		foreach($inbox as $message){
			$value='';
			if($message->inbox_unread==1)
			$value='unread';
			$content=substr($message->content,0,50);
			if(strlen($message->content)>50)
			$content=substr($message->content,0,50).'...';
			$subject=substr($message->subject,0,15);
			if(strlen($message->subject)>15)
			$subject=substr($message->subject,0,15).'...';
			echo '<tr class="'.$value.'">
            <td colspan="3">
            <a href="/message/'.$message->id.'"><div class="c1">'.$users[$message->from_user_id].'</div> <div class="c2">'.$subject.'</div> <div class="c3">'.$content.'</div></a></td>
          </tr>';
		}
		echo '<tr><td colspan="5"><div align="right"><a href="/messages" class="red-txt">View All Message</a></div></td></tr>';
	}else
	{
		echo'<tr class="red-txt">
            <td colspan="5">
           <a href="/messages"><div class="red-txt" align="center"><b>No Messages</b></div></a>
          </tr>';
	}

	?>

</table>
</div>
<h3><a href="#">My Properties</a>
<div><?php echo $propertyCount?> Properties</div>
</h3>
<div>
<table width="909" border="0" cellspacing="0" cellpadding="0"
	class="my_messages">
	<thead>
		<tr>
			<th width="400" style="padding-left: 8px;">Property Name</th>
			<th width="130">City</th>
			<th width="128" align="left">Property Type</th>
			<th width="198" align="left">Looking To</th>
			<th width="42" align="left"></th>
		</tr>
	</thead>
	<?php
	if($properties)
	{
		foreach($properties as $property)
		{	
		$image=ImageUtils::getDefaultImage('properties');
		if(isset($propertyImages[$property->id]))
			$image=$propertyImages[$property->id];
			
		echo '<tr>
            <td colspan="5">
            <a href="/property/'.$property->id.'"><div class="c1_1">'.$property->property_name.'</div> <div class="c2_1">'.$propertyLocations[$property->city_id].'</div> <div class="c3_1">'.$propertyTypes[$property->property_type_id].'</div> <div class="c4">'.$property->i_want_to.'</div><div class="c5_1"><img src="'.$image.'" alt="" width="61" height="40" /></div></a></td>
          </tr>';
		}
		echo '<tr><td colspan="5"><div align="right"><a href="/properties" class="red-txt">View All Properties</a></div></td></tr>';
	}
	else
	{
		echo'<tr>
            <td colspan="5">
            <div class="red-txt" align="center"><b>No Properties</b></div>
            </td>
          </tr>';
	}
	?>

</table>
</div>

<h3><a href="#">My Profiles</a>
<div></div>
</h3>
<div>
<table width="909" border="0" cellspacing="0" cellpadding="0"
	class="my_messages">
	<thead>
		<tr>
		 <td><h2>Agent Profile</h2></td>
		 <?php if($isProfile['agent']) { ?>
         <td align="right"><a href="/agent/update" class="red-txt">Update Profile</a></br>
         <?php echo CHtml::link(
		    'Delete Profile',
		     array('/agent/delete'),
		     array('confirm' => 'Are you sure you want to remove your agent profile ?','class'=>'red-txt')
		 );
         ?><br/>       		  
         <a href="/agent/<?php echo Yii::app()->user->id; ?>" class="red-txt">View Profile</a></td>
         <?php } else { ?>
         <td align="right"><a href="/agent/create" class="red-txt">Create Profile</a></td>
        <?php } ?>
        </tr>
        <tr>
        <td><h2>Builder Profile</h2></td>
        <?php if($isProfile['builder']) { ?> 
        <td align="right"><a href="/builder/update" class="red-txt">Update Profile</a></br>
        <?php echo CHtml::link(
			    'Delete Profile',
			     array('/builder/delete'),
			     array('confirm' => 'Are you sure you want to remove your builder profile ?','class'=>'red-txt')
		);
        ?><br/>  	  
        <a href="/builder/<?php echo Yii::app()->user->id; ?>" class="red-txt">View Profile</a></td>
        <?php } else { ?>
        <td align="right"><a href="/builder/create" class="red-txt">Create Profile</a></td>
        <?php } ?>
        </tr>
        <tr>
        <td><h2>Specialist Profile</h2></a></td>
        <?php if($isProfile['specialist']) { ?>
        	<td align="right"><a href="/specialist/update" class="red-txt">Update Profile</a></br>
        	<?php echo CHtml::link(
			    'Delete Profile',
			     array('/specialist/delete'),
			     array('confirm' => 'Are you sure you want to remove your specialist profile ?','class'=>'red-txt')
			);
        	?><br/>  		  
        	<a href="/specialist/<?php echo Yii::app()->user->id; ?>" class="red-txt">View Profile</a></td>
        <?php } else { ?>
        	<td align="right"><a href="/specialist/create" class="red-txt">Create Profile</a></td>
        <?php } ?>		
		</tr>
	</thead>
</table>
</div>
<h3><a href="#">My Wishlists</a>
<div><?php echo $totalWishlistCount?> Wishlists</div>
</h3>
<div>
<table width="909" border="0" cellspacing="0" cellpadding="0"
	class="my_messages">
	<thead>
		<tr>
			<th width="286" style="padding-left: 8px;">Name</th>
			<th width="286" align="left">Type</th>
			
			<th width="42" align="left"></th>
		</tr>
		<?php
		if($propertyWishList) 
		{
			if($propertyWishList)
			{
				foreach($propertyWishList as $property)
				{
				echo '<tr>
		            <td colspan="5">
		            <a href="/property/'.$property->property_id.'"><div class="c1_1" style="width:420px !important">'.$propertyName[$property->property_id].'</div> <div class="c2_1" style="width:286px !important">Property</div></a></td>
		          </tr>';
				}
			}
			/*if($projectWishlist)
			{
				foreach($projectWishlist as $project)
				{
					echo '<tr>
		            <td colspan="5">
		            <a href="/project/'.$project->project_id.'"><div class="c1_1" style="width:420px !important">'.$projectName[$project->project_id].'</div> <div class="c2_1" style="width:286px !important">Project</div></a></td>
		          </tr>';
				}
			}*/
			echo '<tr><td colspan="5"><div align="right"><a href="/wishlists" class="red-txt">View All Wishlists</a></div></td></tr>';
		}
		else
		{
		echo'<tr>
            <td colspan="5">
            <div class="red-txt" align="center"><b>No Wishlist</b></div>
            </td>
          </tr>';
		}
          ?>
	</thead>
</table>
</div>
<h3><a href="#">My Requirements</a>
<div><?php echo $requirementscount?> Requirement</div>
</h3>
<div>
<table width="909" border="0" cellspacing="0" cellpadding="0"
	class="my_messages">
	<thead>
		<tr>
			<th width="50" style="padding-left: 8px;">Looking For</th>
			<th width="286" align="left">Description</th>
			
			<th width="42" align="left"></th>
		</tr>
		</thead>
		<?php 
		if($requirements)
		{
			foreach($requirements as $requirement)
			{		
				$description=substr($requirement->description,0,50);
				if(strlen($requirement->description)>50)
				$description=substr($requirement->description,0,50).'...';
			echo '<tr>
	            <td colspan="3">
	            <a href="/requirement/'.$requirement->id.'"><div class="c1">'.$requirement->i_want_to.'</div><div class="c3">'.$description.'</div></a></td>
	          </tr>';
			}
			echo '<tr><td colspan="5"><div align="right"><a href="/requirements" class="red-txt">View All Requirements</a></div></td></tr>';			
		}
		else
		{
		echo'<tr>
            <td colspan="5">
            <div class="red-txt" align="center"><b>No Requirements</b></div>
            </td>
          </tr>';
		}
		?>
		</table>
</div>
<h3><a href="#">My Jukebox</a>
<div><?php echo $jukecount?> Jukebox</div>
</h3>
<div>
<table width="909" border="0" cellspacing="0" cellpadding="0"
	class="my_messages">
	<thead>
		<tr>
			<th width="130" style="padding-left: 8px;">Category Name</th>
			<th width="726">Question</th>
			<th width="42" align="left"></th>
		</tr>
	</thead>
	<?php 
	if($myJukeBox){
		foreach($myJukeBox as $Jukebox)
		{
				echo '<tr>
	            <td colspan="5">
	            <a href="/jukebox/'.$Jukebox->id.'"><div class="c2_1">'.$jukeBoxcategoryName[$Jukebox->category_id].'</div> <div class="c4_1">'.$Jukebox->question.'</div> </a></td>
	           </tr>';
		}
		echo '<tr><td colspan="5"><div align="right"><a href="/jukebox" class="red-txt">View All Jukebox</a></div></td></tr>';
	}
	else
	{
		echo'<tr>
            <td colspan="5">
            	<div class="red-txt" align="center"><b>No JukeBox</b></div>
            </td>
          </tr>';
	}
           ?>
	</table>
</div>
</div>

<br class="clear" />
</div>

<div class="clear"></div>
