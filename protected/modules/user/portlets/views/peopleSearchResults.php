<?php

	$user_type='';
	if($users){
		$user_type = isset($_POST['user_type'])?$_POST['user_type']:'agent';
		
		echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">'.count($users).' '.$user_type.'s Found <span class="right"></span> </h1>
            <div id="user-results">';
		foreach($users as $user){
			
			if(isset($images[$user->id]))
				$image = $images[$user->id];
			$userProfile = userApi::getUserProfileDetails($user->id);
			?>
			<?php 
			
		    $profile = null;
            if($user_type=="agent"){
            	$profile = AgentProfileApi::getAgentDetails($user->id);
            }
            elseif($user_type=="builder"){
            	
            	$profile = BuilderProfileApi::getBuilderDetails($user->id);
            	//echo '<pre>';var_dump($profile->company_name);die();
            	
            }
			elseif($user_type=="specialist"){
            	$profile = SpecialistProfileApi::getSpecialistDetails($user->id);
            	
            }
			
			?>
			<div class="post" style="cursor:pointer;" onClick="location.href='<?php echo Yii::app()->createAbsoluteUrl('/profile/'.$profile->id); ?>'">
            <?php echo '<div class="left">';
            echo '<img src="'.$image.'" width="124" alt="" />';
            $address = DbUtils::getAddress($profile['city_id']);
			echo '<br />
                    
                    </div>
                    <div class="right" style="width:533px;">
                    	<h1><a href="#">'.$profile['company_name'].'</a></h1>
                        <h4>Office Address : <span>'.$profile['address_line1'].', '.$profile['address_line2'].', '.$address['city'].', '.$address['state'].', '.$address['country'].'</span> </h4>';
            if($user_type=="specialist"){
            	$specialists = SpecialistTypeApi::getSpecialistTypeByUserId($user->id);
            	if($specialists){
            		$types = null;
            		foreach($specialists as $i=>$specialist){
            			if($i!=0)
            				$types.=', ';
            			$types.=$specialist->specialist;
            		}	
            		echo '<h4>Specialist in : <span>'.$types.'</span> </h4>';
            	}
            }
            else{
            	$properties = PropertyApi::getPropertyTypesByUserId($user->id);
            	if($properties){
            		$types = null;
            		foreach($properties as $i=>$property){
            			if($i!=0)
            				$types.=', ';
            			$types.=PropertyTypesApi::getPropertyTypeById($property->property_type_id);
            		}	
            		echo '<h4>Dealing in : <span>'.$types.'</span> </h4>';
            	}
            	else
					echo '<h4>Dealing in : <span>Residential Land</span> </h4>';
            }
           	echo '<h4 class="left">Description : </h4>
                        <p class="right">'.substr($profile['company_description'],0,150).' .....
                        	<a href="/profile/'.$profile->id.'#'.$user_type.'">more</a></p>
                            <br class="clear" />
                      <div class="right"><a href="/profile/'.$profile->id.'#'.$user_type.'" class="btn-view-details"></a> </div>
                    </div>
                    <br class="clear" />
                </div>';
		}
		echo '</div>
        </div>
    </div>';
	}
	else{
		echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
	}

?>

<?php if($user_type=="agent")
{$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#user-results',
    'itemSelector' => 'div.agent',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pagesAgent,
));} 
else if($user_type=="builder")
{
	$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#user-results',
    'itemSelector' => 'div.builder',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pagesBuilder,

));}
else if($user_type=='specialist')
{
	$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#user-results',
    'itemSelector' => 'div.specialist',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pagesSpecialists,

));
	
}
 $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#user-results',
    'itemSelector' => 'div.user',
    'loadingText' => 'Loading...',
   	'donetext' => 'No more results found',
    'pages' => $pagesUser,
)); ?>