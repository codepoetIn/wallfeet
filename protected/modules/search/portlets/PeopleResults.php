<?php
class PeopleResults extends CWidget
{
	public $modelProperty;
	public $modelUser;
	public $modelProfile;
	public $modelSpecialistType;
	public $users;
	public $pages=null;
	public $totalResults;
	public $userType;
	
    public function run()
    {
    	$image = ImageUtils::getDefaultImage('profiles');
    	$ids =  array();
    	foreach($this->users as $user){
    		$ids[] = $user->id;
    	}
    	$images = UserPhotosApi::getPrimaryImageForUsers($ids);
    
        $this->render('peopleResults',
        array('modelProperty'=>$this->modelProperty,
        	  'modelUser'=>$this->modelUser,
        	  'modelProfile'=>$this->modelProfile,
        	  'users'=>$this->users,
        	  'images'=>$images,
        	  'ids'=>$ids,
        	  'image'=>$image,
        	  'totalResults'=>$this->totalResults,
        	  'pages'=>$this->pages,
        	  'userType'=>$this->userType,
        ));

    }
}

?>