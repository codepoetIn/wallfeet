<?php

class BuilderController extends FrontController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCreate()
	{
		Yii::beginProfile('builder_create');
		$userId = Yii::app()->user->id;
		$model=BuilderProfileApi::getBuilderDetails($userId);
		if($model)
		$this->redirect('/builder/'.$userId);
		$model = new UserBuilderProfile;
		$model_data=UserApi::getUser($userId);
		$projectType=new UserBuilderProjectType;
		$projecttypes='';
		$modelState=new GeoState;
		$locationCity=new UserBuilderLocations;
		$locations='';

		$this->performAjaxValidation($model);

		if(isset($_POST['ajax']) && $_POST['ajax']==='builder-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['UserBuilderProfile'];
			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			if(!isset($_POST['project_type_id'])){
				$projectType->addError('UserBuilderProjectType','Project Type cannot be blank.');
				$valid = false;
			}
			if(!isset($_POST['city_id'])){
				$locationCity->addError('city_id','City cannot be blank.');
				$valid = false;
			}
			if($valid){
				$data =  $_POST['UserBuilderProfile'];
				$data['image'] = $model->image;
				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath){
					$image = BuilderProfileApi::addImage($userId,$imagePath);
					if($image){
						$data['image'] = $image;
						$builder = BuilderProfileApi::createBuilderProfile($userId,$data);
						$projecttypes=UserBuilderProjectTypeApi::createProjectTypes($builder->id,$_POST['project_type_id']);
						$locations=UserBuilderLocationsApi::createLocations($builder->id,$_POST['city_id']);
						ImageUtils::deleteImage($imagePath);
						if($builder){
							$data = array();
							$user = UserApi::getUserById(Yii::app()->user->id);
							$user ? $data["user"] = $user->id : null;
							$data["builder"] = $builder->id;
							EmailApi::sendEmail($user->email_id,"ACTIVITY.BUILDER.CREATE",$data);
							Yii::app()->user->setFlash('success','You are Successfully created Builder Profile.');
							$this->redirect('/builder/'.$userId);
						}
					}
				}
			}
		}
		$model->mobile=$model_data['mobile'];
		$model->telephone=$model_data['telephone'];
		$model->email=$model_data['email_id'];
		$this->render('create',array('model'=>$model,'projectType'=>$projectType,'projecttypes'=>$projecttypes,'modelState'=>$modelState,'locationCity'=>$locationCity,'locations'=>$locations));
		Yii::endProfile('builder_create');
	}


	public function actionUpdate(){
		Yii::beginProfile('builder_update');
		$userId = Yii::app()->user->id;
		$model=BuilderProfileApi::getBuilderDetails($userId);
		if(!$model)
		throw new CHttpException(404,'The requested page does not exist.');
		$image=$model->image;
		$projectType=new UserBuilderProjectType;
		$projecttypes='';
		$modelState=new GeoState;
		$locationCity=new UserBuilderLocations;
		$locations='';
		$projectTypeIds=UserBuilderProjectTypeApi::getProjectTypes($model->id);
		if($projectTypeIds)
		{
			foreach($projectTypeIds as $types){
				$projecttypes[]=$types->project_type_id;
			}
		}
		$locationCityIds=UserBuilderLocationsApi::getLocations($model->id);
		if($locationCityIds)
		{
			foreach($locationCityIds as $cities){
				$locations[]=$cities->city_id;
			}
		}
		$this->performAjaxValidation($model);

		if(isset($_POST['ajax']) && $_POST['ajax']==='builder-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['UserBuilderProfile'];
			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			$builder="";
			if(!isset($_POST['project_type_id'])){
				$projectType->addError('UserBuilderProjectType','Project Type cannot be blank.');
				$valid = false;
			}
			if(!isset($_POST['city_id'])){
				$locationCity->addError('city_id','City cannot be blank.');
				$valid = false;
			}
			if($valid){
				$data =  $_POST['UserBuilderProfile'];
				$data['image'] = $image;
				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath){
					$image = BuilderProfileApi::addImage($userId,$imagePath);
					if($image){
						$data['image'] = $image;
						ImageUtils::deleteImage($imagePath);
					}
				}
				$builder = BuilderProfileApi::updateBuilderProfile($userId,$data);
				UserBuilderProjectTypeApi::deleteProjectTypes($builder->id);
				$projecttypes=UserBuilderProjectTypeApi::createProjectTypes($builder->id,$_POST['project_type_id']);
				UserBuilderLocationsApi::deleteLocations($builder->id);
				$locations=UserBuilderLocationsApi::createLocations($builder->id,$_POST['city_id']);
			}
			if($builder){
				$data = array();
				$user = UserApi::getUserById(Yii::app()->user->id);
				$user ? $data["user"] = $user->id : null;
				$data["builder"] = $builder->id;
				EmailApi::sendEmail($user->email_id,"ACTIVITY.BUILDER.CREATE",$data);
				Yii::app()->user->setFlash('success','You are Successfully updated Builder Profile.');
				$this->redirect('/builder/'.$userId);
			}
		}
		$this->render('update',array('model'=>$model,
		'projectType'=>$projectType,
		'projecttypes'=>$projecttypes,
		'modelState'=>$modelState,
		'locationCity'=>$locationCity,
		'locations'=>$locations,
		'locationCityIds'=>$locationCityIds));
		Yii::endProfile('builder_update');
	}

	public function actionView($userId){
		Yii::beginProfile('builder_view');
		$builderRatingReadOnly=false;
		$session = Yii::app()->session;
		$builder = BuilderProfileApi::getBuilderDetails($userId);
		if(!$builder)
		throw new CHttpException(404,'The requested page does not exist.');
		$builderInfo=UserApi::getUserProfileDetails($builder->user_id);
		$builderAddress=DbUtils::getAddress($builder->city_id);
		$builderProjectTypeIds=ProjectApi::getProjectTypesByUserId($builder->user_id);
		$builderProjectTypes="";
		if($builderProjectTypeIds){
			foreach($builderProjectTypeIds as $builderProjectTypeId){
				$builderProjectTypes[$builderProjectTypeId->project_type_id]=ProjectTypesApi::getProjectTypeById($builderProjectTypeId->project_type_id);
			}
		}
		$builderProjects=ProjectApi::getProjectsOfUser($builder->user_id,Yii::app()->params['dashboardResultsPerPage']);
		$builderLocations=UserBuilderLocationsApi::getLocations($builder->id);
		$builderProjectLocations="";
		if($builderLocations){
			foreach ($builderLocations as $builderLocation){
				$builderProjectLocations[]=DbUtils::getAddress($builderLocation->city_id);
			}
		}

		$builderRatingReadOnly=BuilderRatingApi::isRated($builder->id,Yii::app()->user->id);
		$builderRating=BuilderRatingApi::getRating($builder->id);

		if(!$builderRatingReadOnly) {
			if($builder->user_id == Yii::app()->user->id){
				$builderRatingReadOnly=true;

			} else {
				$builderRatingReadOnly=false;
			}
		} else {
			$builderRatingReadOnly=true;
		}

		$this->render('view',array('builder'=>$builder,'builderInfo'=>$builderInfo,'builderAddress'=>$builderAddress,'builderProjectTypes'=>$builderProjectTypes,'builderProjectLocations'=>$builderProjectLocations,'builderProjects'=>$builderProjects,'builderRatingReadOnly'=>$builderRatingReadOnly,'builderRating'=>$builderRating));

		Yii::endProfile('builder_view');
	}

	public function actionStarRatingAjax($userId,$builderId) {

		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		BuilderRatingApi::addRating($builderId,$userId,$ratingAjax);

		$data = array();
		$userId = BuilderProfileApi::getBuilderProfileById($builderId)->user_id;
		$user = UserApi::getUserById($userId);
		$user ? $data["user"] = $user->id : null;
		$data["builder"] = $builderId;

		EmailApi::sendEmail($user->email_id,"ACTIVITY.BUILDER.RATING",$data);
		echo 'Your Rating is '.$ratingAjax;

	}

	public function actionDelete(){
		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		if(BuilderProfileApi::deleteBuilderProfile(Yii::app()->user->id)){
			Yii::app()->user->setFlash('success','Your builder profile was removed successfully');
		}else {
			Yii::app()->user->setFlash('error','Your builder profile could not be removed. Please contact the admin.');
		}
		$this->redirect('/dashboard');

	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='builder-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}