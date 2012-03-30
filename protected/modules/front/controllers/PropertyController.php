<?php

class PropertyController extends FrontController
{
	/**
	 * Declares class-based actions.
	 */
	public function init() {
		if(isset($_POST['SESSION_ID'])){
			$session=Yii::app()->getSession();
			$session->close();
			$session->sessionID = $_POST['SESSION_ID'];
			$session->open();
		}

	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionImagesUpload() {

		$imagePaths=null;
		$propertyImages=new PropertyImages;
		$session=new CHttpSession;
		$session->open();
		if(!isset($session['totalImages'])){
			$session['totalImages']=0;
		}
		if($session['totalImages']<Yii::app()->params['uploadImagesLimit']) {
			$imagePath = ImageUtils::uploadImage($propertyImages,'image');
			$session['totalImages'] = $session['totalImages'] + 1;
			if(isset($session['PropertyImages'])){
				$images = $session['PropertyImages'];
			} else {
				$images = array();
			}
			$images[] = $imagePath;
			$session['PropertyImages'] = $images;
			print_r($propertyImages,true);
		}
		else {
			throw new CException(500);
		}
		Yii::app()->end();

	}
	public function actionIndex()
	{
		Yii::beginProfile('properties');

		$totalProperty='0';
		$criteria = PropertyApi::getCriteriaObjectForUser(Yii::app()->user->id);
		$count = Property::model()->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);
		$properties = PropertyApi::searchMyPropertyWithCriteria($criteria);

			
		$this->render('index',array('properties'=>$properties,'pages'=>$pages,'propertiesCount'=>$count));
		Yii::endProfile('properties');
	}

