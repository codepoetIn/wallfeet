<?php
class PeopleSearch extends CWidget
{
	public $modelProperty;
	public $modelUser;
	public $modelProfile;
	public $modelSpecialistType;
	public $users;
	public $pagesAgent;
	public $pagesUser;
	public $pagesBuilder;
	public $pagesSpecialists;
    public function run()
    {
        $this->render('peopleSearch',array('modelProperty'=>$this->modelProperty,'modelUser'=>$this->modelUser,'modelProfile'=>$this->modelProfile,'modelSpecialistType'=>$this->modelSpecialistType,'users'=>$this->users,'pagesUser'=>$this->pagesUser,'pagesAgent'=>$this->pagesAgent,'pagesBuilder'=>$this->pagesBuilder,'pagesSpecialists'=>$this->pagesSpecialists));
    }
}

?>