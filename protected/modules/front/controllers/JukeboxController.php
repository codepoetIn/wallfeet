<?php

class JukeboxController extends FrontController
{
	public function actionIndex()
	{
		Yii::beginProfile('jukebox');

		$totalJukebox='0';
		$criteria = JukeboxQuestionsApi::getCriteriaObjectMyJukebox(Yii::app()->user->id);
		$totalJukebox = JukeboxQuestions::model()->count($criteria);

		$pages = new CPagination($totalJukebox);
		$pages->pageSize =  Yii::app()->params['resultsPerPage'];
		$pages->applyLimit($criteria);
		$questions = JukeboxQuestionsApi::searchMyJukeboxWithCriteria($criteria);

		//$questions= JukeboxQuestionsApi::getAllJukeboxQuestionsOfUser(Yii::app()->user->id);
		$this->render('index',array('questions'=>$questions,'pages'=>$pages,'total'=>$totalJukebox));
		Yii::endProfile('jukebox');
	}

	public function actionPost(){
		Yii::beginProfile('jukebox_post');

		$userId = Yii::app()->user->id;
		$modelJukeboxQuestions = new JukeboxQuestions;
		if(isset($_POST['submit'])){
			$modelJukeboxQuestions->attributes = $_POST['JukeboxQuestions'];
			$modelJukeboxQuestions->user_id = $userId;
			if($modelJukeboxQuestions->validate()){
				$question = JukeboxQuestionsApi::addJukeboxQuestion($userId,$_POST['JukeboxQuestions']);
				if(!$question->hasErrors()){
					$data = array();
					$user = UserApi::getUserById($userId);
					$user ? $data["user"] = $user->id : null;
					$data["jukebox"] = $question->id;
					EmailApi::sendEmail($user->email_id,"ACTIVITY.JUKEBOX.CREATE",$data);
					$this->redirect('/jukebox/'.$question->id);
				}
			}
		}
		$this->render('post',array('modelJukeboxQuestions'=>$modelJukeboxQuestions));

		Yii::endProfile('jukebox_post');
	}

	public function actionSearch()
	{
		Yii::beginProfile('search_jukebox');
		$questions = null;
		$data = null;
		$jukeboxCount='';
		$session=new CHttpSession;
		$session->open();



		$modelJukeboxQuestions = new JukeboxQuestions;
		//$questions = JukeboxQuestionsApi::searchQuestion($data);

		if(isset($_POST['JukeboxMin']) && isset($_POST['JukeboxQuestions']) ){
			$modelJukeboxQuestions->attributes = $_POST['JukeboxQuestions'];
			$data['keyword'] = $_POST['keyword'];

			$criteria = JukeboxQuestionsApi::getCriteriaObject($data);

			$total=JukeboxQuestions::model()->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);

			$questions = JukeboxQuestionsApi::searchJukeboxWithCriteria($criteria);
			$jukeboxCount=$total;

			$session['search-criteria-jukebox'] = $criteria;
			$session['results-page'] = $total;

		}elseif(isset($_POST['submit']) && isset($_POST['JukeboxQuestions'])){
			$modelJukeboxQuestions->attributes = $_POST['JukeboxQuestions'];
			$data = $_POST['JukeboxQuestions'];
			$data['keyword'] = $_POST['keyword'];
			$data['time'] = $_POST['time'];

			$criteria = JukeboxQuestionsApi::getCriteriaObject($data);

			$total=JukeboxQuestions::model()->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);

			$questions = JukeboxQuestionsApi::searchJukeboxWithCriteria($criteria);
			$jukeboxCount=$total;

