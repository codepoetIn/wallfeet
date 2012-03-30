<?php
class PeopleSearchResults extends CWidget
{
	public $modelProperty;
	public $modelUser;
	public $modelProfile;
	public $modelSpecialistType;
	public $users;
	public $pagesAgent=null;
	public $pagesUser=null;
	public $pagesBuilder=null;
	public $pagesSpecialists=null;
    public function run()
    {
    	$image = ImageUtils::getDefaultImage('profiles');
    	$ids =  array();
    	foreach($this->users as $user){
    		$ids[] = $user->id;
    	}
    	$images = UserPhotosApi::getPrimaryImageForUsers($ids);
    	
        $this->render('peopleSearchResults',array('modelProperty'=>$this->modelProperty,'modelUser'=>$this->modelUser,'modelProfile'=>$this->modelProfile,'users'=>$this->users,'images'=>$images,'ids'=>$ids,'image'=>$image,'pagesAgent'=>$this->pagesAgent,'pagesUser'=>$this->pagesUser,'pagesBuilder'=>$this->pagesBuilder,'pagesSpecialists'=>$this->pagesSpecialists));
    }
}

?>