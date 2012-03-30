<?php

class EmailApi {


	private static $_smtp;

	/* This is a static function to initialize default value for From Email */
	static function getSmtp(){

		if(!self::$_smtp){

			require_once('Mail.php');
			require_once('Mail/mime.php');

			$host = Yii::app()->params["smtpHostName"];
			$username = Yii::app()->params["smtpUserName"];
			$password = Yii::app()->params["smtpPassword"];

			self::$_smtp = Mail::factory('smtp',
			array ('host' => $host,
     				'auth' => true,
     				'username' => $username,
     				'password' => $password,
					'persist'  => true,

			));
		}

		return self::$_smtp;
	}
	public static function userEmailPermission($to,$scenario)
	{

		$userModel=UserApi::getUserByEmail($to);
		$sql="SELECT * FROM user_settings where user_id=$userModel->id and value=0 and notification_label_id=(select id from notification_label where label='$scenario')";
		$userSettings=Yii::app ()->db->createCommand ( $sql )->queryAll ();
		$count=count($userSettings);
		echo $count;
		if($count==0)
		return true;
		else
		return false;

	}
	public static function sendEmail($to,$scenario,$data="",$cc="",$bcc=""){

		$permission=self::userEmailPermission($to,$scenario);
		if($permission)
		{
			$model = EmailTemplateApi::getTemplateByScenario($scenario);
			$template = array();
			if($model){
				$template["home_link"] = Yii::app()->createAbsoluteUrl('/');
				$template["signin_link"] = Yii::app()->createAbsoluteUrl('/account');
				$template["logo_link"] = Yii::app()->createAbsoluteUrl('/').Yii::app()->theme->baseUrl .'/images/logo-newsletter.jpg';

				if($data) {
					if(is_array($data)){
						foreach($data as $key=>$value){
							if($key=="user") {
								$user = UserApi::getUser($value);
								if($user){
									$template["verification_link"] = SecurityUtils::getVerificationLink($user["activation_code"],$user["email_id"]);
									$template["email_id"] = $user["email_id"];
									$template["name"] = UserApi::getNameByUserId($value);
								}
								continue;
							}
							else if($key=="temp_password") {
								$template["temp_password"] = $value;
								continue;
							}
							else if($key=="message") {
								$message = PmbApi::loadMessage($value);
								if($message){
									$template["message_subject"] = $message->subject;
									$template["message_content"] = $message->content;
									$template["message_body"] = $message->content;
									$template["message_from"] = UserApi::getNameByUserId($message->from_user_id);
								}
								continue;
							}
							else if($key=="property") {
								$property =PropertyApi::getPropertyById($value);
								if($property){
									$template["property_name"] = $property->property_name;
									$template["property_description"] = $property->description;
									$template["property_type"] = PropertyTypesApi::getPropertyTypeById($property->property_type_id);
									$template["property_rating"] = PropertyRatingApi::getRating($property->id);
								}
								continue;
							}
							else if($key=="project") {
								$project =ProjectApi::getProjectById($value);
								if($project){
									$template["project_name"] = $project->project_name;
									$template["project_description"] = $project->description;
									$template["project_type"] = ProjectTypesApi::getProjectTypeById($project->project_type_id);
									$template["project_rating"] = ProjectRatingApi::getRating($project->id);
								}
								continue;
							}
							else if($key=="jukebox") {

								$jukebox = JukeboxQuestionsApi::getJukeboxQuestionById($value);
								if($jukebox){
									$template["jukebox_question"] = $jukebox->question;
									$template["jukebox_category"] = JukeboxCategoryApi::getJukeboxCategoryById($jukebox->category_id)->category;
									$template["jukebox_rating"] = JukeboxRatingApi::getRating($value);
								}
								continue;
							}
							else if($key=="answer") {
								$jukeboxAnswer = JukeboxAnswersApi::getJukeboxAnswerById($value);

								if($jukeboxAnswer){
									$template["jukebox_response"] = $jukeboxAnswer->answer;
									$template["jukebox_response_from"] = UserApi::getNameByUserId($jukeboxAnswer->user_id);
									$template["jukebox_question"] = $jukeboxAnswer->jukeboxQuestion->question;
									$template["jukebox_category"] = JukeboxCategoryApi::getJukeboxCategoryById($jukeboxAnswer->jukeboxQuestion->category_id)->category;
									$template["jukebox_rating"] = JukeboxRatingApi::getRating($jukeboxAnswer->jukeboxQuestion->id);
								}
								continue;
							}
							else if($key=="builder") {
								$builder = BuilderProfileApi::getBuilderProfileById($value);
								if($builder){
									$template["builder_company_name"] = $builder->company_name;
									$template["builder_company_description"] = $builder->company_description;
									$template["builder_rating"] = BuilderRatingApi::getRating($value);
								}
								continue;
							}
							else if($key=="agent") {
								$agent = AgentProfileApi::getAgentProfileById($value);
								if($agent){
									$template["agent_company_name"] = $agent->company_name;
									$template["agent_company_description"] = $agent->company_description;
									$template["agent_rating"] = AgentRatingApi::getRating($value);
								}
								continue;
							}
							else if($key=="specialist") {
								$specialist = SpecialistProfileApi::getSpecialistProfileById($value);
								if($specialist){
									$template["specialist_company_name"] = $specialist->company_name;
									$template["specialist_company_description"] = $specialist->company_description;
									$template["specialist_rating"] = SpecialistRatingApi::getRating($specialist->user_id);
								}
								continue;
							}
						}

					}
				}

				$htmlEmail = self::changeTemplate($template,$model->body_html);
				$plainEmail = self::changeTemplate($template,$model->body_plain);
				$emailData["from_email"] = $model->from_email;
				$emailData["from_name"] = $model->from_name;
				$emailData["subject"] = self::changeTemplate($template,$model->subject);
				$emailData["body_html"] = $htmlEmail;
				$emailData["body_plain"] = $plainEmail;
				return EmailQueueApi::addToQueue($to,$cc,$bcc,"",$emailData);
			}
		}
		return false;
	}

