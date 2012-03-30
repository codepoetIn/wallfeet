<?php
class PropertySearchResults extends CWidget
{
	public $modelProperty;
	public $modelCity;
	public $propertyAmenities;
	public $properties;
	public $pages;
	public $propertiesCount;
	public $wishlistRemove = false;
	
	
    public function run()
    {
    	$images=null;
    	$image = ImageUtils::getDefaultImage('properties');
    	$ids =  array();
    	if($this->properties)
    	{
    	foreach($this->properties as $property){
    		$ids[] = $property->id;
    	}
    	$images = PropertyImagesApi::getPrimaryImageForProperties($ids);
    	}
    	
    	
    	
        $this->render('propertySearchResults',array('pages'=>$this->pages,
			          'modelProperty'=>$this->modelProperty,
			      	  'modelCity'=>$this->modelCity,
				      'propertyAmenities'=>$this->propertyAmenities,
				      'properties'=>$this->properties,
				      'images'=>$images,
				      'ids'=>$ids,
				      'image'=>$image,
				      'propertiesCount'=>$this->propertiesCount,
        			  'wishlistRemove'=>$this->wishlistRemove
        			 ));
    }
}

?>