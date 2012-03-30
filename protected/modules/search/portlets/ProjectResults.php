<?php
class ProjectResults extends CWidget
{
	public $modelProject;
	public $modelCity;
	public $projectAmenities;
	public $projects;
	public $pages;
	public $projectsCount;
	 
    public function run()
    {
    	$image = ImageUtils::getDefaultImage('projects');
    	$ids =  array();
    	if($this->projects){
	    	foreach($this->projects as $project){
	    		$ids[] = $project->id;
	    	}
    	}
    	$images = ProjectImagesApi::getPrimaryImageForProjects($ids);
    	
        $this->render('projectResults',array('modelProject'=>$this->modelProject,
        									 'modelCity'=>$this->modelCity,
        									 'projectAmenities'=>$this->projectAmenities,
        									 'projects'=>$this->projects,
        									 'images'=>$images,
        									 'ids'=>$ids,
        									 'image'=>$image,
        									 'pages'=>$this->pages,
        									 'projectsCount'=>$this->projectsCount
        									 ));
    }
}

?>