			$session['search-criteria-jukebox'] = $criteria;
			$session['results-page'] = $total;
		} else {


			if(isset($session['search-criteria-jukebox'])){

				$criteria = $session['search-criteria-jukebox'];
				//$criteria = new CDbCriteria;
			}else {
				$criteria = JukeboxQuestionsApi::getCriteriaObject($data);
			}

			$total=JukeboxQuestions::model()->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = Yii::app()->params['resultsPerPage'];
			$pages->applyLimit($criteria);

			$questions = JukeboxQuestionsApi::searchJukeboxWithCriteria($criteria);
			$jukeboxCount=$total;

		}

		$this->render('search',array('modelJukeboxQuestions'=>$modelJukeboxQuestions,'questions'=>$questions,'pages'=>$pages,'jukeboxCount'=>$jukeboxCount));
		Yii::endProfile('search_jukebox');
	}

	public function actionView($id){
		Yii::beginProfile('jukebox_view');

		if(isset($_GET['attributeidC']))
		{
			JukeboxAnswersApi::undoCorrectAnswer($_GET['attributeidC']);
		}
		if(isset($_GET['attributeidW']))
		{
			JukeboxAnswersApi::undoWrongAnswer($_GET['attributeidW']);
		}

		$jukeboxQuestion='';
		$userProfile='';
		$geoCity='';
		$jukeboxAnswers='';
		$userdata='';
		$jukeboxRating='';
		$juckboxRatingEnable=false;
		$modelJukeboxQuestions =  new JukeboxQuestions;
		$jukeboxNewAnswers=new JukeboxAnswers();

		$jukeboxQuestion=JukeboxQuestionsApi::getJukeboxQuestionById($id);

		$userProfile=UserApi::getUserProfileDetails($jukeboxQuestion->user_id);

		$juckboxRatingReadOnly=JukeboxRatingApi::checkUserRating($jukeboxQuestion->id,Yii::app()->user->id);

		if($userProfile){
			if(!$juckboxRatingReadOnly) {
				if($userProfile->id == Yii::app()->user->id){
					$juckboxRatingReadOnly=true;

				} else {
					$juckboxRatingReadOnly=false;

				}
			} else {
				$juckboxRatingReadOnly=true;
			}
		}

		if($jukeboxQuestion)
		{
			if(isset($_POST['submit']))
			{
				$model=new JukeboxAnswers();
				$model->attributes=$_POST['JukeboxAnswers'];

				$data=JukeboxAnswersApi::addJukeboxAnswer(Yii::app()->user->id,$jukeboxQuestion->id,$model);

				if($data){
					$emailData = array();
					$user = UserApi::getUserById(Yii::app()->user->id);
					$user ? $emailData["user"] = $user->id : null;
					$emailData["answer"] = $data->id;
					EmailApi::sendEmail($user->email_id,"ACTIVITY.JUKEBOX.RESPONSE",$emailData);
				}
					
			}

			$geoCity=GeoCityApi::getCitynameByID($userProfile->city_id);
			$jukeboxAnswers=JukeboxAnswersApi::getJukeboxAnswers($jukeboxQuestion->id);
			if($jukeboxAnswers)
			{
				foreach ($jukeboxAnswers as $answers)
				{
					$jukeboxAnswersID[]=$answers->user_id;

				}
					
				$criteria = new CDbCriteria;
				$criteria->addInCondition('user_id',$jukeboxAnswersID);
				$users = UserProfiles::model()->findAll($criteria);
				$user_data = '';
				foreach($users  as $user){
					$userdata[$user->user_id] = $user->first_name;
				}

			}
			$jukeboxRating=JukeboxRatingApi::getRating($jukeboxQuestion->id);

		} else	{
			$jukeboxQuestion->question="No Questions have been posted by user";
			$jukeboxQuestion->description='';
			$jukeboxQuestion->id='';

		}

		$this->render('view',array('modelJukeboxQuestions'=>$modelJukeboxQuestions,'jukeboxNewAnswers'=>$jukeboxNewAnswers,'jukeboxQuestion'=>$jukeboxQuestion,'userProfile'=>$userProfile,'geoCity'=>$geoCity,'jukeboxAnswers'=>$jukeboxAnswers,'userdata'=>$userdata,'jukeboxRating'=>$jukeboxRating,'juckboxRatingReadOnly'=>$juckboxRatingReadOnly));

		Yii::endProfile('jukebox_view');
	}
	public function actionStarRatingAjax($userid,$question_id) {

		$ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
		JukeboxRatingApi::addRating($question_id,$userid,$ratingAjax);
		echo 'Your Rating is '.$ratingAjax;

	}
	public function actionAnswerWrongRating($answerid,$questionId)
	{

		if(JukeboxAnswersApi::userWrongcorrect($answerid,$questionId))
		{
			$jukeboxAttribute=JukeboxAnswersApi::userWrongcorrect($answerid);
			echo JukeboxAnswersApi::getWrongAnswerCount($answerid).CHtml::link(' undo',array('/jukebox/'.$questionId.'?attributeidW='.$jukeboxAttribute->id.''),array('class'=>'red'));
		}
		else
		{
			JukeboxAnswersApi::addWrongAnswer($answerid,Yii::app()->user->id);
			$jukeboxAttribute=JukeboxAnswersApi::userWrongcorrect($answerid,Yii::app()->user->id);
			echo JukeboxAnswersApi::getWrongAnswerCount($answerid).CHtml::link(' undo',array('/jukebox/'.$questionId.'?attributeidW='.$jukeboxAttribute->id.''),array('class'=>'red'));
		}


	}

	public function actionAnswerCorrectRating($answerid,$questionId)
	{


		if(JukeboxAnswersApi::userAnswercorrect($answerid,$questionId))
		{

			$jukeboxAttribute=JukeboxAnswersApi::userAnswercorrect($answerid);
			echo JukeboxAnswersApi::getCorrectAnswerCount($answerid).CHtml::link(' undo',array('/jukebox/'.$questionId.'?attributeidC='.$jukeboxAttribute->id.''),array('class'=>'red'));
		}
		else
		{
			JukeboxAnswersApi::addCorrectAnswer($answerid,Yii::app()->user->id);
			$jukeboxAttribute=JukeboxAnswersApi::userAnswercorrect($answerid,Yii::app()->user->id);
			echo JukeboxAnswersApi::getCorrectAnswerCount($answerid).CHtml::link(' undo',array('/jukebox/'.$questionId.'?attributeidC='.$jukeboxAttribute->id.''),array('class'=>'red'));
		}
	}

	public function actionDelete($id){

		if(Yii::app()->user->isGuest)
		throw new CHttpException(403,'You are not authorized.');

		$jukebox = JukeboxQuestionsApi::getJukeboxQuestionById($id);

		if($jukebox->user_id!==Yii::app()->user->id)
		throw new CHttpException(403,'You are not authorized.');

		if(JukeboxQuestionsApi::deleteJukeboxQuestionById($id)){
			Yii::app()->user->setFlash('success','The question was removed successfully');
		}else {
			Yii::app()->user->setFlash('error','The question could not be removed. Please contact the admin.');
		}
		$this->redirect('/jukebox');

	}
}