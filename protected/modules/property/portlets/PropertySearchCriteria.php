<?php
class PropertySearchCriteria extends CWidget
{
	public $modelProperty;
	public $modelCity;
	public $propertyAmenities;
	public $amenities;
	public $modelState;
	
    public function run()
    {
        $this->render('propertySearchCriteria',array('modelProperty'=>$this->modelProperty,'modelState'=>$this->modelState,'modelCity'=>$this->modelCity,'propertyAmenities'=>$this->propertyAmenities,'amenities'=>$this->amenities));
    }
}

?>