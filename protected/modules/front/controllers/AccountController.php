
<?php
class AccountController extends FrontController
{

	public function actionIndex() {
			
		$userId=Yii::app()->user->id;

		$projectImages='';
		$propertyImages='';
		$projectCount='';
		$propertyCount='';
		$propertyTypes='';
		$propertyLocations='';
		$propertyid='';
		$projectLocations='';
		$projectOwnerships='';
		$projectTypes='';
		$users='';
		$userIds[]='';
		$myJukeBox='';
		$jukeBoxcategoryName='';
		$jukecount='0';
		$propertyWishList='';
		$propertyName='';
		$projectWishlist='';
		$projectName='';
		$propertywishlistcount=0;

		$inbox=PmbApi::getInbox($userId);
		$userName=UserApi::getUserProfileDetails($userId);
		if($inbox)
		{
			foreach($inbox as $messages){
				$userIds[] = $messages->from_user_id;
			}
			$users=DbUtils::getDbValues(new UserProfiles,'user_id',$userIds,'first_name');
		}
		$properties=PropertyApi::getPropertiesOfUser($userId,Yii::app()->params['dashboardResultsPerPage']);
		$countUnread=PmbApi::getUnreadInboxCount($userId);
		$propertyCount=PropertyApi::getAllPropertiesCount($userId);
		$locations='';
		if($properties)
		{
			foreach($properties as $location){
				$locations[] = $location->city_id;
			}
			$propertyLocations=DbUtils::getDbValues(new GeoCity,'id',$locations,'city');
		}
		if($properties)
		{
			foreach($properties as $property){
				$propertyTypes[] = $property->property_type_id;
				$propertyid[]=$property->id;
			}
			$propertyImages=PropertyImagesApi::getPrimaryImageForProperties($propertyid);
			$propertyTypes=DbUtils::getDbValues(new PropertyTypes,'id',$propertyTypes,'property_type');
		}
			
		$projects=ProjectApi::getProjectsOfUser($userId,Yii::app()->params['dashboardResultsPerPage']);
		if($projects)
		{
			foreach($projects as $project){
				$projectLocationIds[] = $project->city_id;
				$projectTypeIds[] = $project->project_type_id;
				$projectOwnershipIds[]=$project->ownership_type_id;
				$projectIds[]=$project->id;
			}
			$projectImages=ProjectImagesApi::getPrimaryImageForProjects($projectIds);
			$projectLocations=DbUtils::getDbValues(new GeoCity,'id',$projectLocationIds,'city');
			$projectTypes=DbUtils::getDbValues(new ProjectTypes,'id',$projectTypeIds,'project_type');
			$projectOwnerships=DbUtils::getDbValues(new CategoryOwnershipTypes,'id',$projectOwnershipIds,'ownership_type');
		}

		$projectCount=ProjectApi::getProjectsofUserCount($userId);
			
		$isProfile['agent']=AgentProfileApi::isAgent($userId);
		$isProfile['builder']=BuilderProfileApi::isBuilder($userId);
		$isProfile['specialist']=SpecialistProfileApi::isSpecialist($userId);

		//MyJuckbox
		$myJukeBox=JukeboxQuestionsApi::getAllJukeboxQuestionsOfUser($userId,Yii::app()->params['dashboardResultsPerPage']);
		if($myJukeBox)
		{
			foreach($myJukeBox as $jukeBox)
			{
				$categoryIdArray[]=$jukeBox->category_id;
			}
			$jukeBoxcategoryName=DbUtils::getDbValues(new JukeboxCategory,'id',$categoryIdArray,'category');
			$jukecount=count($myJukeBox);
		}
		//my wishlists
		$propertyWishList=PropertyWishlistApi::getWishlist($userId,Yii::app()->params['dashboardResultsPerPage']);
		if($propertyWishList)
		{
			foreach($propertyWishList as $propertyWish)
			{
				$propertyWishlistArray[]=$propertyWish->property_id;
			}
			$propertyName=DbUtils::getDbValues(new Property,'id',$propertyWishlistArray,'property_name');
		}
		$propertywishlistcount=PropertyWishlistApi::getWishlistCount($userId);

		$totalWishlistCount=$propertywishlistcount; //+$projectwishlistcount;

		//requirements
		$requirements=RequirementApi::getRequirementByUserId($userId,Yii::app()->params['dashboardResultsPerPage']);
		if($requirements)
		$requirementscount=count($requirements);
		else
		$requirementscount=0;



		$this->render('index',array('inbox'=>$inbox,'users'=>$users,'properties'=>$properties,'countUnread'=>$countUnread,'propertyLocations'=>$propertyLocations,'propertyTypes'=>$propertyTypes,'projects'=>$projects,'projectLocations'=>$projectLocations,'projectTypes'=>$projectTypes,'projectOwnerships'=>$projectOwnerships,'propertyCount'=>$propertyCount,'projectCount'=>$projectCount,'propertyid'=>$propertyid,'propertyImages'=>$propertyImages,'projectImages'=>$projectImages,'isProfile'=>$isProfile,'myJukeBox'=>$myJukeBox,'jukeBoxcategoryName'=>$jukeBoxcategoryName,'jukecount'=>$jukecount,'propertyWishList'=>$propertyWishList,'propertyName'=>$propertyName,
		/*'projectWishlist'=>$projectWishlist,*/'projectName'=>$projectName,'totalWishlistCount'=>$totalWishlistCount,'requirements'=>$requirements,'requirementscount'=>$requirementscount,'userName'=>$userName));
	}

