<?php

class SmsQueueApi {

	public static function addToQueue($to,$scenarioName="",$data=""){
		$model = new SmsQueue();
		$model->to = $to;
		$model->attempts=0;
		if($scenarioName){
			$scenario = SmsTemplatesApi::getTemplateByScenario($scenario);
			if($scenario){
				// Change Template Variables here
				$model->sender_id = $scenario->from_email;
				$model->body = $scenario->body;
			}
			else
			return false;
		}elseif($data){
			$model->sender_id = $data["sender_id"];
			$model->body = $data["body"];
		}else {
			return false;
		}

		return $model->save();
	}

	public static function deleteFromQueue($jobId){
		$model = SmsQueue::model()->findByPk($jobId);
		if($model && $model->sent)
		return false;
		else
		return $model->delete();
	}

	public static function updateJob($jobId,$data){
		$model = SmsQueue::model()->findByPk($jobId);
		if($model && $model->sent)
		return false;
		else {
			$model->attributes = $data;
			return $model->save();
		}

	}

	public static function sendSms($jobId){
		$model = SmsQueue::model()->findByPk($jobId);
		if($model && $model->sent)
		return false;
		else{
			// Send SMS Here
		}

	}

}

?>