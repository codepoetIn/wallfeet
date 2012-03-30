<?php 
if($properties){ ?>
		<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top"><?php echo $propertiesCount; ?> Properties Found <span class="right"></span> </h1>
		<div id="search-results">
		<?php foreach($properties as $property): ?>			
			<?php if(isset($images[$property->id]))
				$image = $images[$property->id];?>
			<div class="post property" style="cursor:pointer;" onClick="window.open('<?php echo Yii::app()->createAbsoluteUrl('/property/'.$property->id); ?>')">
            <div class="left">
           	<img src="<?php echo $image;?>" width="124" alt="" />
            <br /><a href="/property/<?php echo $property->id;?>">Rate : <?php echo PropertyRatingApi::getRating($property->id)?></a>
            </div>
            <div class="right" style="width:533px;">
            <h1><a href="#"><?php echo $property->property_name; ?></a></h1>
            <?php if($property->total_price): ?>
            	<h3>Price Rs. <?php echo $property->total_price ?></h3>
            <?php else: ?>
            	<h3> </h3>
            	<?php endif;?>
            	<p><?php echo substr($property->description,0,150) ?> ...<a href="/property/<?php echo$property->id; ?>" target="_blank">more</a></p>
                        <div class="left bedrooms"><span><?php echo $property->bedrooms ?></span> Bedrooms | <span><?php echo $property->available_units; ?></span> Sq.Ft | <span>Rs. <?php echo $property->per_unit_price?>/ </span> Sq.Ft | <?php echo $property->propertyType->property_type?></div>
                        <div class="right"><a href="/property/<?php echo $property->id;?>" class="btn-view-details" target="_blank"></a> </div>
                    </div>
                    <br class="clear" />
                </div>
				<?php endforeach;?>
		        </div></div>
		    </div>
		    <?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
			    'contentSelector' => '#search-results',
			    'itemSelector' => 'div.property',
			    'loadingText' => 'Loading...',
			    'donetext' => 'No more results found',
			    'pages' => $pages,
			)); ?>
<?php 	} else{ 
		//echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
		
		echo '<div style="padding-top:20px; font-size:24px" align="center"><b class="red">Oops...!</b></div>';
		echo '<div style="padding-top:10px" align="center"><b class="red">Result not found.</b></div>';
		echo '<div style="padding-top:8px" align="center"><b class="red">To Post Your Requirement </b><a href="/requirement/post"><b style="color:#035BA9;">Click Here</b></a></div>';
	 } ?>


