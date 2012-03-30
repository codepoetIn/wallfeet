<?php


class SpecialistApi {

		

	/**
	 * This method gets id from user.
	 * searches the model UserSpecialistProfile using id
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param int $specialistid
	 * @return model|false
	 */

	public static function getSpecialistProjects($specialistId)
	{
		$criteria=new CDbCriteria;
		//$criteria->select='project_name';
		$cirteria->condition='specialist_type_id=:specialistId';
		$criteria->params=array(':specialistId'=>$specialistId);
		$specialist=UserSpecialistProjects::model()->findAll($criteria);
		if($specialist)
		return $specialist;
		else
		return false;
	}

	/**
	 * This method gets user id,specialist type id and array of data of the user to create new project data.
	 * insert data into database and returns true if successful
	 * Returns false if insertion unsuccessful.
	 * Data array should have following hash keys
		1.user id
		2.project name
		3.description
		4.image
		5.duration
	 *
	 * @param int $specialistid,array $data
	 * @return model|false
	 */

	public static function addSpecialistProjects($userId,$specialistTypeId,$projectsData)
	{
		$result = true;
		foreach($projectsData as $data){
			$specialist=new UserSpecialistProjects();
			$specialist->user_id=$userId;
			$specialist->specialist_type_id=$specialistId;
			$specialist->attributes=$data;
			$result = $result && $specialist->save();
		}

		return $result;
	}
	public static function isSpecialist($userId) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$userSpecialistProfile = UserSpecialistProfile::model ()->find ( $criteria );
		if ($userSpecialistProfile != NULL)
		return true;
		else
		return false;
	}

	/**
	 * This method gets id from user.
	 * delete the model, returns 1 if successful else returns 0
	 *
	 * @param int $id
	 * @return 1|0
	 */

	public static function deleteSpecialistProjectsById($id)
	{
		return UserSpecialistProjects::model()->deleteByPk($Id);
	}

	/**
	 * This method gets userId and specialist type id from user.
	 * delete the model, returns 1 if successful else returns 0
	 *
	 * @param int $userId,$specialistTypeId
	 * @return 1|0
	 */

	// change
	public static function deleteAllSpecialistProjects($userId,$specialistTypeId)

	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId AND specialist_type_id=:specialistTypeId';
		$criteria->params=array(':userId'=>$userId,':specialistTypeId'=>$specialistTypeId);
		//$criteria->addInCondition('specialist_type_id',$specialistTypeId);
		return UserSpecialistProjects::model()->deleteAll($criteria);
	}

	/**
	 * This method gets Id and array of data from user.
	 * update the model,if exists.
	 * * Data array should have following hash keys
		1.user id
		2.project name
		3.description
		4.image
		5.duration
	 *
	 * @param int $Id,array $data
	 * @return model|false
	 */


	public static function updateProject($id,$data){
		$model=UserSpecialistProjects::model()->findByPk($id);
		if($model)
		{
			$model->attributes=$data;
			$model->save();
			return $model;
		}
		else
		return false;
	}

	public static function getSpecialistProjectsByUserId($userId) {
		$criteria = new CDbCriteria ();
		$criteria->distinct = true;
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$projects = UserSpecialistProjects::model ()->findAll ( $criteria );
		if ($projects)
		return $projects;
		else
		return false;
	}

	public static function addImage($userId,$image){
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory($userId).$destinationFileName;
		$success = Yii::app()->s3->upload($image,$destinationFile, Yii::app()->params['s3BucketName']);		
		if($success){
			return $destinationFileName;
		}else {
			return false;
		}
	}

	public static function getImage($userId){
		$model = UserSpecialistProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		$result = ImageUtils::getDefaultImage('specialists');
		if ($model && $model->image) {
			$result = ImageUtils::getImageUrl ( 'specialists', $userId, $model->image );
		}
		return $result;
	}

	public static function deleteImage($userId) {
		$model = UserSpecialistProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		if ($model) {
			$image = $model->image;
			$imageFile = self::getImagesDirectory ( $userId ) . $image;
			$success = Yii::app ()->s3->deleteObject ( Yii::app ()->params ['s3BucketName'], $imageFile );
			if ($success)
			return true;
			else
			return false;
		}
		return false;
	}

	public static function getImagesDirectory($userId) {
		return Yii::app ()->params ['s3SpecialistsImagesFolderName'] . $userId . '/';
	}


}