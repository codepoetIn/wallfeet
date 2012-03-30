<?php
class ProjectCriteria extends CWidget
{
	public $modelProject;
	public $modelCity;
	public $modelState;
	public $projectAmenities;
	public $amenities;
    public function run()
    {
    	
        $this->render('projectCriteria',array('modelProject'=>$this->modelProject,
										      'modelCity'=>$this->modelCity,
										      'projectAmenities'=>$this->projectAmenities,
										      'amenities'=>$this->amenities,
        			      					  'modelState'=>$this->modelState
        
        					));
    }
}

?>