	public function actionPost($projectId=null)
	{
		Yii::beginProfile('property_post');

		$locationPosition = array(20.59368,78.96288);

		// Open session object
		$session=new CHttpSession;
		$session->open();

		/*		$modelProject = "";
		 if($projectId){
			$modelProject = ProjectApi::getProjectById($projectId);
			if($modelProject==null){
			$this->redirect('/search');
			}
			}*/

		$userId = Yii::app()->user->id;
		$model = new Property;
		$model->country = 'india';
		$modelCity = new GeoCity;
		$propertyAmenities = new PropertyAmenities;
		$propertyImages = new PropertyImages;
		$amenities = null;
		$localityNew = false;
		$locality=null;
		
		$localityList = GeoLocalityApi::getAllNameList();

		$this->performAjaxValidation($model);
		//$this->performAjaxValidation($profilesModel);

		if(isset($_POST['ajax']) && $_POST['ajax']==='property-form')
		{
			echo CActiveForm::validate($model);
			//echo CActiveForm::validate($profilesModel);
			Yii::app()->end();
		}

		if(isset($_POST['minsubmit']))
		{
			$model->attributes = $_POST['Property'];
			//$modelCity->attributes=$_POST['GeoCity'];
		}
		elseif(isset($_POST['PostPropertyMin'])){
			$model->attributes = $_POST['Property'];
		}
		elseif(isset($_POST['submit'])){
						
			$model->attributes = $_POST['Property'];
			$amenity_id=array();
			if((isset($_POST['PropertyAmenitiesHouse']))&&(isset($_POST['PropertyAmenitiesExternal']))){				
				$amenity_id=array_merge($_POST['PropertyAmenitiesHouse'],$_POST['PropertyAmenitiesExternal']);
			}
			elseif(isset($_POST['PropertyAmenitiesHouse'])){
				$amenity_id=$_POST['PropertyAmenitiesHouse'];
			}
			elseif(isset($_POST['PropertyAmenitiesExternal'])){
				$amenity_id=$_POST['PropertyAmenitiesExternal'];
			}		
			$model->user_id = $userId;
			$valid = true;
			$data =  $_POST['Property'];

			if(isset($model->city_id)){
				$cityModel = GeoCity::model()->findByPk($model->city_id);
				if($cityModel){
					$model->state_id = $cityModel->state_id;
					$data['state_id'] = $cityModel->state_id;
					if(isset($model->locality)){
						$criteria = new CDbCriteria;
						$criteria->condition = 'city_id=:city_id && locality=:locality';
						$criteria->params = array(':city_id'=>$cityModel->id,':locality'=>$model->locality);
						$localityModel = GeoLocality::model()->find($criteria);
						$locality=$model->locality;
						if($localityModel){
							$model->locality_id = $localityModel->id;
						} else {
							$localityModel = new GeoLocality;
							$localityModel->locality = $model->locality;
							$localityModel->city_id = $model->city_id;
							$localityModel->save();
							$model->locality_id = $localityModel->id;
							$localityNew = $localityModel;
						}

						$data['locality_id'] = $localityModel->id;
					}
				}
			}
			$model->setScenario('custom-validate');
			$valid = $valid && $model->validate();
			if($model->latitude !='' && $model->longitude!='')
			$locationPosition = array($model->latitude,$model->longitude);

			if($valid){
			if(isset($model->video_url))
				{
				$video=explode('&',$model->video_url);
				$videocode=explode('=',$video[0]);
				if(isset($videocode[1]))
				$data['video_url']=$videocode[1];
				}
				
				$data['property_name']=PropertyTypesApi::getPropertyTypeById($data['property_type_id']);
				if($data['jackpot_investment'])
				$data['jackpot_investment']=2;
				if($data['instant_home'])
				$data['instant_home']=2;
				$property = PropertyApi::createProperty($userId,$data);
				if(!$property->hasErrors()){
					if(!empty($amenity_id) && (count($amenity_id))>0)
					$amenities = PropertyAmenitiesApi::addAmenitiesForProperty($property->id,$amenity_id);
					$images = $session['PropertyImages'];
					if(is_array($images)){
						foreach($images as $count=>$image) {
							$valid = $valid && (PropertyImagesApi::addImage($property->id,$image)===true);
						}
					}
					if($valid){
						unset($session['PropertyImages']);
						if($data['instant_home']==2 && $data['jackpot_investment']==2){
							Yii::app()->user->setFlash('success','Congratulations! Your property was successfully posted, waiting for Jackpot Investment and Instant Home Approval.');
						}
						elseif($data['jackpot_investment']==2){
							Yii::app()->user->setFlash('success','Congratulations! Your property was successfully posted, waiting for Jackpot Investment Approval.');
						} elseif($data['instant_home']==2){
							Yii::app()->user->setFlash('success','Congratulations! Your property was successfully posted, waiting for Instant Home Approval.');
						} else {
							Yii::app()->user->setFlash('success','Congratulations! Your property was successfully posted.');
						}
						$this->redirect('/property/'.$property->id);
					}	else{
						if($localityNew && !$localityNew->isNewRecord){
							$localityNew->delete();
						}
						unset($session['PropertyImages']);
						$propertyPostUrl = Yii::app()->createUrl('/property/post');
						Yii::app()->user->setFlash('error','Oops! We faced a problem and hence could not post your property.Please <a href='.$propertyPostUrl.'>retry </a>');
						PropertyAmenitiesApi::deleteAllAmenitiesForProperty($property->id);
						PropertyImagesApi::deleteAllImages($property->id);
						PropertyApi::deletePropertyById($property->id);
					}
				}
			} else {
				if($localityNew && !$localityNew->isNewRecord){
					$localityNew->delete();
				}
				unset($session['PropertyImages']);
				$propertyPostUrl = Yii::app()->createUrl('/property/post');
				//	var_dump($model->getErrors());
				Yii::app()->user->setFlash('error','Oops! We faced a problem and hence could not post your property.Please <a href='.$propertyPostUrl.'>retry </a>');
			}

		}

		$this->render('post',array(
									'model'=>$model,
									'propertyAmenities'=>$propertyAmenities,
									'propertyImages'=>$propertyImages,
									'amenities'=>$amenities,
									'locationPosition'=>$locationPosition,
									'localityList'=>$localityList,
									'locality'=>$locality,
		));

		Yii::endProfile('property_post');
	}

