<?php

class CityController extends FrontController
{

	public function actionDemo()
	{
	 //	echo 'dfdsf';
	}

	public function actionGetCityList($state='',$model='', $display='table',$class=null){
		if(!$model){
			$model = new GeoCity;
		}
		if(!$class)
		$class='select_box';
		$stateId = '';

		if(isset($_POST['GeoState']['state'])){
			$stateId = $_POST['GeoState']['state'];
		} elseif($state){
			$state = GeoStateApi::getState($state);
			if($state)
			$stateId = $state->id;
		}

		if($stateId){
			$list = GeoCityApi::getList($stateId);
		}
		else{
			$list = GeoCityApi::getCityList($stateId);
		}
		//	$list = null;

		$this->renderPartial('getCityList',array('list'=>$list,'model'=>$model,'display'=>$display,'class'=>$class));
	}

	public function actionGetList($page=null){


		if($page=="agent"){
			$modelProfile = new UserAgentProfile;
			$state_id = isset($_POST['UserAgentProfile']['state_id'])? $_POST['UserAgentProfile']['state_id'] : '';
		}
		elseif($page=="builder"){
			$modelProfile = new UserBuilderProfile;
			$state_id = isset($_POST['UserBuilderProfile']['state_id'])? $_POST['UserBuilderProfile']['state_id'] : '';
		}
		elseif($page=="specialist"){
			$modelProfile = new UserSpecialistProfile;
			$state_id = isset($_POST['UserSpecialistProfile']['state_id'])? $_POST['UserSpecialistProfile']['state_id'] : '';
		}
		elseif($page=='project')
		{
			$modelProfile=new Projects;
			$state_id = $_POST['Projects']['state_id'];
		}
		elseif($page=='property')
		{
			$modelProfile=new Property;
			$state_id = $_POST['Property']['state_id'];
			if(isset($_POST['Property']['state_id'])){
				$state_id=$_POST['Property']['state_id'];
			}
		}
		elseif($page=='property'){
			$modelProfile=new Property;
			$state_id = $_POST['Property']['state_id'];
		}
		else{
			$modelProfile = new UserProfiles;
			$state_id='';
			if(isset($_POST['UserProfiles']['state_id'])){
				$state_id = $_POST['UserProfiles']['state_id'];
			}
				
		}
		$list = null;
		if($state_id!="")
		$list = GeoCityApi::getList($state_id);
		if($page=='register'||$page=='project'||$page=='property'){
			$this->renderPartial('getList',array('list'=>$list,'modelProfile'=>$modelProfile,'page'=>$page));
		}

		else
		{	if($page=="agent"||$page=="builder"||$page=="specialist")
		$this->renderPartial('getListProfile',array('list'=>$list,'modelProfile'=>$modelProfile,'page'=>$page));
		else
		$this->renderPartial('getList',array('list'=>$list,'modelProfile'=>$modelProfile,'page'=>$page));
		}
	}

	public function actionGetMultiList(){		
			$state_id = $_POST['GeoState']['state'];			
			$model = new RequirementCities;
			$list = array();
			if($state_id){
				$list = CHtml::listData(GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$state_id)),'id','city');
				$this->renderPartial('getMultiList',array('list'=>$list,'requirementCities'=>$model));
			}
	}

}