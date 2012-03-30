<?php
class PropertyResults extends CWidget
{
	public $modelProperty;
	public $modelCity;
	public $propertyAmenities;
	public $properties;
	public $pages;
	public $propertiesCount;

	
    public function run()
    {
    	$images=null;
    	$image = ImageUtils::getDefaultImage('properties');
    	$ids =  array();
    	if(isset($this->properties))
    	{
    	foreach($this->properties as $property){
    		$ids[] = $property->id;
    	}
    	$images = PropertyImagesApi::getPrimaryImageForProperties($ids);
    	}
    	
    	
    	
        $this->render('propertyResults',array('pages'=>$this->pages,
        									  'modelProperty'=>$this->modelProperty,
        									  'modelCity'=>$this->modelCity,
        									  'propertyAmenities'=>$this->propertyAmenities,
        									  'properties'=>$this->properties,
        									  'images'=>$images,
        									  'ids'=>$ids,
        									  'image'=>$image,
        									  'propertiesCount'=>$this->propertiesCount,

        									   ));
    }
}

?>