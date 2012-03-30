<?php	

class SearchController extends FrontController {

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}

	public function actionProperty(){

		Yii::beginProfile('search_property');
			
			
		$session=new CHttpSession;
		$session->open();
		//$session->destroy();
		//


		// Initiate the pagination variables.
		$properties = null;
		$data = null;
		//$data['new_launches'] = isset($_POST['new_launches']) ? $_POST['new_launches'] : '';
		$data['new_launches'] = isset($_GET['new_launches']) ? $_GET['new_launches'] : '';
		$data['agent_id'] = isset($_GET['agent_id']) ? $_GET['agent_id'] : '';
		$data['builder_id'] = isset($_GET['builder_id']) ? $_GET['builder_id'] : '';
		$data['i_want_to'] = isset($_GET['i_want_to']) ? $_GET['i_want_to'] : 'Sell';

		//	var_dump($data);die();
		//var_dump($data);die();

		// Initiate the models to be used in the search screen.
		$modelProperty = new Property;
		$modelState=new GeoState;
		$modelCity = new GeoCity;
		$modelLocality = new GeoLocality;
		$propertyAmenities = new PropertyAmenities;

		//	var_dump(Yii::app()->params['resultsPerPage']);die();

		//	var_dump($_POST);
		
		if(isset($_POST['Property'])){

			// Populate the search criteria to a variable and pass it to the Api to get the criteria object.
			$modelProperty->attributes = $_POST['Property'];
			$data = $_POST['Property'];
			if(isset($_POST['minbuysearch']))
			{
				$data['property_type_id']='';
				$data['transaction_type_id']='';
				$data['age_of_construction']='';
				$data['ownership_type_id']='';
				$data['jackpot_investment']='0';
				$data['featured']='0';
				$data['instant_home']='0';
				$data['keyword']='';
				
			}
			//$data['new_launches'] = isset($_POST['new_launches']) ? $_POST['new_launches'] : '';
			$data['new_launches'] = isset($_GET['new_launches']) ? $_GET['new_launches'] : '';
			$data['agent_id'] = isset($_GET['agent_id']) ? $_GET['agent_id'] : '';
			$data['builder_id'] = isset($_GET['builder_id']) ? $_GET['builder_id'] : '';

			$data['keyword'] = isset($_POST['keyword']) ? $_POST['keyword'] : null;
			$data['city_id'] = isset($_POST['GeoCity']['city']) ? $_POST['GeoCity']['city'] : '' ;
			$data['state_id'] = isset($_POST['GeoState']['state']) ? $_POST['GeoState']['state'] : '' ;
			$data['locality_id'] = isset($_POST['GeoLocality']['locality']) ? $_POST['GeoLocality']['locality'] : '' ;

			if($data['locality_id']!='') {
				$locality = GeoLocality::model()->find('locality=:locality',array(':locality'=>$data['locality_id']));
				if($locality)
				$data['locality_id'] = $locality->id;
			}
			if($data['keyword']='Eg: Builder')
			{
				$data['keyword']='';
			}
				

			//var_dump($_POST['Property']['i_want_to']);
			if(isset($_POST['Property']['i_want_to'])){
				if($_POST['Property']['i_want_to']=='Rent')
				{
					if(isset($_POST['budget_min_rent']))
						$data['budget_min']=$_POST['budget_min_rent'];
					elseif(isset($_POST['budget_min']))
						$data['budget_min'] = $_POST['budget_min'];
						
					if(isset($_POST['budget_max_rent']))
						$data['budget_max']=$_POST['budget_max_rent'];
					elseif(isset($_POST['budget_max']))
						$data['budget_max'] = $_POST['budget_max'];
				}
				else
				{
					if(isset($_POST['budget_min']))
						$data['budget_min'] = $_POST['budget_min'];
					if(isset($_POST['budget_max']))
						$data['budget_max'] = $_POST['budget_max'];
				}
			} else {
				$data['i_want_to'] = 'sell';
				if(isset($_POST['budget_min']))
						$data['budget_min'] = $_POST['budget_min'];
				if(isset($_POST['budget_max']))
						$data['budget_max'] = $_POST['budget_max'];
			}
			
	
			$data['without_budget'] = isset($_POST['without_budget'])? $_POST['without_budget'] : 0 ;
			$data['PropertyAmenities'] = isset($_POST['PropertyAmenities']['amenity_id'])? $_POST['PropertyAmenities']['amenity_id'] : null;
			$data['posted_by_all'] = isset($_POST['posted_by_all'])? $_POST['posted_by_all'] : 0;
			$data['posted_by'] = isset($_POST['posted_by'])? $_POST['posted_by'] : null;
			$criteria = PropertyApi::getCriteriaObject($data);
			$total=Property::model()->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);

			$properties = PropertyApi::searchPropertyWithCriteria($criteria);
			$propertiesCount=$total;
			
			$session['search-criteria-property'] = $criteria;
			$session['results-page'] = $total;
		} else {

			/*if(isset($_GET['page'])) {

			$total=0;
			$criteria = $session['search-criteria'];
			$total = $session['results-page'];
			$pages = new CPagination($total);
			$pages->pageSize =  Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);
			$propertiesCount=$totalProp;
			$properties = PropertyApi::searchPropertyWithCriteria($criteria);
			$total = count($properties);

			} else {*/
			//	unset($session['search-criteria']);
			
			if(isset($session['search-criteria-property'])){
				$criteria = $session['search-criteria-property'];
				//$criteria = new CDbCriteria;
			}else {
				$criteria = PropertyApi::getCriteriaObject($data);
			}
			if($data['new_launches']){
				$totalProp = Property::model()->count();
				$properties = PropertyApi::searchPropertyWithCriteria();
			}
			else{
				$totalProp = Property::model()->count($criteria);
				$properties = PropertyApi::searchPropertyWithCriteria($criteria);
			}
			$pages = new CPagination($totalProp);
			$pages->pageSize =  Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);

			$propertiesCount=$totalProp;
			//	}

		}



		$this->render('property',array('pages'=>$pages,
									 'modelState'=>$modelState,
									 'modelProperty'=>$modelProperty,
									 'modelCity'=>$modelCity,
									 'modelLocality'=>$modelLocality,
									 'propertyAmenities'=>$propertyAmenities,
									 'properties'=>$properties,
									 'propertiesCount'=>$propertiesCount,

		));
		Yii::endProfile('search_property');

	}

	public function actionProject(){

		Yii::beginProfile('search_project');

		$session=new CHttpSession;
		$session->open();
		//$session->destroy();

		// Initiate the entities.
		$projects = null;
		$data = null;
		$modelProject = new Projects;
		$modelState=new GeoState;
		$modelCity = new GeoCity;
		$projectAmenities = new ProjectAmenities;

		$data['new_launches'] = isset($_POST['new_launches']) ? $_POST['new_launches'] : '';

		if(isset($_POST['Projects'])){

			$modelProject->attributes = $_POST['Projects'];
			$projectAmenities = isset($_POST['ProjectAmenities']['amenity_id'])? $_POST['ProjectAmenities']['amenity_id'] : null;
			if($projectAmenities){
				$amenity_data = null;
				foreach($projectAmenities as $i=>$amenity){
					if($i!=0)
					$amenity_data.=',';
					$amenity_data.=$amenity;
				}
				$projectAmenities = $amenity_data;
			}
			$data = $_POST['Projects'];
			$data['keyword'] = isset($_POST['keyword'])? $_POST['keyword'] : null;

			$data['new_launches'] = isset($_POST['new_launches']) ? $_POST['new_launches'] : '';

			$data['city_id'] = isset($_POST['GeoCity']['city']) ? $_POST['GeoCity']['city'] : '' ;
			$data['state_id'] = isset($_POST['GeoState']['state']) ? $_POST['GeoState']['state'] : '' ;
			$data['locality_id'] = isset($_POST['GeoLocality']['locality']) ? $_POST['GeoLocality']['locality'] : '' ;

			if($data['locality_id']!='') {
				$locality = GeoLocality::model()->find('locality=:locality',array(':locality'=>$data['locality_id']));
				if($locality)
				$data['locality_id'] = $locality->id;
			}
			$data['budget_min'] = $_POST['budget_min'];
			$data['budget_max'] = $_POST['budget_max'];
			$data['without_budget'] = isset($_POST['without_budget'])? $_POST['without_budget'] : 0 ;
			$data['ProjectAmenities'] = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
			$data['posted_by_all'] = isset($_POST['posted_by_all'])? $_POST['posted_by_all'] : 0;
			$data['posted_by'] = isset($_POST['posted_by'])? $_POST['posted_by'] : null;


			$criteria = ProjectApi::getCriteriaObject($data);
			$total = Projects::model()->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize =  Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);

			$projects = ProjectApi::searchProjectWithCriteria($criteria);
			$projectsCount = $total;
			if(isset($_SERVER['HTTP_REFERER']))
			{
				unset($session['search-criteria-project']);
				unset($session['results-page']);
			}
			$session['search-criteria-project'] = $criteria;
			$session['results-page'] = $total;
		}	else {
			if(isset($_SERVER['HTTP_REFERER']))
			{
				unset($session['search-criteria-project']);
				unset($session['results-page']);
			}
			if(isset($session['search-criteria-project'])){
				$criteria = $session['search-criteria-project'];
			}else {
				$criteria = new CDbCriteria;

			}


			//$criteria = PropertyApi::getCriteriaObject($data);
			$totalProj = Projects::model()->count($criteria);
			$pages = new CPagination($totalProj);
			$pages->pageSize =  Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);
			$projects = ProjectApi::searchProjectWithCriteria($criteria);
			$projectsCount=$totalProj;
			//	}

		}

		$this->render('project',array('pages'=>$pages,
									 'modelState'=>$modelState,
									 'modelProject'=>$modelProject,
									 'modelCity'=>$modelCity,
									 'modelLocality'=>$modelLocality,
									 'projectAmenities'=>$projectAmenities,
									 'projects'=>$projects,
									 'projectsCount'=>$projectsCount,

		));
		Yii::endProfile('search_project');
	}


	public function actionPeople(){

		Yii::beginProfile('search_people');

		$session=new CHttpSession;
		$session->open();
		//$session->destroy();

		// Initiate the entities.
		$users = null;
		$data = null;
		$modelUser = new UserCredentials;
		$modelProfile = new UserProfiles;
		$modelSpecialistType = new UserSpecialistType;
	
		$modelState=new GeoState;
		$modelCity = new GeoCity;
		$modelLocality = new GeoLocality;
		
		if(isset($_POST['GeoCity']))
		$modelCity->attributes=$_POST['GeoCity'];
			
		if(isset($_POST['user_type'])){
		
			//$data = $_POST['UserProfiles'];
			$data['user_type'] = $_POST['user_type'];
			$data['property_type_id'] = isset($_POST['property_type_id'])? $_POST['property_type_id'] : null;
			$data['state_id'] = isset($_POST['GeoState']['state'])? $_POST['GeoState']['state'] : null;
			$data['city_id'] = isset($_POST['GeoCity']['city'])? $_POST['GeoCity']['city'] : null;
			$data['keyword'] = isset($_POST['keyword'])? $_POST['keyword'] : null;
			$data['specialist_type_id'] = isset($_POST['specialist_type_id'])? $_POST['specialist_type_id'] : null;
			$data['locality_id'] = isset($_POST['GeoLocality']['locality']) ? $_POST['GeoLocality']['locality'] : '' ;
			if($data['specialist_type_id'][0]=='')
			$data['specialist_type_id']=null;
			
		
			if($data['locality_id']!='') {
				$locality = GeoLocality::model()->find('locality=:locality',array(':locality'=>$data['locality_id']));
				if($locality)
				$data['locality_id'] = $locality->id;
			}

			$totalResults = 0;

			if($_POST['user_type']=="agent"){

				$criteria = AgentProfileApi::getCriteriaObject($data);
				$totalResults = UserCredentials::model()->count($criteria);
				$pages = new CPagination($totalResults);
				$pages->pageSize =  Yii::app()->params['resultsPerPage'];
				$pages->applyLimit($criteria);

				$users = AgentProfileApi::searchAgentWithCriteria($criteria);

				if(isset($_SERVER['HTTP_REFERER']))
				{
					unset($session['search-criteria-user-type']);

				}
				$session['search-criteria-user-type'] = 'agent';
			}
			if($_POST['user_type']=="builder"){

				$criteria = BuilderProfileApi::getCriteriaObject($data);
				$totalResults = UserCredentials::model()->count($criteria);
					
				$pages = new CPagination($totalResults);
				$pages->pageSize =  Yii::app()->params['resultsPerPage'];
				$pages->applyLimit($criteria);
					
				$users = BuilderProfileApi::searchBuilderWithCriteria($criteria);
				if(isset($_SERVER['HTTP_REFERER']))
				{
					unset($session['search-criteria-user-type']);

				}
				$session['search-criteria-user-type'] = 'builder';
			}
			if($_POST['user_type']=="specialist"){
		
				$criteria = SpecialistProfileApi::getCriteriaObject($data);
				
				$totalResults = UserCredentials::model()->count($criteria);


				$pages = new CPagination($totalResults);
				$pages->pageSize =  Yii::app()->params['resultsPerPage'];
				$pages->applyLimit($criteria);
					
				$users = SpecialistProfileApi::searchSpecialistsWithCriteria($criteria);
				if(isset($_SERVER['HTTP_REFERER']))
				{
					unset($session['search-criteria-user-type']);

				}
				$session['search-criteria-user-type'] = 'specialist';

			}

			$session['search-criteria-user'] = $criteria;
			$session['results-page'] = $totalResults;



		}	else {
			if(isset($_SERVER['HTTP_REFERER']))
			{
				unset($session['search-criteria-user-type']);
				unset($session['search-criteria-user']);
					
			}
			if(isset($session['search-criteria-user']) && isset($session['search-criteria-user-type'])){
				$criteria = $session['search-criteria-user'];
				$userType = $session['search-criteria-user-type'];

				if($userType=="agent"){
					$data['user_type'] = 'agent';

					$totalResults = UserCredentials::model()->count($criteria);

					$pages = new CPagination($totalResults);
					$pages->pageSize =  Yii::app()->params['resultsPerPage'];
					$pages->applyLimit($criteria);

					$users = AgentProfileApi::searchAgentWithCriteria($criteria);
				
				}elseif($userType=="builder"){

					$data['user_type'] = 'builder';
					$totalResults = UserCredentials::model()->count($criteria);

					$pages = new CPagination($totalResults);
					$pages->pageSize =  Yii::app()->params['resultsPerPage'];
					$pages->applyLimit($criteria);

					$users = BuilderProfileApi::searchBuilderWithCriteria($criteria);

				}else {
					$data['user_type'] = 'specialist';
					$totalResults = UserCredentials::model()->count($criteria);

					$pages = new CPagination($totalResults);
					$pages->pageSize =  Yii::app()->params['resultsPerPage'];
					$pages->applyLimit($criteria);


					$users = SpecialistProfileApi::searchSpecialistsWithCriteria($criteria);
				}

			} else {
				$data['user_type'] = 'agent';
				$criteria = AgentProfileApi::getCriteriaObject($data);
				$totalResults = UserCredentials::model()->count($criteria);

				$pages = new CPagination($totalResults);
				$pages->pageSize =  Yii::app()->params['resultsPerPage'];
				$pages->applyLimit($criteria);

				$users = AgentProfileApi::searchAgentWithCriteria($criteria);
			}


		}

		$this->render('people',array('pages'=>$pages,
									 'modelState'=>$modelState,
									 'modelUser'=>$modelUser,
									 'modelProfile'=>$modelProfile,
									 'modelCity'=>$modelCity,
									 'modelLocality'=>$modelLocality,
									 'modelSpecialistType'=>$modelSpecialistType,
									 'users'=>$users,
									 'totalResults'=>$totalResults,
									 'userType'=>$data['user_type'],

		));
		Yii::endProfile('search_people');
	}



}


?>