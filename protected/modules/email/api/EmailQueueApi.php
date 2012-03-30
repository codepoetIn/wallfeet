<?php

class EmailQueueApi {

	public static function addToQueue($to,$cc,$bcc,$scenarioName="",$data=""){
		$model = new EmailQueue();
		$model->to = $to;
		$model->cc = $cc;
		$model->bcc = $bcc;
		$model->attempts=0;
		if($scenarioName){
			$scenario = EmailTemplatesApi::getTemplateByScenario($scenario);
			if($scenario){
				// Change Template Variables here
				$model->from_email = $scenario->from_email;
				$model->from_name = $scenario->from_name;
				$model->subject = $scenario->subject;
				$model->body_html = $scenario->body_html;
				$model->body_plain = $scenario->body_plain;
			}
		}elseif($data){
			$model->from_email = $data["from_email"];
			$model->from_name = $data["from_name"];
			$model->subject = $data["subject"];
			$model->body_html = $data["body_html"];
			$model->body_plain = $data["body_plain"];
		}else {
			return false;
		}

		return $model->save();
	}

	public static function deleteFromQueue($jobId){
		$model = EmailQueue::model()->findByPk($jobId);
		if($model && $model->sent)
		return false;
		else
		return $model->delete();
	}

	public static function updateJob($jobId,$data){
		$model = EmailQueue::model()->findByPk($jobId);
		if($model && $model->sent)
		return false;
		else {
			$model->attributes = $data;
			return $model->save();
		}

	}

	public static function sendEmail($jobId){
		$model = EmailQueue::model()->findByPk($jobId);
		if($model && $model->sent)
		return false;
		else{
			// Send Email Here
		}

	}

}

?>