<?php 
	if($projects){
		echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">'.count($projects).' Projects Found <span class="right"></span> </h1>
            <div id="project-results">';
		foreach($projects as $project){
			if(isset($images[$project->id]))
				$image = $images[$project->id]; ?>
			<div class="post project" style="cursor:pointer;" onClick="location.href='<?php echo Yii::app()->createAbsoluteUrl('/project/'.$project->id); ?>'">
            <?php echo '<div class="left">';
            echo '<img src="'.$image.'" width="124" alt="" />';
            echo '<br /><a href="/project/'.$project->id.'">Rate : '.ProjectRatingApi::getRating($project->id).'</a>';
            echo '</div>
                    <div class="right" style="width:533px;">
                    	<h1><a href="#">'.$project->project_name.'</a></h1>';
            if($project->total_price)
            	echo '<h3>Price Rs. '.$project->total_price.'</h3>';
            else
            	echo '<h3> </h3>';
            echo '<p>'.substr($project->description,0,150).' ...<a href="#">more</a></p>
                        <div class="left bedrooms"><span>Rs. '.$project->per_unit_price.'/ </span> Sq.Ft | '.OwnershipTypesApi::getOwnershipTypeById($project->ownership_type_id).'</div>
                        <div class="right"><a href="'. Yii::app()->createUrl('/project/'.$project->id) .'" class="btn-view-details"></a> </div>
                    </div>
                    <br class="clear" />
                </div>';
		}
		echo ' </div>
        </div>
    </div>';
	}
	else{
		echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
	}
	$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#project-results',
    'itemSelector' => 'div.project',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pagesProject,

));
?>