	public function actionUpdate($id,$imageId=''){

		//		var_dump($_GET);die();

		Yii::beginProfile('property_update');

		$model = Property::model()->findByPk($id);
		if(!$model)
		throw new CHttpException(404,'The requested page does not exist.');
		$jackpot=$model->jackpot_investment;
		$instant=$model->instant_home;
		$currentImages = PropertyImagesApi::getAllImages($model->id);
		$localitymodel=GeoLocality::model()->find('id=:id',array(':id'=>$model->locality_id));
		$locality=$localitymodel->locality;
		if($imageId && is_array($currentImages)){
			$imageResult = false;
			if(array_key_exists($imageId,$currentImages)){
				$imageResult = PropertyImagesApi::deleteImageByPk($imageId);
			}
			$this->renderPartial('_imageDeleted',array('result'=>$imageResult));
			Yii::app()->end();
		}

		if($model->user_id != Yii::app()->user->id)
		throw new CHttpException(503,'Unauthorized.');

		// Open session object
		$session=new CHttpSession;
		$session->open();

		$userId = Yii::app()->user->id;
		$model->country = 'india';
		$modelCity = new GeoCity;
		$propertyAmenities = new PropertyAmenities;
		$propertyImages = new PropertyImages;
		$amenities =PropertyAmenitiesApi::getAmenitiesIdForProperty($id);

		$localityNew = false;
		if($model->latitude && $model->longitude)
		$locationPosition = array($model->latitude,$model->longitude);
		else
		$locationPosition = array(20.59368,78.96288);



		$localityList = GeoLocalityApi::getAllNameList();

		$this->performAjaxValidation($model);
		//$this->performAjaxValidation($profilesModel);

		if(isset($_POST['ajax']) && $_POST['ajax']==='property-form')
		{
			echo CActiveForm::validate($model);
			//echo CActiveForm::validate($profilesModel);
			Yii::app()->end();
		}

		if(isset($_POST['submit'])){
		
			
			$amenity_id=array();
			$model->attributes = $_POST['Property'];
			$amenity_id=array();
			if((isset($_POST['PropertyAmenitiesHouse']))&&(isset($_POST['PropertyAmenitiesExternal']))){				
				$amenity_id=array_merge($_POST['PropertyAmenitiesHouse'],$_POST['PropertyAmenitiesExternal']);
			}
			elseif(isset($_POST['PropertyAmenitiesHouse'])){
				$amenity_id=$_POST['PropertyAmenitiesHouse'];
			}
			elseif(isset($_POST['PropertyAmenitiesExternal'])){
				$amenity_id=$_POST['PropertyAmenitiesExternal'];
			}		
			//			var_dump($amenity_id);die();
			$model->user_id = $userId;
			$valid = true;
			$data =  $_POST['Property'];

			if(isset($model->city_id)){
				$cityModel = GeoCity::model()->findByPk($model->city_id);
				if($cityModel){
					$model->state_id = $cityModel->state_id;
					$data['state_id'] = $cityModel->state_id;
					if(isset($model->locality)){
						$criteria = new CDbCriteria;
						$criteria->condition = 'city_id=:city_id && locality=:locality';
						$criteria->params = array(':city_id'=>$cityModel->id,':locality'=>$model->locality);
						$localityModel = GeoLocality::model()->find($criteria);
						$locality=$model->locality;
						if($localityModel){
							$model->locality_id = $localityModel->id;
						} else {
							$localityModel = new GeoLocality;
							$localityModel->locality = $model->locality;
							$localityModel->city_id = $model->city_id;
							$localityModel->save();
							$model->locality_id = $localityModel->id;
							$localityNew = $localityModel;
						}

						$data['locality_id'] = $localityModel->id;
					}
				}
			}

			$valid = $valid && $model->validate();
			if($model->latitude !='' && $model->longitude!='')
			$locationPosition = array($model->latitude,$model->longitude);
			if(!isset($data['property_type_id']))
			$data['property_type_id']=$model->property_type_id;
				
				
			if($valid){
				$data['property_name']=PropertyTypesApi::getPropertyTypeById($data['property_type_id']);
				if($data['jackpot_investment']!=$jackpot)
				$data['jackpot_investment']=2;
				if($data['instant_home']!=$instant)
				$data['instant_home']=2;
				if(isset($model->video_url))
				{
					
				$video=explode('&',$model->video_url);
				
				$videocode=explode('=',$video[0]);
				if(isset($videocode[1]))
				$data['video_url']=$videocode[1];
				}
				
				$property = PropertyApi::updatePropertyById($model->id,$data);
				if(!$property->hasErrors()){
						
					if(count($amenity_id) > 0)
					{
							
						PropertyAmenitiesApi::deleteAllAmenitiesForProperty($property->id);
						$amenities = PropertyAmenitiesApi::addAmenitiesForProperty($property->id,$amenity_id);
					}
					$images = $session['PropertyImages'];
					if(is_array($images)){
						foreach($images as $count=>$image) {
							$valid = $valid && (PropertyImagesApi::addImage($property->id,$image)===true);
						}
					}
					if($valid){
						unset($session['PropertyImages']);
						Yii::app()->user->setFlash('success','Great! You have succesfully updated your property.');
						$this->redirect('/property/'.$property->id);
					}	else{
						if($localityNew && !$localityNew->isNewRecord){
							$localityNew->delete();
						}
						unset($session['PropertyImages']);
						$propertyUpdateUrl = Yii::app()->createUrl('/property/update/'.$property->id.'');
						Yii::app()->user->setFlash('error','Oops! We faced a problem and hence could not update your property.Please <a href='.$propertyUpdateUrl.'>retry </a>');
					}
				}
			} else {
				if($localityNew && !$localityNew->isNewRecord){
					$localityNew->delete();
				}
				unset($session['PropertyImages']);
				//	var_dump($model->getErrors());
				Yii::app()->user->setFlash('error','There was an error while updating the property.');
			}

		}

		$this->render('update',array(
									'model'=>$model,
									'propertyAmenities'=>$propertyAmenities,
									'propertyImages'=>$propertyImages,
									'amenities'=>$amenities,
									'currentImages'=>$currentImages,
									'locationPosition'=>$locationPosition,
									'localityList'=>$localityList,
									'locality'=>$locality,
		));

		Yii::endProfile('property_update');
	}


