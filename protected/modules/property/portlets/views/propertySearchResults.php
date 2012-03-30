<?php 

if($properties){
		echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">'.$propertiesCount.' Properties Found <span class="right"></span> </h1>
            ';
		echo '<div id="test-results">';
		foreach($properties as $property){
			
			if(isset($images[$property->id]))
				$image = $images[$property->id];?>
			<div class="post property" style="cursor:pointer;" onClick="location.href='<?php echo Yii::app()->createAbsoluteUrl('/property/'.$property->id); ?>'">
            <?php echo '<div class="left">';
           	echo '<img src="'.$image.'" width="124" alt="" />';
            echo '<br /><a href="/property/'.$property->id.'">Rate : '.PropertyRatingApi::getRating($property->id).'</a>';
            echo '</div>
                    <div class="right" style="width:533px;">
                    	<h1><a href="#">'.$property->property_name.'</a></h1>';
            if($property->total_price)
            	echo '<h3>Price Rs. '.$property->total_price.'</h3>';
            else
            	echo '<h3> </h3>';
            echo '<p>'.substr($property->description,0,150).' ...<a href="/property/'.$property->id.'">more</a></p>
                        <div class="left bedrooms"><span>'.$property->bedrooms.'</span> Bedrooms | <span>'.$property->available_units.'</span> Sq.Ft | <span>Rs. '.$property->per_unit_price.'/ </span> Sq.Ft | '.$property->propertyType->property_type.'</div>
                        <div class="right">
                        <a href="/property/'.$property->id.'" class="btn-view-details"></a>';
              if($wishlistRemove){ ?>
              <a href="<?php echo Yii::app()->createUrl('/wishlist/delete/'.$property->id);?>">Remove from wishlist</a>
              <?php }
			  echo '</div>                        
                    </div>
                    <br class="clear" />
                </div>';
				}
				echo ' 
		        </div></div>
		    </div>';
	}
	else{
		//echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
		echo '<div style="padding-top:20px" align="center"></br><b class="red">Result not found.</b></div>';
	}
//echo '<pre>';var_dump($pages);die();
?>

<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#test-results',
    'itemSelector' => 'div.property',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pages,
)); ?>


