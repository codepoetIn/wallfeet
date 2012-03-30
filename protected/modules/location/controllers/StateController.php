<?php

class StateController extends FrontController
{
	public function actions()
	{

	}


	public function actionGetStateList($country='india',$model=''){
		if($country) {
			$country = GeoCountryApi::getCountryByName('india');
			if($country){
				$country_id = $country->id;
				$list = GeoStateApi::getList($country_id);
			}
		}if(!$model){
			$model = new GeoState;
		}
		
		$this->renderPartial('getStateList',array('list'=>$list,'model'=>$model));
	}


	public function actionGetList($page=null){

		if($page=="agent"){
			$modelProfile = new UserAgentProfile;
			$country_id = isset($_POST['UserAgentProfile']['country_id'])? $_POST['UserAgentProfile']['country_id'] : '';
		}
		elseif($page=="builder"){
			$modelProfile = new UserBuilderProfile;
			$country_id = isset($_POST['UserBuilderProfile']['country_id'])? $_POST['UserBuilderProfile']['country_id'] : '';
		}
		elseif($page=="specialist"){
			$modelProfile = new UserSpecialistProfile;
			$country_id = isset($_POST['UserSpecialistProfile']['country_id'])? $_POST['UserSpecialistProfile']['country_id'] : '';
		}
		else{
			$modelProfile = new UserProfiles;
			$country_id = isset($_POST['UserProfiles']['country_id']) ? $_POST['UserProfiles']['country_id']  : '';
		}
		$list = null;

		if($country_id!=""){
			$list = GeoStateApi::getList($country_id);
		}

		if($page=='register')
		$this->renderPartial('getListRegister',array('list'=>$list,'modelProfile'=>$modelProfile,'page'=>$page));
		elseif($page=="agent"||$page=="builder"||$page=="specialist")
		$this->renderPartial('getListProfile',array('list'=>$list,'modelProfile'=>$modelProfile,'page'=>$page));
		else
		$this->renderPartial('getList',array('list'=>$list,'modelProfile'=>$modelProfile,'page'=>$page));
	}

}