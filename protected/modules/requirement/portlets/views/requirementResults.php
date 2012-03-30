<?php

if ($requirements) {
	
	echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">' . $totalRequirements  . ' Requirements Found <span class="right"></span> </h1>
            ';
	echo '<div id="test-results">';
	
	foreach ( $requirements as $requirement ) { ?>
		
		<div class="post property" onClick="location.href='<?php echo Yii::app()->createUrl('/requirement/'.$requirement->id) ?>'" style="cursor:pointer;">
		<?php 
		echo '<h1>' . $requirement->i_want_to . '</h1>';
		echo '<div class="list_details">Properties : <span>';
		if (isset ( $propertyTypeIds [$requirement->id] )) {
			foreach ( $propertyTypeIds [$requirement->id] as $i => $propertyTypeId ) {
				if ($i)
					echo ", ";
				if (isset ( $properties [$propertyTypeId] )) {
					echo $properties [$propertyTypeId];
				}
			}
		}
		echo '</span></div>';
		
		echo '<div class="list_details">Cities : <span>';
		if (isset ( $cityIds [$requirement->id] )) {
			foreach ( $cityIds [$requirement->id] as $i => $cityId ) {
				if ($i)
					echo ", ";
				if (isset ( $cities [$cityId] )) {
					echo $cities [$cityId];
				}
			}
		}
		echo '</span></div>';
		echo '<div class="list_details">Amenities : <span>';
		if (isset ( $amenityids [$requirement->id] )) {
			foreach ( $amenityids [$requirement->id] as $i => $amenityid ) {
				if ($i)
					echo ", ";
				if (isset ( $amenities [$amenityid] )) {
					echo $amenities [$amenityid];
				}
			}
		}
		echo '</span></div>';
		if ($requirement->min_price && $requirement->max_price) {
			echo '<div class="list_details">Budget : <span>';
			echo $requirement->min_price . " to " . $requirement->max_price;
			echo '</span></div>';
		}
		//echo '<p>' . $requirement->description . '</p>';
		 echo '<p>'.substr($requirement->description,0,150).' ...<a href="/requirement/'.$requirement->id.'">more</a></p>';
                        
                    
                 echo  ' <br class="clear" />
                </div>';
	}
	
	echo ' 
		        </div></div>
		    </div>';

} 

else {
	echo '<div class="right cols2"><div id="requirement_search_results"><b class="red">No Result not found.</b></div></div>';
}

?>

<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#test-results',
    'itemSelector' => 'div.property',
    'loadingText' => 'Loading...',
    'donetext' => 'No More Results Found',
    'pages' => $pages,
)); ?>


