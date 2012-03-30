<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
//	public $layout='//store/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
		//		'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$credentialsModel=new UserCredentials('register');
		$profilesModel=new UserProfiles();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserCredentials']) && isset($_POST['UserProfiles'])) {
			$data = $_POST;
			$credentialsModel->attributes = $_POST['UserCredentials'];
			$profilesModel->attributes = $_POST['UserProfiles'];
			$data['UserCredentials']['verified_by'] = Yii::app()->user->id;

			$id = UserApi::createUser($credentialsModel, $profilesModel);
			if($id){
				$data["temp_password"] = $credentialsModel->password;
				EmailApi::sendEmail($credentialsModel->email_id,"REGISTRATION.SUCCESS",$data);
				$this->redirect(array('view','id'=>$id['credential']->id));
			}else {
				$credentialsModel->attributes = $data['UserCredentials'];
				$credentialsModel->validate(array('email_id','password','password2','status'));
				$profilesModel->attributes = $data['UserProfiles'];
				$profilesModel->validate(array('first_name','last_name'));
			}
		}

		$this->render('create',array(
			'credentialsModel'=>$credentialsModel,
			'profilesModel'=>$profilesModel,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserCredentials']))
		{
			$model->attributes=$_POST['UserCredentials'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('UserCredentials');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserCredentials('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserCredentials']))
		$model->attributes=$_GET['UserCredentials'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=UserCredentials::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-credentials-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAll()
	{
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM user_credentials');
		$models = UserCredentials::model()->cache(1000, $dependency)->findAll();


		$this->render('all',array(
            'models'=>$models,
		));
	}
}
