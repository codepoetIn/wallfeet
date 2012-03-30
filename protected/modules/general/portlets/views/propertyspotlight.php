   <div class="widget-project">
        <h2 class="head-tab">Property Spotlight</h2>
 		 <div class="tabbed_area">
 		 <div class="tabs-widget">
            <ul id="slider1">
            <?php 
            if($propertySpotlight){
            	
            	foreach ($propertySpotlight as $property){
            $city=GeoCityApi::getCityNameByID($property->city_id);
           	$propertytype=PropertyTypesApi::getPropertyTypeById($property->property_type_id);
           	?>
              <li><a href="/property/<?php echo $property['id']?>" title="<?php echo $property['property_name']?>"><img src="<?php  if(isset($propertyImages[$property->id])){echo $propertyImages[$property->id];} else{ echo Yii::app()->theme->baseUrl.'/images/no.jpg';} ?>" width="139" height="100" border="0" title="<b><?php echo $property['property_name'] ?></b> <br /> <?php echo $city->city?><br /> 
              <?php echo $propertytype;?><br /> <a href='#'>More details</a>" /></a></li>
            <?php }
            	}?>
            </ul>
            <br class="clear" />
    <div class="clear"></div>
    </div>
  </div>

</div>