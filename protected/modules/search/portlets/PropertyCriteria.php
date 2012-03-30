<?php
class PropertyCriteria extends CWidget
{
	public $modelProperty;
	public $modelCity;
	public $propertyAmenities;
	public $amenities;
	public $modelState;
	public $modelLocality;
	
    public function run()
    {
    	
    	$localityList = GeoLocalityApi::getAllNameList(true);
        $this->render('propertyCriteria',array('modelProperty'=>$this->modelProperty,
        									   'modelState'=>$this->modelState,
        									   'modelCity'=>$this->modelCity,
        									   'modelLocality'=>$this->modelLocality,
        									   'propertyAmenities'=>$this->propertyAmenities,
        									   'localityList'=>$localityList,
        									   'amenities'=>$this->amenities));
    }
}

?>