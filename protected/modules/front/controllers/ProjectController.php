<?php

class ProjectController extends FrontController
{
	public function actionIndex()
	{
		Yii::beginProfile('projects');
		$totalProject='0';
		$criteria = ProjectApi::getCriteriaObjectForUser(Yii::app()->user->id);
		$projects = ProjectApi::searchMyPropertyWithCriteria($criteria);
		if($projects)
		{$totalProject = count($projects);}
		$pages = new CPagination($totalProject);
		$pages->pageSize = Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);
		$projects = ProjectApi::searchMyPropertyWithCriteria($criteria);

		//$projects = ProjectApi::getProjectsOfUser(Yii::app()->user->id);
		$this->render('index',array('projects'=>$projects,'pages'=>$pages));
		Yii::endProfile('projects');
	}

	public function actionPost()
	{
		Yii::beginProfile('project_post');

		$model = new Projects;
		$modelCity = new GeoCity;
		$modelState= new GeoState;
		$modelAmenities = new ProjectAmenities;
		$modelImages = new ProjectImages;
		$amenities = null;
	
		if(isset($_POST['submit'])){
			$model->attributes = $_POST['Projects'];
			$modelImages->attributes = $_POST['ProjectImages'];
			$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
			/*if($amenities){
			 $amenity_data = null;
			 foreach($amenities as $i=>$amenity){
			 if($i!=0)
			 $amenity_data.=',';
			 $amenity_data.=$amenity;
			 }
			 $amenities = $amenity_data;
			 }*/
			$valid = true;
			$model->user_id = Yii::app()->user->id;
			$valid = $valid && $model->validate();
			if($amenities==null){
				$modelAmenities->addError('amenity_id','Amenities cannot be blank.');
				$valid = false;
			}
			$modelImages->image=CUploadedFile::getInstance($modelImages,'image');
			if($modelImages->image==""){
				$modelImages->addError('image','Image cannot be blank.');
				$valid = false;
			}
			if($valid){
					$data =  $_POST['Projects'];
					$project = ProjectApi::createProject('1',$data);
					if(!$project->hasErrors()){
						$amenities = ProjectAmenitiesApi::addAmenitiesForProject($project->id,$_POST['amenity_id']);
						$imagePath = ImageUtils::uploadImage($modelImages,'image');
						if($amenities && $imagePath){
							$image = ProjectImagesApi::addImage($project->id,$imagePath);
							if(!$image){
								ProjectApi::deleteProjectById($project->id);
								ProjectAmenitiesApi::deleteAllAmenitiesForProject($project->id);
							}
							if(file_exists($imagePath))
							unlink($imagePath);
							$data = array();
							$user = UserApi::getUserById($project->user_id);
							$user ? $data["user"] = $user->id : null;
							$data["project"] = $project->id;
							
							EmailApi::sendEmail($user->email_id,"ACTIVITY.PROJECT.NEW",$data);
								
							$this->redirect('/project/'.$project->id);
						}
						else{
							ProjectApi::deleteProjectById($project->id);
							ProjectAmenitiesApi::deleteAllAmenitiesForProject($project->id);
						}
					}
					else{
						if(isset($property->id)){
							ProjectApi::deleteProjectById($property->id);
						}
					}
				
				}
				
		}
		$this->render('post',array('model'=>$model,'modelState'=>$modelState,'modelCity'=>$modelCity,'modelAmenities'=>$modelAmenities,'modelImages'=>$modelImages,'amenities'=>$amenities));

		Yii::endProfile('project_post');
	}

	public function actionImage($id){
		Yii::beginProfile('project_image');
		$projectId = $id;
		$project = ProjectApi::getProjectById($projectId);
		$userId = Yii::app()->user->id;
		if(!isset($project) || $project->user_id!=$userId){
			$this->redirect('/search');
		}

		$model = new ProjectImages;
		$images = ProjectImagesApi::getAllImages($projectId);
		if(isset($_POST['submit'])){
			//$model->attributes=$_POST['PropertyImages'];
			$files = CUploadedFile::getInstancesByName('ProjectImages[image]');
			$valid = 1;
			if($files==null){
				$model->addError('image','Please select atleast one image.');
				$valid = 0;
			}
			if($valid){
				$imagePaths = ImageUtils::uploadMultipleImage($files);
				$count = ProjectImagesApi::addMultipleImage($projectId,$imagePaths);
				ImageUtils::deleteMultipleImages($imagePaths);
				$this->refresh();
			}
		}
		$this->render('image',array('project'=>$project,'model'=>$model,'images'=>$images));
		Yii::endProfile('project_image');
	}

	public function actionView($id){
		Yii::beginProfile('project_view');

		$session = Yii::app()->session;
		$project = ProjectApi::getProjectById($id);
		if(!$project){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$recentlyViewed=UserApi::getUserProfileDetails($project->recently_viewed);
		$projectAgentInfo=AgentProfileApi::getAgentDetails($project->user_id);
		$projectUser="";
		$projectAgent="";
		$projectBuilder="";
		$projectBuilderInfo="";
		$projectSpecialist="";
		$projectSpecialistInfo="";
		$projectRating='';
		if($projectAgentInfo){
			$projectAgent=UserApi::getUserProfileDetails($projectAgentInfo->user_id);
		}
		else{
			$projectBuilderInfo=BuilderProfileApi::getBuilderDetails($project->user_id);
			if($projectBuilderInfo){
				$projectBuilder=UserApi::getUserProfileDetails($projectBuilderInfo->user_id);
			}
			else{
				$projectSpecialistInfo=SpecialistProfileApi::getSpecialistDetails($project->user_id);
				if($projectSpecialistInfo){
					$projectSpecialist=UserApi::getUserProfileDetails($projectSpecialistInfo->user_id);
				}
				else{
					$projectUser=UserApi::getUser($project->user_id);
				}
			}
		}
		$projectSimilar=ProjectApi::getSimilarProjects($project,3);
		$projectSimilarAddress="";
		$projectSimilarUser="";
		if($projectSimilar)
		{
			foreach($projectSimilar as $similar){
				$projectSimilarAddress[$similar->id]=ProjectApi::getLocation($similar->id);
				$projectSimilarUser[$similar->id]=UserApi::getUserProfileDetails($similar->user_id);
			}
		}
		$recentlyViewedIds=$session['projects'];
		$project_ids=$recentlyViewedIds;
		$project_ids[] = $id;
		$session['projects']=array_unique($project_ids);
		$projectRecentlyViewed="";
		$projectRecentlyViewedAddress="";
		$projectRecentlyViewedUser="";
		if($recentlyViewedIds){
			foreach($recentlyViewedIds as $recent){
				$modelProject = ProjectApi::getProjectById($recent);
				$projectRecentlyViewed[] = $modelProject;
				$projectRecentlyViewedAddress[]=ProjectApi::getLocation($recent);
				$projectRecentlyViewedUser[]=UserApi::getUserProfileDetails($modelProject->user_id);
			}
		}
		$projectImages=ProjectImagesApi::getAllImages($project->id);
		$projectType=ProjectTypesApi::getProjectTypeById($project->project_type_id);
		$ownershipType=OwnershipTypesApi::getOwnershipTypeById($project->ownership_type_id);
		$projectAmenities=ProjectAmenitiesApi::getAmenitiesForProject($project->id);
		$projectAddress=ProjectApi::getLocation($project->id);
		$projectProperties = ProjectPropertiesApi::getPropertiesModel($project->id);
		$projectWishlist=ProjectWishlistApi::getWishlistUserOnProject($project->id,Yii::app()->user->id);
		$projectRating=ProjectRatingApi::getRating($project->id);
		$projectViews=ProjectApi::getViews($project->id);
		ProjectApi::setViews($project->id);
		$this->render('view',array('project'=>$project,'recentlyViewed'=>$recentlyViewed,'projectAgentInfo'=>$projectAgentInfo,'projectBuilderInfo'=>$projectBuilderInfo,'projectSpecialistInfo'=>$projectSpecialistInfo,'projectUser'=>$projectUser,'projectAgent'=>$projectAgent,'projectBuilder'=>$projectBuilder,'projectSpecialist'=>$projectSpecialist,'projectSimilar'=>$projectSimilar,'projectSimilarAddress'=>$projectSimilarAddress,'projectSimilarUser'=>$projectSimilarUser,'projectRecentlyViewed'=>$projectRecentlyViewed,'projectRecentlyViewedAddress'=>$projectRecentlyViewedAddress,'projectRecentlyViewedUser'=>$projectRecentlyViewedUser,'projectImages'=>$projectImages,'projectType'=>$projectType,'projectAddress'=>$projectAddress,'ownershipType'=>$ownershipType,'projectAmenities'=>$projectAmenities,'projectProperties'=>$projectProperties,'projectRating'=>$projectRating,'projectWishlist'=>$projectWishlist,'projectViews'=>$projectViews));

		Yii::endProfile('project_view');
	}
	public function actioSearchProject()
	{
				$modelProject->attributes = $_POST['Projects'];
				$amenities = isset($_POST['ProjectAmenities']['amenity_id'])? $_POST['ProjectAmenities']['amenity_id'] : null;
				if($amenities){
					$amenity_data = null;
					foreach($amenities as $i=>$amenity){
						if($i!=0)
						$amenity_data.=',';
						$amenity_data.=$amenity;
					}
					$amenities = $amenity_data;
				}
				$data = $_POST['Projects'];
				$data['keyword'] = isset($_POST['keyword'])? $_POST['keyword'] : null;
				$data['city_id'] = $_POST['GeoCity']['city'];
				$data['budget_min'] = $_POST['budget_min'];
				$data['budget_max'] = $_POST['budget_max'];
				$data['ProjectAmenities'] = isset($_POST['ProjectAmenities']['amenity_id'])? $_POST['ProjectAmenities']['amenity_id'] : null;
				$data['posted_by_all'] = isset($_POST['posted_by_all'])? $_POST['posted_by_all'] : 0;
				$data['posted_by'] = isset($_POST['posted_by'])? $_POST['posted_by'] : null;
				$totalProject='0';
				$criteria = ProjectApi::getCriteriaObject($data);
				$users = ProjectApi::searchProjectWithCriteria($criteria);
				if($users)
				$totalProject = count($users);
		       	$pagesProject = new CPagination($totalProject);
		        $pagesProject->pageSize =  Yii::app()->params['resultsPerPage'];
		        $pagesProject->applyLimit($criteria);
		        
				$projects = ProjectApi::searchProjectWithCriteria($criteria);
	}
	public function actionSearch()
	{
		Yii::beginProfile('search_project');
		$projects = null;
		$data = null;
		$amenities = null;
		$projects = ProjectApi::searchProject($data);
		$modelProject = new Projects;
		$modelCity = new GeoCity;
		$projectAmenities = new ProjectAmenities;

		if(isset($_POST['submit']) && isset($_POST['mode'])){
			$modelProject->attributes = $_POST['Projects'];
			$amenities = isset($_POST['ProjectAmenities']['amenity_id'])? $_POST['ProjectAmenities']['amenity_id'] : null;
			if($amenities){
				$amenity_data = null;
				foreach($amenities as $i=>$amenity){
					if($i!=0)
					$amenity_data.=',';
					$amenity_data.=$amenity;
				}
				$amenities = $amenity_data;
			}
			$data = $_POST['Projects'];
			$data['keyword'] = $_POST['keyword'];
			$data['city'] = $_POST['GeoCity']['city'];
			$data['budget_min'] = $_POST['budget_min'];
			$data['budget_max'] = $_POST['budget_max'];
			$data['ProjectAmenities'] = isset($_POST['ProjectAmenities']['amenity_id'])? $_POST['ProjectAmenities']['amenity_id'] : null;
			$data['posted_by_all'] = isset($_POST['posted_by_all'])? $_POST['posted_by_all'] : 0;
			$data['posted_by'] = isset($_POST['posted_by'])? $_POST['posted_by'] : null;
			$projects = ProjectApi::searchProject($data);
		}
		$this->render('search',array('modelProject'=>$modelProject,'modelCity'=>$modelCity,'projectAmenities'=>$projectAmenities,'projects'=>$projects,'amenities'=>$amenities));
		Yii::endProfile('search_project');
	}
	public function actionStarRatingAjax($userid,$id) {
			
		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		ProjectRatingApi::addRating($userid,$id,$ratingAjax);
		echo 'Your Rating is '.$ratingAjax;
			
	}
	public function actionaddWishlist($propertyid,$userid)
	{
		ProjectWishlistApi::addToWishlist($propertyid,$userid);
		echo "<h2>Added to Wishlist</h2>";
	}
}