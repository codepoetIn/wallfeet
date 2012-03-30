<?php 
	$user_type='';
	if($users){ 	?>
		<?php $user_type = $userType;?>
		<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top"><?php echo count($users) .' '.$user_type ?>(s) Found <span class="right"></span> </h1>
            <div id="user-results">
		<?php foreach($users as $user){ 
		//	echo $user->id;
		//	echo '<br/>';
		//	continue;
			if(isset($images[$user->id]))
			$image = $images[$user->id];
			$userProfile = UserApi::getUserProfileDetails($user->id);
			
		    $profile = null;
            if($user_type=="agent"){
            	$profile = AgentProfileApi::getAgentDetails($user->id);
            	
            //	echo $profile->id;
            	
            }
            elseif($user_type=="builder"){            	
            	$profile = BuilderProfileApi::getBuilderDetails($user->id);
            	//echo '<pre>';var_dump($profile->company_name);die();            	
            }
			elseif($user_type=="specialist"){
            	$profile = SpecialistProfileApi::getSpecialistDetails($user->id);
            	
            }
			
			?>
			<div class="post agent" style="cursor:pointer;" onClick="window.open('<?php echo  Yii::app()->createAbsoluteUrl('/'.$user_type.'/'.$user->id); ?>')">
            <div class="left">
            <img src="<?php echo $image ?>" width="124" alt="" />
            <?php $address = DbUtils::getAddress($profile['city_id']); ?>
			<br />        
            </div>
            <div class="right" style="width:533px;">
            <h1><a href="#"><?php echo $profile['company_name'] ?></a></h1>
            <h4>Office Address : <span>
            <?php echo $profile['address_line1'].', '.$profile['address_line2'].', '.$address['city'].', '.$address['state'].', '.$address['country'] ?></span> </h4>
            <?php if($user_type=="specialist"){
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
                        	<a href="/'.$user_type.'/'.$user->id.'" target="_blank">more</a></p>
                            <br class="clear" />
                      <div class="right"><a href="/'.$user_type.'/'.$user->id.'" class="btn-view-details" target="_blank"></a> </div>
                    </div>
                    <br class="clear" />
                </div>';
		}
		echo '</div>
        </div>
    </div>';
	}
	else{
		//echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
		
		echo '<div style="padding-top:20px; font-size:24px" align="center"><b class="red">Oops...!</b></div>';
		echo '<div style="padding-top:10px" align="center"><b class="red">Result not found.</b></div>';
		echo '<div style="padding-top:8px" align="center"><b class="red">To Post Your Requirement </b><a href="/requirement/post"><b style="color:#035BA9;">Click Here</b></a></div>';
	}

?>

<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#user-results',
    'itemSelector' => 'div.agent',
    'loadingText' => 'Loading...',
    'donetext' => 'No more results found',
    'pages' => $pages,
)); 
 ?>