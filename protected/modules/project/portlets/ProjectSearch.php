<?php
class ProjectSearch extends CWidget
{
	public $modelProject;
	public $modelCity;
	public $projectAmenities;
	public $projects;
	public $amenities;
	public $pagesProject;
    public function run()
    {
        $this->render('projectSearch',array('modelProject'=>$this->modelProject,'modelCity'=>$this->modelCity,'projectAmenities'=>$this->projectAmenities,'projects'=>$this->projects,'amenities'=>$this->amenities,'pagesProject'=>$this->pagesProject));
    }
}

?>