<?php
class RequirementView extends CWidget
{
	
	public $requirement;
	public $requirementPropertyAmenities;
	public $requirementPropertyType;
	public $requirementCities;
	public $requirementBedrooms;
	
	public function run()
    {
    $this->render('requirementview',array(
   			'requirement'=>$this->requirement,
			'requirementPropertyAmenities'=>$this->requirementPropertyAmenities,
	  		'requirementPropertyType'=>$this->requirementPropertyType,
	  		'requirementCities'=>$this->requirementCities,
    		'requirementBedrooms'=>$this->requirementBedrooms,
	  		
				));
    
    }

}
?>