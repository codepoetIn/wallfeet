<?php

class RequirementController extends FrontController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}

	public function actionIndex(){
		Yii::beginProfile('requirements');

		$criteria = RequirementApi::getCriteriaObjectForUser(Yii::app()->user->id);
		$totalRequirements = Requirement::model()->count($criteria);
		$pages = new CPagination($totalRequirements);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];;
		$pages->applyLimit($criteria);
		$requirements=RequirementApi::searchMyRequirementWithCriteria($criteria);

		//$requirements=RequirementApi::getRequirementByUserId(Yii::app()->user->id);
		$this->render('index',array('requirements'=>$requirements,'pages'=>$pages,'totalRequirements'=>$totalRequirements));
		Yii::endProfile('requirements');
	}

	public function actionView($id){
		Yii::beginProfile ( 'requirements_view' );
		//$requirements=RequirementApi::getRequirementByUserId(Yii::app()->user->id);
		//$this->render('view',array('requirements'=>$requirements));
		$session = Yii::app ()->session;
		$requirement = RequirementApi::getRequirementById ( $id );
		if (! $requirement) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}

		$userDetails = UserApi::getUserProfileDetails ( $requirement->user_id );

		$propertyIds = RequirementPropertyTypesApi::getPropertyTypesByRequirementId ( $id );

		$properties = "";
		$propertyNames = "";
		if ($propertyIds) {
			foreach ( $propertyIds as $propertyId ) {
				$properties [] = $propertyId->property_type_id;
			}
			$propertyNames = DbUtils::getDbValues ( new PropertyTypes (), 'id', $properties, 'property_type' );
		}

		$amenityIds = RequirementAmenitiesApi::getAmenitiesByRequirementId ( $id );

		$amenities = "";
		$amenityNames = "";
		if ($amenityIds) {
			foreach ( $amenityIds as $amenityId ) {
				$amenities [] = $amenityId->amenity_id;
			}
			$amenityNames = DbUtils::getDbValues ( new CategoryAmenities (), 'id', $amenities, 'amenity' );
		}

		$cityIds = RequirementCitiesApi::getCitiesByRequirementId ( $id );
		$cities = "";
		$cityNames = "";
		if ($cityIds) {
			foreach ( $cityIds as $cityId ) {
				$cities [] = $cityId->city_id;
			}
			$cityNames = DbUtils::getDbValues ( new GeoCity (), 'id', $cities, 'city' );
		}

		$bedroomsRequirement = RequirementBedroomsApi::getBedroomsByRequirementId ( $id );

		$this->render ( 'view', array ('requirement' => $requirement, 'amenityNames' => $amenityNames, 'cityNames' =>

		$cityNames, 'propertyNames' => $propertyNames, 'bedroomsRequirement' => $bedroomsRequirement, 'userDetails' => $userDetails ) );

		Yii::endProfile ( 'requirements_view' );
	}


	public function actionSimilar($id){
		Yii::beginProfile ( 'requirements_view' );
		$session = Yii::app ()->session;
		$requirement = RequirementApi::getRequirementById ( $id );
		if (! $requirement) {
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		}

		$userDetails = UserApi::getUserProfileDetails ( $requirement->user_id );

		$data['i_want_to']=$requirement->i_want_to;
		$data['min_price']=$requirement->min_price;
		$data['max_price']=$requirement->max_price;

		$propertytypes=RequirementPropertyTypesApi::getPropertyTypesByRequirementId($requirement->id);
		$propertytypeids=null;
		if($propertytypes){
			foreach($propertytypes as $propertytype){
				$propertytypeids[]=$propertytype->property_type_id;
			}
		}
		$data['property_type_id'] = $propertytypeids;

		$amenity_ids=RequirementAmenitiesApi::getAmenitiesByRequirementId($requirement->id);
		$amenityids=null;
		if($amenity_ids){
			foreach($amenity_ids as $amenity_id){
				$amenityids[]=$amenity_id->amenity_id;
			}
		}
		$data['PropertyAmenities'] = $amenityids;

		$cityids=RequirementCitiesApi::getCitiesByRequirementId($requirement->id);
		$city=null;
		if($cityids){
			foreach($cityids as $cityid){
				$city[]=$cityid->city_id;
			}
		}
		$data['city_id'] = $city;

		$bedrooms=RequirementBedroomsApi::getBedroomsByRequirementId($requirement->id);
		$beds=null;
		if($bedrooms){
			foreach($bedrooms as $bedroom){
				$beds[]=$bedroom->bedrooms;
			}
		}
		$data['bedrooms'] = $beds;

		$criteria = PropertyApi::getCriteriaObjectForRequirement($data);
		$count = Property::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);
		$properties = PropertyApi::searchMyPropertyWithCriteria($criteria);

		$this->render ( 'similar', array ('requirement' => $requirement, 'userDetails' => $userDetails,'properties'=>$properties,'pages'=>$pages,'propertiesCount'=>$count ) );

		Yii::endProfile ( 'requirements_view' );
	}



	public function actionPost()
	{
		Yii::beginProfile('requirement_post');

		$userId = Yii::app()->user->id;
		$model = new Requirement;
		$modelState = new GeoState;
		$requirementCities = new RequirementCities;
		$requirementAmenities = new RequirementAmenities;
		$requirementPropertyTypes = new RequirementPropertyTypes;
		$requirementBedrooms = new RequirementBedrooms;

		$amenities = null;
		$propertyTypes = null;
		$bedrooms = null;
		$cities = null;
		$this->performAjaxValidation(array($model));

		if(isset($_POST['minsubmit']))
		{
			$modelState->attributes = $_POST['GeoState'];
		}
		elseif(isset($_POST['PostRequirementMin']))
		{
			$model->attributes = $_POST['Requirement'];
			if(isset($_POST['GeoCity']['city'])){
				$cities[0] = $_POST['GeoCity']['city'];
			}
		}
		elseif(isset($_POST['submit'])){
				
			$model->attributes = $_POST['Requirement'];

			$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;

			$propertyTypes = isset($_POST['property_type_id'])? $_POST['property_type_id'] : null;

			$bedrooms = isset($_POST['bedrooms'])? $_POST['bedrooms'] : null;

			$cities = isset($_POST['city_id'])? $_POST['city_id'] : null;

			$valid = true;
			$model->user_id = $userId;
			$valid = $valid && $model->validate();
			if($propertyTypes==null){
				$requirementPropertyTypes->addError('property_type_id','Property Type cannot be blank.');
				$valid = false;
			}
			
			if($cities==null || empty($cities) || $cities[0]==''){
				$requirementCities->addError('city_id','City cannot be blank.');
				$valid = false;
			}


			if($valid){

				$data =  $_POST['Requirement'];
				if($data['covered_area_from']== null)
				$data['covered_area_from']==0;
				if($data['min_price']== null)
				$data['min_price']=0;
				$requirement = RequirementApi::createRequirement($userId,$data);
				if(!$requirement->hasErrors()){
					$addAmenities = true;
					$addCities = true;
					$addBedrooms = true;
					$addPropertyTypes = true;
					if(isset($_POST['amenity_id']))
					$addAmenities = RequirementAmenitiesApi::addAmenitiesForRequirement($requirement->id,$_POST['amenity_id']);
					if(isset($_POST['city_id']))
					$addCities = RequirementCitiesApi::addCitiesForRequirement($requirement->id,$_POST['city_id']);


					if(isset($_POST['bedrooms']) && !empty($_POST['bedrooms'])){
						$addBedrooms = RequirementBedroomsApi::addBedroomForRequirement($requirement->id,$_POST['bedrooms']);
					}
					if(isset($_POST['property_type_id']))
					$addPropertyTypes = RequirementPropertyTypesApi::addPropertyTypesForRequirement($requirement->id,$_POST['property_type_id']);

					if($addAmenities && $addCities && $addBedrooms && $addPropertyTypes){
						//$this->refresh();
						$this->redirect('/requirement/'.$requirement->id);
					}
					else{
						RequirementAmenitiesApi::deleteAllAmenitiesForRequirement($requirement->id);
						RequirementCitiesApi::deleteAllCitiesForRequirement($requirement->id);
						RequirementBedroomsApi::deleteAllBedroomsForRequirement($requirement->id);
						RequirementPropertyTypesApi::deleteAllPropertyTypesForRequirement($requirement->id);
					}

				}
				else{
					if(isset($property->id)){
						PropertyApi::deletePropertyById($property->id);
					}
				}
			}

		}

		$this->render('post',array(
			'model'=>$model,
			'modelState'=>$modelState,
			'requirementCities'=>$requirementCities,
			'requirementAmenities'=>$requirementAmenities,
			'requirementPropertyTypes'=>$requirementPropertyTypes,
			'requirementBedrooms'=>$requirementBedrooms,
			'amenities'=>$amenities,
			'propertyTypes'=>$propertyTypes,
			'bedrooms'=>$bedrooms,
			'cities'=>$cities,

		));

		Yii::endProfile('requirement_post');
	}





	protected function performAjaxValidation($model) {

		if(isset($_POST['ajax']) && $_POST['ajax']=='requirement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

	}

	public function actionDelete($id){

		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		$requirement = RequirementApi::getRequirementById($id);

		if($requirement->user_id!==Yii::app()->user->id)
		throw new CHttpException(403,'You are not authorized.');

		if(RequirementApi::deleteRequirementById($requirement->id)){
			Yii::app()->user->setFlash('success','The requirment was removed successfully');
		}else {
			Yii::app()->user->setFlash('error','The requirment could not be removed. Please contact the admin.');
		}
		$this->redirect('/requirements');

	}


}