	public function actionImage($id){
		Yii::beginProfile('property_image');
		$propertyId = $id;
		$property = PropertyApi::getPropertyById($propertyId);
		$userId = Yii::app()->user->id;
		if(!isset($property) || $property->user_id!=$userId){
			$this->redirect('/search');
			die();
		}

		$model = new PropertyImages;
		$images = PropertyImagesApi::getAllImages($propertyId);
		if(isset($_POST['submit'])){
			//$model->attributes=$_POST['PropertyImages'];
			$files = CUploadedFile::getInstancesByName('PropertyImages[image]');
			$valid = 1;
			if($files==null){
				$model->addError('image','Please select atleast one image.');
				$valid = 0;
			}
			if($valid){
				$imagePaths = ImageUtils::uploadMultipleImage($files);
				$count = PropertyImagesApi::addMultipleImage($propertyId,$imagePaths);
				ImageUtils::deleteMultipleImages($imagePaths);
				$this->refresh();
			}
		}
		$this->render('image',array('property'=>$property,'model'=>$model,'images'=>$images));
		Yii::endProfile('property_image');
	}


	public function actionView($id){
		Yii::beginProfile('property_view');

		$session = Yii::app()->session;
		$property = PropertyApi::getPropertyById($id);
		if(!$property){
			throw new CHttpException(404,'The requested page does not exist.');
		}

		if(!$property->furnished){
			$property->furnished = '-';
		}

		if(!$property->floor_number){
			$property->floor_number = '-';
		}

		if(!$property->total_floors){
			$property->total_floors = '-';
		}

		if(!$property->facing){
			$property->facing = '-';
		}

		$recentlyViewed=UserApi::getUserProfileDetails($property->recently_viewed);

		$propertyAgentInfo=AgentProfileApi::getAgentDetails($property->user_id);
		$propertyUser="";
		$propertyAgent="";
		$propertyBuilder="";
		$propertyBuilderInfo="";
		$propertySpecialist="";
		$propertySpecialistInfo="";
		$propertyRating="";
		$propertyRating=PropertyRatingApi::getRating($id);

		if($propertyAgentInfo){
			$propertyAgent=UserApi::getUserProfileDetails($propertyAgentInfo->user_id);
		}
		else{
			$propertyBuilderInfo=BuilderProfileApi::getBuilderDetails($property->user_id);
			if($propertyBuilderInfo){
				$propertyBuilder=UserApi::getUserProfileDetails($propertyBuilderInfo->user_id);
			}
			else{
				$propertySpecialistInfo=SpecialistProfileApi::getSpecialistDetails($property->user_id);
				if($propertySpecialistInfo){
					$propertySpecialist=UserApi::getUserProfileDetails($propertySpecialistInfo->user_id);
				}
				else{
					$propertyUser=UserApi::getUser($property->user_id);
				}
			}
		}
		$propertySimilar=PropertyApi::getSimilarProperties($property,3,$id);
		$propertySimilarAddress="";
		$propertySimilarUser="";
		if($propertySimilar)
		{
			foreach($propertySimilar as $similar){
				$propertySimilarAddress[$similar->id]=PropertyApi::getLocation($similar->id);
				$propertySimilarUser[$similar->id]=UserApi::getUserProfileDetails($similar->user_id);
			}
		}
		$recentlyViewedIds[]='';
		$recentlyViewedIds_total=$session['properties'];
		if($recentlyViewedIds_total)
		{
			$re_array=array_reverse($recentlyViewedIds_total);
			$i=0;
			foreach($re_array as $re)
			{
				$recentlyViewedIds=$re;
				$i++;
				if($i>2)
				break;
			}
		}

		$property_ids[]=$recentlyViewedIds;
		$property_ids[] = $id;
		$session['properties']=array_unique($property_ids);
		$propertyRecentlyViewed="";
		$propertyRecentlyViewedAddress="";
		$propertyRecentlyViewedUser="";
		if($recentlyViewedIds){
			foreach($recentlyViewedIds as $recent){
				$modelProperty = PropertyApi::getPropertyById($recent);
				if($modelProperty){
					$propertyRecentlyViewed[] = $modelProperty;
					$propertyRecentlyViewedAddress[]=PropertyApi::getLocation($recent);
					$propertyRecentlyViewedUser[]=UserApi::getUserProfileDetails($modelProperty->user_id);
				}
			}
		}

		$propertyImages=PropertyImagesApi::getAllImages($property->id);
		$propertyType=PropertyTypesApi::getPropertyTypeById($property->property_type_id);
		$transactionType=PropertyTransactionTypesApi::getTransactionTypeById($property->transaction_type_id);
		$ownershipType=OwnershipTypesApi::getOwnershipTypeById($property->ownership_type_id);
		$propertyAge=PropertyAgeOfConstructionApi::getpropertyAgeById($property->age_of_construction);
		$propertyAmenities=PropertyAmenitiesApi::getAmenitiesForProperty($property->id);
		$propertyAddress=PropertyApi::getLocation($property->id);
		$propertyRating=PropertyRatingApi::getRating($property->id);
		$propertyWishlist=PropertyWishlistApi::getWishlistUserOnProperty($property->id,Yii::app()->user->id);

		$this->render('view',array('property'=>$property,'recentlyViewed'=>$recentlyViewed,'propertyAgentInfo'=>$propertyAgentInfo,'propertyBuilderInfo'=>$propertyBuilderInfo,'propertySpecialistInfo'=>$propertySpecialistInfo,'propertyUser'=>$propertyUser,'propertyAgent'=>$propertyAgent,'propertyBuilder'=>$propertyBuilder,'propertySpecialist'=>$propertySpecialist,'propertySimilar'=>$propertySimilar,'propertySimilarAddress'=>$propertySimilarAddress,'propertySimilarUser'=>$propertySimilarUser,'propertyRecentlyViewed'=>$propertyRecentlyViewed,'propertyRecentlyViewedAddress'=>$propertyRecentlyViewedAddress,'propertyRecentlyViewedUser'=>$propertyRecentlyViewedUser,'propertyImages'=>$propertyImages,'propertyType'=>$propertyType,'propertyAddress'=>$propertyAddress,'transactionType'=>$transactionType,'ownershipType'=>$ownershipType,'propertyAge'=>$propertyAge,'propertyAmenities'=>$propertyAmenities,'propertyRating'=>$propertyRating,'propertyWishlist'=>$propertyWishlist));

		Yii::endProfile('property_view');
	}

