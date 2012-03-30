<div id="property_search">
<h1 class="heading" id="heading">My Wishlists</h1>
<div class="inner-column">
<?php 
	$this->widget('MyAccountMenu',array('page'=>'wishlists'));
	if($properties==null/* && $projects==null*/){				
		echo '<div style="padding-top:20px" align="center"><b class="red">Result not found.</b></div>';
	}
	else{
		if($properties!=null)
			$this->widget('PropertySearchResults',array('properties'=>$properties,
														'propertiesCount'=>$count,
														'pages'=>$pages,
														'wishlistRemove'=>true
														));
		/*if($projects!=null)
			$this->widget('ProjectSearchResults',array('projects'=>$projects));*/
	}
?>
<br clear="all" />
</div>
</div>