<?php
class NotificationLabelApi 
{
	public static function addNotification($ids,$userId)
	{
		
		$count=0;
		$remove=self::RemoveNotification($userId);
		$notificationLabel=NotificationLabel::model()->findAll();
		$count=count($notificationLabel);
			foreach($notificationLabel as $notification)
			{
					$userSetting=new UserSettings;
					$userSetting->user_id=$userId;
					$userSetting->notification_label_id=$notification->id;
					if(in_array($notification->id,$ids,true))
					$userSetting->value=1;
					else
					$userSetting->value=0;
					$userSetting->save();
			}
		return true;
	
	}
	public static function userNotification($userId)
	{
	
		$userSetting =UserSettings::model()->findAll('user_id=:userId AND value=:value',array(':userId'=>$userId,':value'=>1));
		if($userSetting)
		{
			foreach ($userSetting as $setting)
			{
			$id[]= $setting->notification_label_id;
			}
			return $id;
		}
		
	}
	public static function RemoveNotification($userId)
		{
			return UserSettings::model()->deleteAll(('user_id=:userId'),array(':userId'=>$userId));
			 	
		}
}