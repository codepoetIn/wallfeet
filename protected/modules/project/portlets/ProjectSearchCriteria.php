<?php
class ProjectSearchCriteria extends CWidget
{
	public $modelProject;
	public $modelCity;
	public $projectAmenities;
	public $amenities;
    public function run()
    {
        $this->render('projectSearchCriteria',array('modelProject'=>$this->modelProject,'modelCity'=>$this->modelCity,'projectAmenities'=>$this->projectAmenities,'amenities'=>$this->amenities));
    }
}

?>