	public static function changeTemplate($template,$body){
		foreach($template as $pattern=>$value){
			$body = preg_replace("/\{$pattern\}/",$value,$body);
		}
		return $body;
	}

	public static function sendSmtpEmail($email){

		require_once('Mail.php');
		require_once('Mail/mime.php');

		$crlf = "\n";
		$mime = new Mail_mime($crlf);
		$mime->setHTMLBody($email->body_html);

		$body = $mime->get();

		$smtpHeaders = array ('From' => $email->from_email,
   			'To' => $email->to,
			'Cc' => $email->cc,
			'Bcc' => $email->bcc,
   			'Subject' => $email->subject);


		$smtp = self::getSmtp();
		$smtpHeaders = $mime->headers($smtpHeaders);
		$mail = $smtp->send($email->to, $smtpHeaders, $body);

		if (PEAR::isError($mail)) {
			echo $mail->getMessage();
			return $mail->getMessage();
		} else {
			return 1;
		}

	}

	public static function sendSmtpEmails($emails){

		require_once('Mail.php');
		require_once('Mail/mime.php');

		$smtpHeaders = array();
		foreach($emails as $email){
			$smtpHeaders[] = array ('From' => $email->from_email,
   			'To' => $email->to,
			'Cc' => $email->cc,
			'Bcc' => $email->bcc,
   			'Subject' => $email->subject);
		}


		$smtp = self::getSmtp();
		foreach($smtpHeaders as $smtpHeader){
			$crlf = "\n";
			$mime = new Mail_mime($crlf);
			$mime->setHTMLBody($email->body_html);

			$body = $mime->get();
			
			$headers = $mime->headers($smtpHeader);
			$mail = $smtp->send($email->to, $headers, $body);
			if (PEAR::isError($mail)) {
				$email->message = $mail->getMessage();
			} else {
				$email->sent = 1;
			}
			$email->save();
		}

	}

}



?>