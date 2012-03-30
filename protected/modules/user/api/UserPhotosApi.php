<?php
class UserPhotosApi{

	public static function getAllImages($UserId){
		$userPhotos = UserPhotos::model()->findAll('user_id=:UserId',array(':UserId'=>$UserId));
		$result = false;
		foreach($userPhotos as $userPhoto){
			$result[] = ImageUtils::getImagesDirectoryUrl('profiles',$UserId).$userPhoto->image;
		}
		return $result;
	}
	
	public static function getPrimaryImageForUsers($userIds){

		$criteria=new CDbCriteria;
		$criteria->addInCondition('user_id',$userIds);

		$models = UserPhotos::model()->findAll($criteria);
		$result = false;;

		foreach($models as $model){
			$result[$model->user_id] = ImageUtils::getImageUrl('profiles',$model->user_id,$model->image);
		}

		return $result;
	}

}