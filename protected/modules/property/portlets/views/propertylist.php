<?php 
	if($properties){
		echo '<div id="property_search_results" class="property_list">';
		foreach($properties as $property){
			if(isset($images[$property->id]))
				$image = $images[$property->id];
			echo '<div class="post">';
            echo '<div class="left">';
           	echo '<img src="'.$image.'" width="124" alt="" />';
            echo '<br /><a href="#"><img src="'.Yii::app()->theme->baseUrl.'/images/icon-map.png" alt="" class="left icon-locate" /> Locate on Map</a>';
            echo '</div>
                    <div class="right content">
                    	<h1>';if($property->bedrooms){echo $property->bedrooms.' '.BHK;} $property->property_name.'</h1>';
            if($property->total_price)
            	echo '<h3>Price Rs. '.$property->total_price.'</h3>';
            else
            	echo '<h3> </h3>';
            echo '<p>'.substr($property->description,0,150).' ...<a href="#">more</a></p>
                        <div class="left bedrooms"><span>'.$property->bedrooms.'</span> Bedrooms | <span>'.$property->available_units.'</span> Sq.Ft | <span>Rs. '.$property->per_unit_price.'/ </span> Sq.Ft | '.$property->propertyType->property_type.'</div>
                        <div style="margin-left:10px"><a href="/property/'.$property->id.'" class="btn-view-contact-details"></a> </div>
                    </div>
                    <br class="clear" />
                </div>';
		}
		echo '</div>';
	}
	else{
		//echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found. Please search again.</b></div></div>';
		echo '<div style="padding-top:20px" align="center"><b class="red">Result not found.</b></div>';
	}
?>