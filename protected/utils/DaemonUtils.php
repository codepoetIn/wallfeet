<?php
class DaemonUtils {

	public static function checkForSync($type,$status="RUNNING",$before=600){
		$criteria = new CDbCriteria();
		$criteria->condition = 'type=:type AND status=:status';
		$criteria->params = array(':type'=>$type,':status'=>$status);
		$criteria->order = "id DESC";
		$running = DaemonJobs::model()->find($criteria);
		if($running && (time() - CDateTimeParser::parse($running->start_time,'yyyy-MM-dd HH:mm:ss') < $before)){
			return false;
		}else {
			return true;
		}
	}

	public static function addJob($type,$status="RUNNING"){
		$job = new DaemonJobs();
		$job->type = $type;
		$job->start_time = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',time());
		$job->status = $status;
		$job->save();
		return $job;
	}

	public static function endJob($job,$message,$status="COMPLETED"){
		$job->message = $message;
		$job->status = $status;
		$job->end_time = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',time());
		$job->save();
		return $job;
	}

	public static function closeJobForSync($type,$message='A previous job is still running. Shutting down to prevent synchronizing issues.',$status="ERROR"){
		$job = new DaemonJobs();
		$job->start_time = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',time());
		$job->type = $type;
		$job->message = $message;
		$job->status = $status;
		$job->end_time = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',time());
		$job->save();
		return $job;
	}


}


?>