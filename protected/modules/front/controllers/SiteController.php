<?php

class SiteController extends FrontController {
	/**
	 * Declares class-based actions.
	 */
	public function actions() {

	}
	public function actionEmi()
	{
		$emi='';
	
		$loan =new Loan;
		$emiData=array('amount'=>'','interest'=>'','year'=>'','month'=>'','type'=>'');
		if(isset($_POST['emi']))
		{
			$year='';
			$months='';
			$amount=$_POST['amt'];
			$interest=$_POST['interest'];
			$year=$_POST['years'];
			$month=($year*12);
			$interest_div=($interest/1200);
			$top=(($amount*$interest_div))*(pow((1+$interest_div),$month));
			$bottom=((pow((1+$interest_div),$month))-1);
			$emi=($top/$bottom);
			$emi=round($emi,2);
			if($_POST['type']=='years')
			{$emi=12*$emi;}
			
			$emiData=array('amount'=>$amount,'interest'=>$interest,'year'=>$year,'type'=>$_POST['type']);
				
		}
		
		if(isset($_POST['loan']))
		{
				
			$loan->attributes=$_POST['Loan'];
			if($loan->validate())
			if($loan->save()){
				Yii::app()->user->setFlash('success','Your Request For Loan has been submitted');
				$this->redirect('/emi');
			}
			else{
				Yii::app()->user->setFlash('error','Your Request For Loan not submitted.Please <a href="/emi">retry</a>');
			}
				
		}

	
		$this->render('emi',array('emi'=>$emi,'loan'=>$loan,'emiData'=>$emiData));

	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionHome() {

		Yii::beginProfile ( 'home' );
		$session=new CHttpSession;
		$session->open();
		$location=null;
		$properties = new Property;
		$modelCity =new GeoCity;
		$modelState=new GeoState;
		$localityList = GeoLocalityApi::getAllNameList();



		if($session['top-country']&&$session['top-location'])
		{
			$location['country']=$session['top-country'];
			$location['city']=$session['top-location'];
		}
		$this->render ( 'home' ,array('properties'=>$properties,'modelCity'=>$modelCity,
				'modelState'=>$modelState,
				'localityList'=>$localityList,
				'location'=>$location,
		));
		Yii::endProfile ( 'home' );
	}

	public function actionSearch()
	{
		Yii::beginProfile('search_property_and_people');

		// Initiate the entities.
		$properties = null;
		$users = null;
		$projects = null;

		$data = null;
		$data_user = null;
		$data_project = null;
		$data_user['user_type'] = 'agent';

		$amenities = null;
		$pages=null;
		$pagesAgent=null;
		$pagesBuilder=null;
		$pagesSpecialists=null;
		$pagesProject=null;


		$criteria = PropertyApi::getCriteriaObject($data);
		$totalProp = Property::model()->count();
		$pages = new CPagination($totalProp);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];

		$pages->applyLimit($criteria);
		$properties = PropertyApi::searchPropertyWithCriteria($criteria);
		$propertiesCount=$totalProp;

		$totalUser=0;
		$criteria = UserApi::getCriteriaObject($data_user);
		$users = UserApi::searchUser($data_user);
		if($users)
		$totalUser = count($users);
		$pagesUser = new CPagination($totalUser);
		$pagesUser->pageSize =  Yii::app()->params['resultsPerPage'];
		$pagesUser->applyLimit($criteria);
		$users = UserApi::searchUserWithCriteria($criteria);

		//$users = UserApi::searchUser($data_user);


		$projects = ProjectApi::searchProject($data_project);


		/* Property Model */
		$modelProperty = new Property;
		$modelState=new GeoState;
		$modelCity = new GeoCity;
		$propertyAmenities = new PropertyAmenities;

		// echo '<pre>';var_dump($pages);die();


		/* People Models */
		$modelUser = new UserCredentials;
		$modelProfile = new UserProfiles;
		$modelSpecialistType = new UserSpecialistType;


		/* Project Model */
		$modelProject = new Projects;
		$projectAmenities = new ProjectAmenities;

		if(isset($_POST['search']) && isset($_POST['mode'])){
				
			if($_POST['mode']=="property"){
				$modelProperty->attributes = $_POST['Property'];
				//$modelProperty['i_want_to'] = isset($_POST['Property']['i_want_to'])?$_POST['Property']['i_want_to'] : null;

				$data = $_POST['Property'];
				$data['keyword'] = isset($_POST['keyword'])? $_POST['keyword'] : null;
				$data['city'] = $_POST['GeoCity']['city'];
				$data['budget_min'] = $_POST['budget_min'];
				$data['budget_max'] = $_POST['budget_max'];
				$data['without_budget'] = isset($_POST['without_budget'])? $_POST['without_budget'] : 0 ;
				$data['PropertyAmenities'] = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
				$data['posted_by_all'] = isset($_POST['posted_by_all'])? $_POST['posted_by_all'] : 0;
				$data['posted_by'] = isset($_POST['posted_by'])? $_POST['posted_by'] : null;

				$criteria = PropertyApi::getCriteriaObject($data);
				$totalProp = Property::model()->count();
				$pages = new CPagination($totalProp);
				$pages->pageSize =  Yii::app()->params['resultsPerPage'];
				$pages->applyLimit($criteria);
				$properties = PropertyApi::searchPropertyWithCriteria($criteria);
				$propertiesCount=$totalProp;
				//$properties = PropertyApi::searchProperty($data);
			}
			elseif($_POST['mode']=="people"){
				$modelProfile->attributes = $_POST['UserProfiles'];
				$data_user = null;
				$data_user = $_POST['UserProfiles'];
				$data_user['user_type'] = $_POST['user_type'];
				$data_user['property_type_id'] = isset($_POST['property_type_id'])? $_POST['property_type_id'] : null;
				$data_user['keyword'] = isset($_POST['keyword'])? $_POST['keyword'] : null;
				$data_user['specialist_type_id'] = isset($_POST['specialist_type_id'])? $_POST['specialist_type_id'] : null;
				//$users = UserApi::searchUser($data_user);
				if($_POST['user_type']=="agent"){
					$totalAgent='0';
					$criteria = AgentProfileApi::getCriteriaObject($data_user);
					$users = AgentProfileApi::searchAgents($data_user);
					if($users)
					$totalAgent = count($users);
					$pagesAgent = new CPagination($totalAgent);
					$pagesAgent->pageSize =  Yii::app()->params['resultsPerPage'];
					$pagesAgent->applyLimit($criteria);
					$users = AgentProfileApi::searchAgentWithCriteria($criteria);
						
					//	$users = AgentProfileApi::searchAgents($data_user);
				}
				if($_POST['user_type']=="builder"){
					$totalBuilder='0';
					$criteria = BuilderProfileApi::getCriteriaObject($data_user);
					$users = BuilderProfileApi::searchBuilderWithCriteria($criteria);
					if($users)
					$totalBuilder = count($users);
					$pagesBuilder = new CPagination($totalBuilder);
					$pagesBuilder->pageSize =  Yii::app()->params['resultsPerPage'];
					$pagesBuilder->applyLimit($criteria);
			   
					$users = BuilderProfileApi::searchBuilderWithCriteria($criteria);
				}
				if($_POST['user_type']=="specialist"){
					$totalSpecialists='0';
					$criteria = SpecialistProfileApi::getCriteriaObject($data_user);
					$users = SpecialistProfileApi::searchSpecialistsWithCriteria($criteria);
					if($users)
					$totalSpecialists = count($users);
					$pagesSpecialists = new CPagination($totalSpecialists);
					$pagesSpecialists->pageSize =  Yii::app()->params['resultsPerPage'];
					$pagesSpecialists->applyLimit($criteria);
						
					$users = SpecialistProfileApi::searchSpecialistsWithCriteria($criteria);
				}
			}
			elseif($_POST['mode']=="project"){
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
				$data['city'] = $_POST['GeoCity']['city'];
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
		}
			
		// echo '<br><pre>';var_dump($pages);die();
		$this->render('search',array('pages'=>$pages,'modelState'=>$modelState,'modelProperty'=>$modelProperty,'modelCity'=>$modelCity,'propertyAmenities'=>$propertyAmenities,'modelUser'=>$modelUser,'modelProfile'=>$modelProfile,'modelSpecialistType'=>$modelSpecialistType,'properties'=>$properties,'amenities'=>$amenities,'users'=>$users,'modelProject'=>$modelProject,'projectAmenities'=>$projectAmenities,'projects'=>$projects,'pagesAgent'=>$pagesAgent,'pagesUser'=>$pagesUser,'pagesBuilder'=>$pagesBuilder,'pagesSpecialists'=>$pagesSpecialists,'pagesProject'=>$pagesProject,'propertiesCount'=>$propertiesCount));

		$this->render('search',array('pages'=>$pages,'modelProperty'=>$modelProperty,'modelCity'=>$modelCity,'propertyAmenities'=>$propertyAmenities,'modelUser'=>$modelUser,'modelProfile'=>$modelProfile,'modelSpecialistType'=>$modelSpecialistType,'properties'=>$properties,'amenities'=>$amenities,'users'=>$users,'modelProject'=>$modelProject,'projectAmenities'=>$projectAmenities,'projects'=>$projects,'pagesAgent'=>$pagesAgent,'pagesUser'=>$pagesUser,'pagesBuilder'=>$pagesBuilder,'pagesSpecialists'=>$pagesSpecialists,'pagesProject'=>$pagesProject,'propertiesCount'=>$propertiesCount));


		$this->render('search',array('pages'=>$pages,'modelProperty'=>$modelProperty,'modelCity'=>$modelCity,'propertyAmenities'=>$propertyAmenities,'modelUser'=>$modelUser,'modelProfile'=>$modelProfile,'modelSpecialistType'=>$modelSpecialistType,'properties'=>$properties,'amenities'=>$amenities,'users'=>$users,'modelProject'=>$modelProject,'projectAmenities'=>$projectAmenities,'projects'=>$projects,'pagesAgent'=>$pagesAgent,'pagesUser'=>$pagesUser,'pagesBuilder'=>$pagesBuilder,'pagesSpecialists'=>$pagesSpecialists,'pagesProject'=>$pagesProject,'propertiesCount'=>$propertiesCount));
		Yii::endProfile('search_property_and_people');}

		public function actionAccount(){

			// Check if the user is not a guest. If member then redirect him to the dashboard here.
			// @todo Replace url to Dashboard url
			if(!Yii::app()->user->isGuest){
				$this->redirect('/home');
			}

			// Create a new Front Login Form model.
			$loginModel=new FrontLoginForm;
			$this->performAjaxValidation($loginModel);

			// if it is ajax validation request
			if(isset($_POST['ajax'])) {
				//	var_dump($_POST['ajax']);die();
			}

			if(isset($_POST['ajax']) && $_POST['ajax']==='front-login-form')
			{
				echo CActiveForm::validate($loginModel);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['FrontLoginForm']))
			{
				$loginModel->attributes=$_POST['FrontLoginForm'];
				// validate user input and redirect to the previous page if valid
				if($loginModel->validate() && $loginModel->login())
				$this->redirect(Yii::app()->user->returnUrl);
			}

			/*
			 * This means the user has either come here for the first time or is trying to create
			 * a new account.
			 */
			$credentialsModel = UserApi::populateCredentialsModel(null,'register');
			$profilesModel = UserApi::populateProfilesModel(null,'register');
			require_once(Yii::app()->params["rootDir"].'/library/facebook/src/facebook.php');
			$facebook = new Facebook(array(
		  'appId'  => Yii::app()->params["fbAppId"],
		  'secret' => Yii::app()->params["fbSecret"],
			));

			$this->performAjaxValidation($profilesModel);

			/*
			 * Check if the user has reached this page through a widget.
			 */
			if(isset($_POST['UserCredentials']) && !isset($_POST['UserProfiles'])) {
				$credentialsModel = UserApi::populateCredentialsModel($_POST['UserCredentials'],'register');
				$credentialsModel->validate(array('email_id','password','password_confirm'));
				$profilesModel = UserApi::populateProfilesModel(null,'register');
				//	$this->render('account',array('credentialsModel'=>$credentialsModel,'profilesModel'=>$profilesModel,'login'=>$loginModel));

			} else if(isset($_POST['UserCredentials']) && isset($_POST['UserProfiles'])){
				// save here
				$credentialsModel = UserApi::populateCredentialsModel($_POST['UserCredentials'],'register');
				$credResult = $credentialsModel->validate(array('email_id','password','password_confirm'));

				$profilesModel = UserApi::populateProfilesModel($_POST['UserProfiles'],'register');
				$profResult = $profilesModel->validate(array(
				'first_name','last_name','gender',
				'address_line1','address_line2',
				'country_id','state_id','city_id',
				'zip','phone','alt_phone','agree'
				));

				if($credResult && $profResult){
					$result = true;
					$models = UserApi::createUser($credentialsModel,$profilesModel);

					// Redirect to thanks page.
					// @todo link to success page.
					if($models){
						$data = array();
						$data["user"] = $models['credential']->id;
						EmailApi::sendEmail($credentialsModel->email_id,"REGISTRATION.ACTIVATION",$data);
						$session=new CHttpSession;
						$session->open();
						$session['registration-success']='true';
						$this->redirect(array('/account/thanks','email'=>$models['credential']->email_id));
					}
					//	else
					//		$this->render('account',array('credentialsModel'=>$credentialsModel,'profilesModel'=>$profilesModel,'login'=>$loginModel));
					// save())

				}
			}// else
			$this->render('account',array('credentialsModel'=>$credentialsModel,'profilesModel'=>$profilesModel,'login'=>$loginModel));
		}


		public function actionError()
		{
			if($error=Yii::app()->errorHandler->error)
			{
				if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
				else
				$this->render('error', $error);
			}
		}

		protected function performAjaxValidation($model)
		{
			//	return '{alert(1)}';

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
		public function actionAboutUs()
		{
			$this->render('aboutus');			
		}
		public function actionContactUs()
		{
			$this->render('contactUs');			
		}
		public function actionTerms()
		{
			$this->render('terms');
		}
		public function actionWhyWallFeet()
		{
		$this->render('whywallfeet');	

		}
		public function actionAreaCal()
		{
			$this->renderPartial('areacal');
		}
		public function actionPrice()
		{
			$this->render('price');
		}
}