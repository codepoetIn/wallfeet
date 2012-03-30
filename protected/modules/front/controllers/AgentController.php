<?php

class AgentController extends FrontController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCreate()
	{
		Yii::beginProfile('agent_create');
		$userId = Yii::app()->user->id;
		$model=AgentProfileApi::getAgentDetails($userId);
		if($model)
		$this->redirect('/agent/'.$userId);
		$model = new UserAgentProfile;
		$model_data=UserApi::getUser($userId);
		$propertyType=new UserAgentPropertyType;
		$propertytypes='';
		$modelState=new GeoState;
		$locationCity=new UserAgentLocations;
		$locations='';

		$this->performAjaxValidation($model);

		if(isset($_POST['ajax']) && $_POST['ajax']=='agent-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['UserAgentProfile'];
			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			if(!isset($_POST['property_type_id'])){
				$propertyType->addError('UserAgentPropertyType','Property Type cannot be blank.');
				$valid = false;
			}
			//var_dump($_POST['city_id']);die();
			if(!isset($_POST['city_id'])){
				$locationCity->addError('city_id','City cannot be blank.');
				$valid = false;
			}
				

			if($valid){
				$data =  $_POST['UserAgentProfile'];

				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath){
					$image = AgentProfileApi::addImage($userId,$imagePath);
					if($image){
						$data['image'] = $image;
						$agent = AgentProfileApi::createAgentProfile($userId,$data);
						$propertytypes=UserAgentPropertyTypeApi::createPropertyTypes($agent->id,$_POST['property_type_id']);
						$locations=UserAgentLocationsApi::createLocations($agent->id,$_POST['city_id']);
						ImageUtils::deleteImage($imagePath);
						if($agent){
							$data = array();
							$user = UserApi::getUserById(Yii::app()->user->id);
							$user ? $data["user"] = $user->id : null;
							$data["agent"] = $agent->id;
							EmailApi::sendEmail($user->email_id,"ACTIVITY.AGENT.CREATE",$data);
							Yii::app()->user->setFlash('success','You are Successfully created Agent Profile.');
							$this->redirect('/agent/'.$userId);
						}
					}
				}
				else{
					$model->addError('image','Image cannot be blank');
				}
			}
		}
		$model->mobile=$model_data['mobile'];
		$model->telephone=$model_data['telephone'];
		$model->email=$model_data['email_id'];
		$this->render('create',array('model'=>$model,'propertyType'=>$propertyType,'propertytypes'=>$propertytypes,'modelState'=>$modelState,'locationCity'=>$locationCity,'locations'=>$locations));
		Yii::endProfile('agent_create');
	}

	public function actionaddMoreCity()
	{
		$cityid='';
		$cityList = CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state');
		echo '<ul ><li><span>&nbsp</span>'.CHtml::dropdownList('city_id[]',$cityid,$cityList,array('empty'=>'Select','class'=>'slctbox med')).'</li></ul><div id="city_content_more"></div>';

	}
	public function actionUpdate(){
		Yii::beginProfile('agent_update');
		$userId = Yii::app()->user->id;
		$model=AgentProfileApi::getAgentDetails($userId);
		if(!$model)
		throw new CHttpException(404,'The requested page does not exist.');		
		$image=$model->image;
		$propertyType=new UserAgentPropertyType;
		$propertytypes='';
		$modelState=new GeoState;
		$locationCity=new UserAgentLocations;
		$locations='';
		$propertyTypeIds=UserAgentPropertyTypeApi::getPropertyTypes($model->id);
		if($propertyTypeIds)
		{
			foreach($propertyTypeIds as $types){
				$propertytypes[]=$types->property_type_id;
			}
		}
		$locationCityIds=UserAgentLocationsApi::getLocations($model->id);

		$this->performAjaxValidation($model);

		if(isset($_POST['ajax']) && $_POST['ajax']=='agent-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['UserAgentProfile'];
			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			$agent="";
			if(!isset($_POST['property_type_id'])){
				$propertyType->addError('property_type_id','Property Type cannot be blank.');
				$valid = false;
			}
			if($valid){
				$data =  $_POST['UserAgentProfile'];
				$data['image'] = $image;
				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath){
					$image = AgentProfileApi::addImage($userId,$imagePath);
					if($image){
						$data['image'] = $image;
						ImageUtils::deleteImage($imagePath);
					}
				}
				$agent = AgentProfileApi::updateAgentProfile($userId,$data);
				UserAgentPropertyTypeApi::deletePropertyTypes($agent->id);
				$propertytypes=UserAgentPropertyTypeApi::createPropertyTypes($agent->id,$_POST['property_type_id']);
				UserAgentLocationsApi::deleteLocations($agent->id);
				$locations=UserAgentLocationsApi::createLocations($agent->id,$_POST['city_id']);
			}
			if($agent){
				$data = array();
				$user = UserApi::getUserById(Yii::app()->user->id);
				$user ? $data["user"] = $user->id : null;
				$data["agent"] = $agent->id;
				EmailApi::sendEmail($user->email_id,"ACTIVITY.AGENT.CREATE",$data);
				Yii::app()->user->setFlash('success','You are Successfully updated Agent Profile.');
				$this->redirect('/agent/'.$userId);
			}
		}
		$this->render('update',array('model'=>$model,'propertyType'=>$propertyType,
		'propertytypes'=>$propertytypes,
		'modelState'=>$modelState,
		'locationCity'=>$locationCity,
		'locations'=>$locations,
		'locationCityIds'=>$locationCityIds,
		));
		Yii::endProfile('agent_update');
	}
	public function actionView($userId){
		Yii::beginProfile('agent_view');
		$agentRatingReadOnly=false;
		$session = Yii::app()->session;
		$agent = AgentProfileApi::getAgentDetails($userId);
		if(!$agent)
		throw new CHttpException(404,'The requested page does not exist.');
		$agentInfo=UserApi::getUserProfileDetails($agent->user_id);
		$agentAddress=DbUtils::getAddress($agent->city_id);
		$agentPropertyTypeIds=PropertyApi::getPropertyTypesByUserId($agent->user_id);
		$agentPropertyTypes="";
		if($agentPropertyTypeIds){
			foreach($agentPropertyTypeIds as $agentPropertyTypeId){
				$agentPropertyTypes[$agentPropertyTypeId->property_type_id]=PropertyTypesApi::getPropertyTypeById($agentPropertyTypeId->property_type_id);
			}
		}
		$agentProperties=PropertyApi::getPropertiesOfUser($agent->user_id,Yii::app()->params['dashboardResultsPerPage']);
		$agentLocations=UserAgentLocationsApi::getLocations($agent->id);
		$agentPropertyLocations="";
		if($agentLocations){
			foreach ($agentLocations as $agentLocation){
				$agentPropertyLocations[]=DbUtils::getAddress($agentLocation->city_id);
			}
		}

		$agentRatingReadOnly=AgentRatingApi::isRated($agent->id,Yii::app()->user->id);
		$agentRating=AgentRatingApi::getRating($agent->id);

		if(!$agentRatingReadOnly) {
			if($agent->user_id == Yii::app()->user->id){
				$agentRatingReadOnly=true;

			} else {
				$agentRatingReadOnly=false;
			}
		} else {
			$agentRatingReadOnly=true;
		}

		 
		$this->render('view',array('agent'=>$agent,'agentInfo'=>$agentInfo,'agentAddress'=>$agentAddress,'agentPropertyTypes'=>$agentPropertyTypes,'agentPropertyLocations'=>$agentPropertyLocations,'agentProperties'=>$agentProperties,'agentRatingReadOnly'=>$agentRatingReadOnly,'agentRating'=>$agentRating));

		Yii::endProfile('agent_view');
	}

	public function actionStarRatingAjax($userId,$agentId) {

		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		AgentRatingApi::addRating($agentId,$userId,$ratingAjax);

		$data = array();
		$userId = AgentProfileApi::getAgentProfileById($agentId)->user_id;
		$user = UserApi::getUserById($userId);
		$user ? $data["user"] = $user->id : null;
		$data["agent"] = $agentId;
		EmailApi::sendEmail($user->email_id,"ACTIVITY.AGENT.RATING",$data);
		echo 'Your Rating is '.$ratingAjax;

	}

	public function actionDelete(){
		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		if(AgentProfileApi::deleteAgentProfile(Yii::app()->user->id)){
			Yii::app()->user->setFlash('success','Your agent profile was removed successfully');
		}else {
			Yii::app()->user->setFlash('error','Your agent profile could not be removed. Please contact the admin.');
		}
		$this->redirect('/dashboard');

	}


	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']=='agent-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}