	public function actionProfile($id){


		Yii::beginProfile('account_profile');
		$userProfile = UserApi::getUser($id);
		if(!$userProfile){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		$userProfile = UserApi::getUserProfileDetails($id);
		$userAddress=DbUtils::getAddress($userProfile->city_id);
		$userImages=UserPhotosApi::getAllImages($id);
		$agentAddress="";
		$agentImage="";
		$agentProfile = AgentProfileApi::getAgentDetails($id);
		if($agentProfile)
		{
			$agentAddress=DbUtils::getAddress($agentProfile->city_id);
			$agentImage=AgentProfileApi::getImage($id);
		}
		$builderAddress="";
		$builderImage="";
		$builderProfile=BuilderProfileApi::getBuilderDetails($id);
		if($builderProfile)
		{
			$builderAddress=DbUtils::getAddress($builderProfile->city_id);
			$builderImage=BuilderProfileApi::getImage($id);
		}
		$specialistAddress="";
		$specialistImage="";
		$specialistProfile=SpecialistProfileApi::getSpecialistDetails($id);
		$specialistProjects = "";
		if($specialistProfile){
			$specialistAddress=DbUtils::getAddress($specialistProfile->city_id);
			$specialistImage=SpecialistProfileApi::getImage($id);
			$specialistProjects = SpecialistApi::getSpecialistProjects($id);
		}

		$this->render('profile',array('userProfile'=>$userProfile,'userAddress'=>$userAddress,'userImages'=>$userImages,'agentProfile'=>$agentProfile,'agentAddress'=>$agentAddress,'builderProfile'=>$builderProfile,'builderAddress'=>$builderAddress,'specialistProfile'=>$specialistProfile,'specialistAddress'=>$specialistAddress,'specialistProjects'=>$specialistProjects,'agentImage'=>$agentImage,'builderImage'=>$builderImage,'specialistImage'=>$specialistImage));
		Yii::endProfile('account_profile');

	}

	public function actionThanks($email){
		$this->render('thanks');
	}

	public function actionActivate($code,$email){
		$result = UserApi::activateCode($code,$email);
		if($result==true){
			$data = array();
			$user = UserApi::getUserByEmail($email);
			$user ? $data["user"] = $user->id : null;
			EmailApi::sendEmail($email,"REGISTRATION.SUCCESS",$data);
		}
		$this->render('activate',array('result'=>$result));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('/');
	}

	public function actionLogin($message=''){

		if($message)
		Yii::app()->user->setFlash('error','You must login to continue.');

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
			if($loginModel->validate() && $loginModel->login()) {
				$dashboardUrl = Yii::app()->createUrl('/dashboard');

				Yii::app()->user->setFlash('success',"Hi there! You have successfully logged in. Please continue to your <a href='$dashboardUrl'>Dashboard</a> to see what we have for you");
				$this->redirect(Yii::app()->user->returnUrl);
			} else {
				Yii::app()->user->setFlash('error','Please correct the errors below.');
			}
		}

		$this->render('login',array('login'=>$loginModel));
	}

	public function actionUpdate()
	{

		$userId=Yii::app()->user->id;
		$profilesModel=UserApi::getUserProfileDetails($userId);
		//$credentialsModel=UserApi::getUserCredentials($userId);

		$this->performAjaxValidation(array($profilesModel));

		if(isset($_POST['ajax']) && $_POST['ajax']==='update-form')
		{
			echo CActiveForm::validate(array($profilesModel));
			Yii::app()->end();
		}
		if(isset($_POST['UserProfiles'])){
			// save here
			$profilesModel = UserApi::populateProfilesModel($_POST['UserProfiles'],'update');
			$profResult = $profilesModel->validate(array(
				'first_name','last_name','gender',
				'address_line1','address_line2',
				'country_id','state_id','city_id',
				'zip','mobile','telephone','agree, verifyCode'
				));

				if($profResult){
					$result = true;
					$models = UserApi::updateUser($profilesModel,$userId);

					if($models){
						Yii::app()->user->setFlash('success',
						"Your Account Has been Updated");
						$this->redirect('/dashboard');
					}

				}
		}
		$this->render('update',array('profilesModel'=>$profilesModel));
	}

