<?php

class SpecialistController extends FrontController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCreate()
	{
		Yii::beginProfile('specialist_create');

		$userId = Yii::app()->user->id;
		$model=SpecialistProfileApi::getSpecialistDetails($userId);
		if($model)
		$this->redirect('/specialist/'.$userId);
		$model = new UserSpecialistProfile;
		$modelState = new GeoState;
		$modelCity = new UserSpecialistLocations;
		$model_data=UserApi::getUser($userId);
		$specialistType = new UserSpecialistType;
		$specialists="";

		$this->performAjaxValidation($model);

		if(isset($_POST['ajax']) && $_POST['ajax']==='specialist-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['UserSpecialistProfile'];
			$specialists=isset($_POST['specialist_type_id'])? $_POST['specialist_type_id'] : null;
			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			if($specialists==null){
				$specialistType->addError('specialist_type_id','Specialist Type cannot be blank.');
				$valid = false;
			}
			if(!isset($_POST['city_id'])){
				$modelCity->addError('city_id','City cannot be blank.');
				$valid = false;
			}
				
			if($valid){
				$data =  $_POST['UserSpecialistProfile'];
				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath){
					$image = SpecialistApi::addImage($userId,$imagePath);
					if($image){
						$data['image'] = $image;
						$specialist = SpecialistProfileApi::createSpecialistProfile($userId,$data);
						$specialists = SpecialistTypeApi::createSpecialistTypes($userId,$_POST['specialist_type_id']);
						$locations=UserSpecialistLocationsApi::createLocations($specialist->id,$_POST['city_id']);
						ImageUtils::deleteImage($imagePath);
						if($specialist){
							$data = array();
							$user = UserApi::getUserById(Yii::app()->user->id);
							$user ? $data["user"] = $user->id : null;
							$data["specialist"] = $specialist->id;
							EmailApi::sendEmail($user->email_id,"ACTIVITY.SPECIALIST.CREATE",$data);
							Yii::app()->user->setFlash('success','You are Successfully created Specialist Profile.');
							$this->redirect('/specialist/'.$userId);
						}
					}
				}
			}
		}
		$model->mobile=$model_data['mobile'];
		$model->telephone=$model_data['telephone'];
		$model->email=$model_data['email_id'];
		$this->render('create',array('model'=>$model,
		'modelState'=>$modelState,
		'modelCity'=>$modelCity,
		'specialistType'=>$specialistType,
		'specialists'=>$specialists
		));

		Yii::endProfile('specialist_create');
	}

	public function actionUpdate()
	{
		Yii::beginProfile('specialist_update');
		$userId = Yii::app()->user->id;
		$modelCity = new UserSpecialistLocations;
		$model=SpecialistProfileApi::getSpecialistDetails($userId);
		if(!$model)
		throw new CHttpException(404,'The requested page does not exist.');
		$image=$model->image;
		$specialistType = new UserSpecialistType;
		$specialistTypes=SpecialistTypeApi::getSpecialistTypeByUserId($userId);
		$specialists="";
		if($specialistTypes)
		{
			foreach($specialistTypes as $types){
				$specialists[]=$types->id;
			}
		}
		$locationCityIds=UserSpecialistLocationsApi::getLocations($model->id);
		$this->performAjaxValidation($model);

		if(isset($_POST['ajax']) && $_POST['ajax']==='specialist-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['UserSpecialistProfile'];
			$specialists=isset($_POST['specialist_type_id'])? $_POST['specialist_type_id'] : null;
			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			if($specialists==null){
				$specialistType->addError('specialist_type_id','Specialist Type cannot be blank.');
				$valid = false;
			}
			$specialist="";
			if($valid){
				$data =  $_POST['UserSpecialistProfile'];
				$data['image'] = $image;
				$imagePath = ImageUtils::uploadImage($model,'image');
				if($imagePath){
					$image = SpecialistApi::addImage($userId,$imagePath);
					if($image){
						$data['image'] = $image;
						ImageUtils::deleteImage($imagePath);
					}
				}
				$specialist = SpecialistProfileApi::updateProfileByUserId($userId,$data);
				SpecialistTypeApi::delete($userId);
				$specialists = SpecialistTypeApi::createSpecialistTypes($userId,$_POST['specialist_type_id']);
				UserSpecialistLocationsApi::deleteLocations($specialist->id);
				$locations=UserSpecialistLocationsApi::createLocations($specialist->id,$_POST['city_id']);
			}
			if($specialist){
				$data = array();
				$user = UserApi::getUserById(Yii::app()->user->id);
				$user ? $data["user"] = $user->id : null;
				$data["specialist"] = $specialist->id;
				EmailApi::sendEmail($user->email_id,"ACTIVITY.SPECIALIST.CREATE",$data);
				Yii::app()->user->setFlash('success','You are Successfully updated Specialist Profile.');
				$this->redirect('/specialist/'.$userId);
			}
		}
		$this->render('update',array('model'=>$model,
		'specialistType'=>$specialistType,
		'specialists'=>$specialists,
		'locationCityIds'=>$locationCityIds,
		'modelCity'=>$modelCity));

		Yii::endProfile('specialist_update');
	}


	public function actionView($userId){
		Yii::beginProfile('specialist_view');
		$session = Yii::app()->session;
		$specialist = SpecialistProfileApi::getSpecialistDetails($userId);
		if(!$specialist)
		throw new CHttpException(404,'The requested page does not exist.');
		$specialistInfo=UserApi::getUserProfileDetails($specialist->user_id);
		$specialistAddress=DbUtils::getAddress($specialist->city_id);
		$specialistTypes=SpecialistTypeApi::getSpecialistTypeByUserId($specialist->user_id);
		$specialistProjects=SpecialistApi::getSpecialistProjectsByUserId($specialist->user_id);


		$specialistRatingReadOnly=SpecialistRatingApi::isRated($specialist->id,Yii::app()->user->id);
		$specialistRating=SpecialistRatingApi::getRating($specialist->user_id);
		$specialistLocations=UserSpecialistLocationsApi::getLocations($specialist->id);
		$specialistPropertyLocations="";
		if($specialistLocations){
			foreach ($specialistLocations as $specialistLocation){
				$specialistPropertyLocations[]=DbUtils::getAddress($specialistLocation->city_id);
			}
		}

		if(!$specialistRatingReadOnly) {
			if($specialist->user_id == Yii::app()->user->id){
				$specialistRatingReadOnly=true;
			} else {
				$specialistRatingReadOnly=false;
			}
		} else {
			$specialistRatingReadOnly=true;
		}


		$this->render('view',array('specialist'=>$specialist,
		'specialistInfo'=>$specialistInfo,
		'specialistAddress'=>$specialistAddress,
		'specialistTypes'=>$specialistTypes,
		'specialistProjects'=>$specialistProjects,
		'specialistRatingReadOnly'=>$specialistRatingReadOnly,
		'specialistRating'=>$specialistRating,
		'specialistPropertyLocations'=>$specialistPropertyLocations));

		Yii::endProfile('specialist_view');
	}

	public function actionStarRatingAjax($userId,$specialistId) {

		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		SpecialistRatingApi::addRating($userId,$specialistId,$ratingAjax);

		$data = array();
		$userId = SpecialistProfileApi::getSpecialistProfileById($specialistId)->user_id;
		$user = UserApi::getUserById($userId);
		$user ? $data["user"] = $user->id : null;
		$data["specialist"] = $specialistId;

		EmailApi::sendEmail($user->email_id,"ACTIVITY.SPECIALIST.RATING",$data);
		echo 'Your Rating is '.$ratingAjax;

	}

	public function actionDelete(){
		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		if(SpecialistProfileApi::deleteProfileByUserId(Yii::app()->user->id)){
			Yii::app()->user->setFlash('success','Your specialist profile was removed successfully');
		}else {
			Yii::app()->user->setFlash('error','Your specialist profile could not be removed. Please contact the admin.');
		}
		$this->redirect('/dashboard');
		
	}


	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='specialist-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}