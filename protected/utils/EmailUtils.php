<?php

class EmailUtils {

/*	public static function sendActivationMail($userId,$cc="",$bcc=""){
		$model = EmailTemplateApi::getTemplateByScenario("REGISTRATION.ACTIVATION");
		$user = UserApi::getUser($userId);
		if($model && $user){
			$data["verification_link"] = SecurityUtils::getVerificationLink($user["activation_code"]);
			$data["username"] = $user["first_name"];
			$htmlEmail = self::changeTemplate($data,$model->body_html);
			$plainEmail = self::changeTemplate($data,$model->body_plain);
			$emailData["from_email"] = $model->from_email;
			$emailData["from_name"] = $model->from_name;
			$emailData["subject"] = $model->subject;
			$emailData["body_html"] = $htmlEmail;
			$emailData["body_plain"] = $plainEmail;
			return EmailQueueApi::addToQueue($user["email_id"],$cc,$bcc,"",$emailData);
		}

		return false;
	}*/

	public static function sendEmail($scenario,$userId="",$messageId="",$tempPassword="",$cc="",$bcc=""){
		$model = EmailTemplateApi::getTemplateByScenario($scenario);

		if($userId)
		$user = UserApi::getUser($userId);

		if($user){
			$data["verification_link"] = SecurityUtils::getVerificationLink($user["activation_code"]);
			$data["email_id"] = $user["email_id"];
			$data["name"] = UserApi::getNameByUserId($userId);
		}
		
		if($tempPassword){
			$data["temp_password"] = $tempPassword;
		}
		
		if($messageId){
			$message = PmbApi::loadMessage($messageId);
		}
		
		if($message){
			$data["message_subject"] = $message->subject;		
			$data["message_content"] = $message->content;
			$data["message_from"] = UserApi::getNameByUserId($message->from_user_id);
		}

		if($model){
			$htmlEmail = self::changeTemplate($data,$model->body_html);
			$plainEmail = self::changeTemplate($data,$model->body_plain);

			$emailData["from_email"] = $model->from_email;
			$emailData["from_name"] = $model->from_name;
			$emailData["subject"] = $model->subject;
			$emailData["body_html"] = $htmlEmail;
			$emailData["body_plain"] = $plainEmail;
			return EmailQueueApi::addToQueue($user["email_id"],$cc,$bcc,"",$emailData);
		}

		return false;
	}

	public static function changeTemplate($data,$body){
		foreach($data as $pattern=>$value){
			$body = preg_replace("/\{$pattern\}/",$value,$body);
		}
		return $body;
	}


}



?>