	public function actionRegister(){
		
		if(!Yii::app()->user->isGuest){
			$this->redirect('/home');
		}
		
		$credentialsModel = UserApi::populateCredentialsModel(null,'register');
		$profilesModel = UserApi::populateProfilesModel(null,'register');
		/*require_once(Yii::app()->params["rootDir"].'/library/facebook/src/facebook.php');
		 $facebook = new Facebook(array(
		 'appId'  => Yii::app()->params["fbAppId"],
		 'secret' => Yii::app()->params["fbSecret"],
		 ));*/

		$this->performAjaxValidation(array($credentialsModel,$profilesModel));
		//$this->performAjaxValidation($profilesModel);

		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate(array($credentialsModel,$profilesModel));
			//echo CActiveForm::validate($profilesModel);
			Yii::app()->end();
		}

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
				'zip','mobile','telephone','agree, verifyCode'
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
						$resendUrl = Yii::app()->createUrl('/account/resendEmail');
						Yii::app()->user->setFlash('success',
						"Thanks for registering. We have sent you an email with activation information.
						<br/> Please add " . Yii::app()->params['adminEmail'] ." to your whitelist. 
						If you have not received the email click here to <a href='$resendUrl'>resend</a>.");
						$this->redirect('/home');
					}
					//	else
					//		$this->render('account',array('credentialsModel'=>$credentialsModel,'profilesModel'=>$profilesModel,'login'=>$loginModel));
					// save())

				}
		}// else
		$this->render('register',array('credentialsModel'=>$credentialsModel,
									  'profilesModel'=>$profilesModel));


	}

	public function actionResendEmail(){

		if(!Yii::app()->user->isGuest){
			$this->redirect('/home');
		}

		$model = new ResendEmailForm;

		if( isset($_POST) && isset($_POST['ResendEmailForm']) ){
			$model->attributes = $_POST['ResendEmailForm'];
			if($model->validate()){
				// Resend Email here and redirect
				$user = UserCredentials::model()->find('email_id=:email',array(':email'=>$model->email));
				if($user){
					$data['user'] = $user->id;
					EmailApi::sendEmail($model->email,"REGISTRATION.ACTIVATION",$data);
					Yii::app()->user->setFlash('success',
					"We have sent you an email with activation information. 
					<br/> Please add " . Yii::app()->params['adminEmail'] ." to your whitelist."
					);
					$this->redirect('/home');
				}
			}
		}

		$this->render('resendEmail',array('model'=>$model));
	}

	public function actionPassword(){

		$model = new ChangePasswordForm;
		$model->id = Yii::app()->user->id;

		if( isset($_POST) && isset($_POST['ChangePasswordForm']) ){
			$model->attributes = $_POST['ChangePasswordForm'];
			if($model->validate()){
				// Generate Password here and redirect
				$tempPass = $model->newPassword;
				$user = UserCredentials::model()->findByPk(Yii::app()->user->id);
				if($user){
					$user->salt = SecurityUtils::generateSalt($user->email_id);
					$user->password = SecurityUtils::encryptPassword($tempPass,$user->salt);
					if($user->save()){
						Yii::app()->user->setFlash('success',
						"Your password has been modified."
						);
						$this->redirect('/dashboard');
					}
				}
			}
		}

		$this->render('password',array('model'=>$model));
	}
	public function actionSettings()
	{
		$notificationId=NotificationLabelApi::userNotification(Yii::app()->user->id);
		if(isset($_POST['email'])&&isset($_POST['notification']))
		{
			if(NotificationLabelApi::addNotification($_POST['notification'],Yii::app()->user->id))
			{
				Yii::app()->user->setFlash('success',"User Notification setting has been Updated ");
				$this->redirect('/settings');
			}
			else
			Yii::app()->user->setFlash('error',"User Notification setting not Updated. Please Retry ");
		}
		$this->render('settings',array('notificationId'=>$notificationId));
	}
	public function actionForgotPassword(){

		if(!Yii::app()->user->isGuest){
			$this->redirect('/home');
		}

		$model = new ForgotPasswordForm;

		if( isset($_POST) && isset($_POST['ForgotPasswordForm']) ){
			$model->attributes = $_POST['ForgotPasswordForm'];
			if($model->validate()){
				// Generate Password here and redirect
				$tempPass = SecurityUtils::generateRandomString(8);
				$user = UserCredentials::model()->find('email_id=:email',array(':email'=>$model->email));
				if($user){
					$user->salt = SecurityUtils::generateSalt($user->email_id);
					$user->password = SecurityUtils::encryptPassword($tempPass,$user->salt);
					if($user->save()){
						$data['temp_password'] = $tempPass;
						$data['user'] = $user->id;
						EmailApi::sendEmail($model->email,"ACCOUNT.RESET.PASSWORD",$data);
						Yii::app()->user->setFlash('success',
						"We have sent you a new password to your email.
						<br/> Please add " . Yii::app()->params['adminEmail'] ." to your whitelist."
						);
						$this->redirect('/home');
					}
				}
			}
		}

		$this->render('forgotPassword',array('model'=>$model));
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
}
?>