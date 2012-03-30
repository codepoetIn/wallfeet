<?php
class PeopleCriteria extends CWidget
{
	public $modelProperty;
	public $modelUser;
	public $modelProfile;
	public $modelSpecialistType;
	public $modelCity;
	public $modelState;
	public $modelLocality;
	
    public function run()
    {
    	
    	$localityList = GeoLocalityApi::getAllNameList(true);
    	
        $this->render('peopleCriteria',array(
        'modelProperty'=>$this->modelProperty,        
        'modelUser'=>$this->modelUser,
        'modelProfile'=>$this->modelProfile,
        'modelSpecialistType'=>$this->modelSpecialistType,
        'modelCity'=>$this->modelCity,
        'modelState'=>$this->modelState,
        'modelLocality'=>$this->modelLocality,
        'localityList'=>$localityList,
        ));
    }
}

?>