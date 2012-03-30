<?php
class RequirementResults extends CWidget
{
	public $requirements;
	public $pages=null;
	public $totalRequirements;
    public function run()
    {
    	$requirementIds = array();
    	
    	
    	if($this->requirements){
	    	foreach($this->requirements as $requirement){
	    		$requirementIds[] = $requirement->id;
	    	}
    	}
    	$cityIds = RequirementCitiesApi::getCitiesForRequirements($requirementIds);
    	$cities = GeoCityApi::getCityList();
    	$propertyTypeIds=RequirementPropertyTypesApi::getPropertiesForRequirements($requirementIds);
    	$properties=PropertyTypesApi::propertyList();
    	$amenityids=RequirementAmenitiesApi::getAmenitiesForRequirements($requirementIds);
    	$amenities=AmenitiesApi::amenityList();
    	
    	
    	$this->render('requirementResults',array('pages'=>$this->pages,'requirements'=>$this->requirements,'cityIds'=>$cityIds,'cities'=>$cities,'propertyTypeIds'=>$propertyTypeIds,'properties'=>$properties,'amenityids'=>$amenityids,'amenities'=>$amenities,'totalRequirements'=>$this->totalRequirements));
    }
}

?>