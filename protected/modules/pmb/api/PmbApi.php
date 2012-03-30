<?php

class PmbApi {
	public static function getInboxCriteria($userId,$count=""){
		$criteria = new CDbCriteria();
		$criteria->condition = "to_user_id=:to_user_id AND inbox_active=:inbox_active";
		$criteria->params = array(":to_user_id"=>$userId,":inbox_active"=>"1");
		$criteria->order = "created_time DESC";
		if($count)
			$criteria->limit = $count;
		
		return $criteria;
	}

	public static function getInbox($userId,$count=""){
		
		$criteria = new CDbCriteria();
		$criteria->condition = "to_user_id=:to_user_id AND inbox_active=:inbox_active";
		$criteria->params = array(":to_user_id"=>$userId,":inbox_active"=>"1");
		$criteria->order = "created_time DESC";
		if($count)
			$criteria->limit = $count;
		$result = PmbMessages::model()->findAll($criteria);
		if($result)
			return $result;
		return false;
	}

	public static function getSentCriteria($userId,$count=""){
		$criteria = new CDbCriteria();
		$criteria->condition = "from_user_id=:from_user_id AND sent_active=:sent_active";
		$criteria->params = array(":from_user_id"=>$userId,":sent_active"=>"1");
		$criteria->order = "created_time DESC";
		if($count)
			$criteria->limit = $count;
		
		return $criteria;
	}
	
	public static function getSentItems($userId,$count=""){
		$criteria = new CDbCriteria();
		$criteria->condition = "from_user_id=:from_user_id AND sent_active=:sent_active";
		$criteria->params = array(":from_user_id"=>$userId,":sent_active"=>"1");
		$criteria->order = "created_time DESC";
		if($count)
		$criteria->limit = $count;
		$result = PmbMessages::model()->findAll($criteria);
		if($result)
		return $result;
		return false;

	}
	public static function getReadInbox($userId,$count=""){
			$criteria = new CDbCriteria();
			$criteria->condition = "to_user_id=:to_user_id AND inbox_unread=:inbox_unread AND inbox_active=:inbox_active";
			$criteria->params = array(":to_user_id"=>$userId,"inbox_unread"=>'0',":inbox_active"=>"1");
			$criteria->order = "created_time DESC";
			if($count)
			$criteria->limit = $count;
			$result = PmbMessages::model()->findAll($criteria);
			if($result)
			return $result;
			return false;
		}
	
	public static function getUnreadInbox($userId,$count=""){
		$criteria = new CDbCriteria();
		$criteria->condition = "to_user_id=:to_user_id AND inbox_unread=:inbox_unread AND inbox_active=:inbox_active";
		$criteria->params = array(":to_user_id"=>$userId,"inbox_unread"=>'1',":inbox_active"=>"1");
		$criteria->order = "created_time DESC";
		if($count)
		$criteria->limit = $count;
		$result = PmbMessages::model()->findAll($criteria);
		if($result)
		return $result;
		return false;
	}
	public static function getUnreadInboxCount($userId)
	{
		$count=self::getUnreadInbox($userId);		
		if($count)
		return count($count);	
		else
		return 0;
	}

	public static function sendMessage($fromUserId,$toUserId,$data){
		$pmbMessage = new PmbMessages();
		$pmbMessage->from_user_id = $fromUserId;
		$pmbMessage->to_user_id = $toUserId;
		$pmbMessage->inbox_unread = "1";
		$pmbMessage->inbox_active = "1";
		$pmbMessage->sent_active= "1";
		$pmbMessage->attributes = $data;
		$pmbMessage->save();
		return $pmbMessage;

	}

	public static function markRead($messageIds){
		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$messageIds);
		$updateValue = array("inbox_unread"=>"0");
		$result = PmbMessages::model()->updateAll($updateValue,$criteria);
		return $result;
	}

	public static function loadMessage($messageId){
		return PmbMessages::model()->findByPk($messageId);
	}

	public static function deleteFromInbox($messageId){
		$model = PmbMessages::model()->findByPk($messageId);
		if($model){
			$model->inbox_active="0";
			return $model->save();
		}
		else
		return false;
	}

	public static function deleteFromSent($messageId){
		$model = PmbMessages::model()->findByPk($messageId);
		if($model){
			$model->sent_active="0";
			return $model->save();
		}
		else
		return false;
	}
	
	public static function getMessageById($id){
		return PmbMessages::model()->findByPk($id);
	}
}


?>