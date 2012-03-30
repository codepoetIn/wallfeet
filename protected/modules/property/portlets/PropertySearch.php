<?php
class PropertySearch extends CWidget
{
	public $modelProperty;
	public $modelCity;
	public $propertyAmenities;
	public $properties;
	public $amenities;
	public $pages;
	public $propertiesCount;
	public $modelState;
	
    public function run()
    {
        $this->render('propertySearch',array('pages'=>$this->pages,'modelProperty'=>$this->modelProperty,'modelCity'=>$this->modelCity,'propertyAmenities'=>$this->propertyAmenities,'properties'=>$this->properties,'amenities'=>$this->amenities,'propertiesCount'=>$this->propertiesCount,'modelState'=>$this->modelState));
    }
}

?>