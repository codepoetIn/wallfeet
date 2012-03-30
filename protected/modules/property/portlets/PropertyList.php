<?php
class PropertyList extends CWidget
{
	public $properties;
    public function run()
    {
    	$image = ImageUtils::getDefaultImage('properties');
    	$ids =  array();
    	foreach($this->properties as $property){
    		$ids[] = $property->id;
    	}
    	
    	$images = PropertyImagesApi::getPrimaryImageForProperties($ids);
        $this->render('propertylist',array('properties'=>$this->properties,'images'=>$images,'ids'=>$ids,'image'=>$image));
    }
}

?>