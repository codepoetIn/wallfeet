<?php
class PeopleSearchCriteria extends CWidget
{
	public $modelProperty;
	public $modelUser;
	public $modelProfile;
	public $modelSpecialistType;
    public function run()
    {
        $this->render('peopleSearchCriteria',array('modelProperty'=>$this->modelProperty,'modelUser'=>$this->modelUser,'modelProfile'=>$this->modelProfile,'modelSpecialistType'=>$this->modelSpecialistType));
    }
}

?>