	public function actionSearchProperty()
	{

		$modelProperty=null;
		$modelCity=null;
		$propertyAmenities=null;
		$modelUser=null;
		$modelProfile=null;
		$properties=null;
		$amenities=null;
		$users=null;
		$modelProject=null;
		$projectAmenities=null;
		$propertiesCount=null;
		$modelProperty = new Property;
		$modelCity = new GeoCity;
		$propertyAmenities = new PropertyAmenities;
		$modelUser = new UserCredentials;
		$modelProfile = new UserProfiles;
		$modelSpecialistType = new UserSpecialistType;
		$pages=null;
		$modelProperty = new Property;
			

		if(isset($_POST['Property']))
		{
			$modelProperty->attributes = $_POST['Property'];

			//var_dump($modelProperty->i_want_to);die();
			$data = $_POST['Property'];
			$data['keyword'] = isset($_POST['keyword'])? $_POST['keyword'] : null;
			$data['city_id'] = $_POST['GeoCity']['city'];
			$data['budget_min'] = $_POST['budget_min'];
			$data['budget_max'] = $_POST['budget_max'];
			$data['without_budget'] = isset($_POST['without_budget'])? $_POST['without_budget'] : 0 ;
			$data['PropertyAmenities'] = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
			$data['posted_by_all'] = isset($_POST['posted_by_all'])? $_POST['posted_by_all'] : 0;
			$data['posted_by'] = isset($_POST['posted_by'])? $_POST['posted_by'] : null;

			$criteria = PropertyApi::getCriteriaObject($data);
			$total=0;
			$totalProp = PropertyApi::searchPropertyWithCriteria($criteria);
			if($totalProp)
			$total=count($totalProp);
			$pages = new CPagination($total);
			$pages->pageSize =  Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);
			$properties = PropertyApi::searchPropertyWithCriteria($criteria);
			$propertiesCount=$total;
		}
		$this->render('/site/search',array('pages'=>$pages,
				'modelProperty'=>$modelProperty,
				'modelCity'=>$modelCity,
				'propertyAmenities'=>$propertyAmenities,
				'modelUser'=>$modelUser,
				'modelProfile'=>$modelProfile,
				'properties'=>$properties,
				'amenities'=>$amenities,
				'users'=>$users,
				'modelProject'=>$modelProject,
				'projectAmenities'=>$projectAmenities,
				'propertiesCount'=>$propertiesCount
		));


	}
	public function actionStarRatingAjax($userid,$id) {

		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		PropertyRatingApi::addRating($id,$userid,$ratingAjax);
		echo 'Your Rating is '.$ratingAjax;

	}

	public function actionAddWishlist($userid=1,$propertyid=78)
	{
		PropertyWishlistApi::addToWishlist($propertyid,$userid);
		echo "<h2>Added to Wishlist</h2>";
	}

	public function actionSearchCriteria()
	{
		echo $_POST['Property']['property_type_id'];
		//echo "sfdsf";
	}

	protected function performAjaxValidation($model) {

		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

	}

	public function actionDeleteProperty($id){

		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		$property = PropertyApi::getPropertyById($id);

		if($property->user_id!==Yii::app()->user->id)
		throw new CHttpException(403,'You are not authorized.');

		if(PropertyApi::deletePropertyById($property->id)){
			Yii::app()->user->setFlash('success','The property was removed successfully');
		}else {
			Yii::app()->user->setFlash('error','The property could not be removed. Please contact the admin.');
		}
		$this->redirect('/properties');

	}
	public function actionGetPropertyFeatures(){


		$model=new Property;
		$propertyAmenities = new PropertyAmenities;

		$type=$_POST['Property']['property_type_id'];
		$this->renderPartial('getPropertyFeatures',array('type'=>$type,'model'=>$model,'propertyAmenities'=>$propertyAmenities));
	}
	public function actionGetPropertyCriteriaType($id)
	{
		if(isset($_POST['Property']['property_type_id']))
		$type= $_POST['Property']['property_type_id'];
		else
		$type = $id;
		$modelProperty=new Property;
		$propertyAmenities=new PropertyAmenities;
		if($type)
		$this->renderPartial('getPropertyCriteriaType',array('type'=>$type,'modelProperty'=>$modelProperty,'propertyAmenities'=>$propertyAmenities));
	}
}