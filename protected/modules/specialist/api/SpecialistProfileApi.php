<?php

class SpecialistProfileApi {

	/**
	 * This method gets userid from user.
	 * searches the model UserSpecialistProfile using id
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param int $userId
	 * @return model|null
	 */
	public static function getCriteriaObject($data)
	{
		$criteria = new CDbCriteria;
		$criteria->alias = 'uc';
		$criteria->join = 'LEFT JOIN user_specialist_profile up on uc.id=up.user_id LEFT JOIN user_specialist_locations l on l.specialist_id=up.id';
		$condition = null;
		$params = null;
		if(isset($data['country_id']) && $data['country_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.country_id=:country_id';
			$params[':country_id'] = $data['country_id'];
		}
		if (isset ( $data ['state_id'] ) && $data ['state_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'up.state_id=:state_id';
			$params [':state_id'] = $data ['state_id'];
		}
		if (isset ( $data ['city_id'] ) && $data ['city_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(up.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
			
			$condition .= ' || ';
			$condition .= 'l.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
			$condition .= ' ) ';
		}
		if (isset ( $data ['keyword'] ) && $data ['keyword'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(up.company_description like :keyword || up.company_name like :keyword || up.address_line1 like :keyword || up.address_line2 like :keyword || uc.email_id like :keyword)';
			$params [':keyword'] = '%' . $data ['keyword'] . '%';
		}

		if($data['user_type']=="specialist" && isset($data['specialist_type_id']) && $data['specialist_type_id']!=null && $data['specialist_type_id']!=""){

			$criteria->join.=' LEFT JOIN user_specialist_type ust on ust.user_id=uc.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$specialistTypes = $data['specialist_type_id'];
			foreach($specialistTypes as $i=>$specialistType){
				if($i!=0)
				$condition.=' || ';
				$condition.='ust.specialist_type_id='.$specialistType;
			}
			$condition.= ')';
		}
		if($condition!='')
		$condition.=' && ';
		if($data['user_type']=="specialist"){
			$condition.='uc.id IN (SELECT user_id FROM user_specialist_profile)';
		}

		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		return $criteria;
	}
	public static function searchSpecialistsWithCriteria($criteria)
	{
		$users = UserCredentials::model()->findAll($criteria);

		return $users;
	}

	public static function getSpecialistDetails($userId) {
		$criteria = new CDbCriteria;
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		return UserSpecialistProfile::model ()->find ( $criteria );
	}

	public static function getSpecialistProfileById($specialistId){
		return UserSpecialistProfile::model()->findByPk($specialistId);
	}

	/**
	 * This method gets id from user.
	 * searches the model UserSpecialistProfile using id
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param int $id
	 * @return model|null
	 */
	public static function getProfileById($id)
	{
		return UserSpecialistProfile::model()->findByPk($id);
		//return $spcialist;
	}

	/**
	 * This method gets email id from user.
	 * searches the model specializations using id
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param int $id
	 * @return model|false
	 */


	public static function getSpecializationsByUserId($userId)
	{
		$result = Specializations::model()->findAllBySql("SELECT specialist FROM specializations WHERE id IN
                                          (SELECT specialist_type_id FROM user_specialist_type WHERE user_id=:b)",
		array(':b'=>$userId));
		if($result)
		return $result;
		else
		false;
	}

	public static function searchSpecialists($data){
		$criteria = new CDbCriteria;
		$criteria->alias = 'uc';
		$criteria->join = 'LEFT JOIN user_profiles up on uc.id=up.user_id';
		$condition = null;
		$params = null;
		if(isset($data['country_id']) && $data['country_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.country_id=:country_id';
			$params[':country_id'] = $data['country_id'];
		}
		if(isset($data['state_id']) && $data['state_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.state_id=:state_id';
			$params[':state_id'] = $data['state_id'];
		}
		if(isset($data['city_id']) && $data['city_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.city_id=:city_id';
			$params[':city_id'] = $data['city_id'];
		}
		if(isset($data['keyword']) && $data['keyword']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= '(up.first_name like :keyword || up.last_name like :keyword || up.gender like :keyword || up.address_line1 like :keyword || up.address_line2 like :keyword || uc.email_id like :keyword)';
			$params[':keyword'] = '%'.$data['keyword'].'%';
		}

		if($data['user_type']=="specialist" && isset($data['specialist_type_id']) && $data['specialist_type_id']!=null){

			$criteria->join.=' LEFT JOIN user_specialist_type ust on ust.user_id=uc.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$specialistTypes = $data['specialist_type_id'];
			foreach($specialistTypes as $i=>$specialistType){
				if($i!=0)
				$condition.=' || ';
				$condition.='ust.specialist_type_id='.$specialistType;
			}
			$condition.= ')';
		}
		if($condition!='')
		$condition.=' && ';
		if($data['user_type']=="specialist"){
			$condition.='uc.id IN (SELECT user_id FROM user_specialist_profile)';
		}

		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		$users = UserCredentials::model()->findAll($criteria);

		return $users;
	}

	/**
	 * This method gets user id from user.
	 * searches the model UserSpecialistProfile using id
	 * Returns the true if found.
	 * Returns false if not found.
	 *
	 * @param int $userid
	 * @return true|false
	 */

	public static function isSpecialist($userId)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId';
		$criteria->params=array(':userId'=>$userId);
		if(UserSpecialistProfile::model()->find($criteria))
		return true;
		else
		return false;

	}



	/**
	 * This method gets id and array of data of the user to update the profile.
	 * search for the profile using id, if exists update the data.
	 * Returns false if search unsuccessful.
	 * Data array should have following hash keys
	 *   	1. user id
	 *   	2. specialist type id
	 3.	company name
	 4.	contact person name
	 5. company description
	 6. address
	 7. country id
	 8. state id
	 9. city id
	 10. mobile no.
	 11.Telephone no.
	 12.email id
	 13.image

	 *
	 * @param int $id,array $data
	 * @return model|false
	 */
	// Change
	public static function updateProfileByUserId($userId,$data)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId';
		$criteria->params=array(':userId'=>$userId);
		$specialist=UserSpecialistProfile::model()->find($criteria);
		if($specialist){
			$specialist->attributes=$data;
			$specialist->save();
			return $specialist;
		} else {
			return false;
		}
	}


	/**
	 * This method Accepts user id and Deletes the Record.
	 * ****Returns True if successfully deleted.
	 * ****Returns false if Deletion Fails
	 *
	 * @param int id.
	 * @return true|false.
	 */

	public static function deleteProfileByUserId($userId)
	{
		return UserSpecialistProfile::model()->deleteAll('user_id=:userId',array(':userId'=>$userId));
	}


	/**
	 * This method Accepts user ID and array of data from user.
	 * creates the model.
	 * returns model.
	 * * Data array should have following hash keys
	 *   	1. specialist type id
	 2.	company name
	 3.	contact person name
	 4. company description
	 5. address
	 6. country id
	 7. state id
	 8. city id
	 9. mobile no.
	 10.Telephone no.
	 11.email id
	 12.image

	 *
	 * @param int userId,array data.
	 * @return model
	 */

	public static function createSpecialistProfile($userId,$data)
	{
		$specialist=new UserSpecialistProfile();
		$specialist->user_id=$userId;
		$specialist->attributes=$data;
		$specialist->save();
		return $specialist;
	}


	/**
	 * This method gets Specialization Id or Specialization Name from user.
	 * checks whether user has inserted atleast one data.
	 * performs a query to retrieve data.
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param int $specializationId,String $specializationName
	 * @return true(model|false)|false
	 */

	public static function getSpecialists($specializationId="",$specializationName="")
	{
		if($specializationId||$specializationName)
		{
			if($model = UserSpecialistProfile::model()->findAllBySql("SELECT * FROM user_specialist_profile WHERE user_id IN (SELECT user_id FROM user_specialist_type WHERE specialist_type_id=:a || specialist_type_id IN (SELECT id FROM specializations WHERE specialist=:b)", array(':a'=>$specializationId,':b'=>$specializationName)))
			return $model;
			else
			return false;
		}
		else
		return false;
	}


	/**
	 * This method Accepts ID and Delets the Record.
	 * ****Returns True if successfully deleted.
	 * ****Returns false if Deletion Fails
	 *
	 * @param int id.
	 * @return true|false
	 */
	public static function deleteSpecialistProfile($Id)
	{
		return UserSpecialistProfile::model()->deleteByPk($Id);
	}

	/**
	 * This method gets id and array of data of the user to update the profile.
	 * search for the profile using id, if exists update the data.
	 * Returns false if search unsuccessful.
	 * Data array should have following hash keys
	 *   1. user id
	 *   2. specialist type id
	 3.	company name
	 4.	contact person name
	 5. company description
	 6. address
	 7. country id
	 8. state id
	 9. city id
	 10. mobile no.
	 11.Telephone no.
	 12.email id
	 13.image

	 *
	 * @param int $id,array $data
	 * @return model|false
	 */
	public static function updateProfileById($Id,$data)
	{
		$specialist=UserSpecialistProfile::model()->findByPk($Id);
		if($specialist){
			$specialist->attributes=$data;
			$specialist->save();
			return $specialist;
		} else {
			return false;
		}
	}

	public static function addImage($userId,$image){	
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory($userId).$destinationFileName;
		$success = Yii::app()->s3->upload($image , $destinationFile, Yii::app()->params['s3BucketName']);
		if($success){
			return $destinationFileName;
		}else {
			return false;
		}
	}

	public static function getImage($userId){
		$model = UserSpecialistProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		$result = ImageUtils::getDefaultImage ( 'specialists' );
		if ($model && $model->image) {
			$result = ImageUtils::getImageUrl ( 'specialists', $userId, $model->image );
		}
		return $result;
	}


	public static function deleteImage($userId) {
		$model = UserSpecialistProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		if ($model){
			$image = $model->image;
			$imageFile = self::getImagesDirectory($userId).$image;
			$success = Yii::app ()->s3->deleteObject ( Yii::app ()->params ['s3BucketName'], $imageFile );
			if ($success)
			return true;
			else
			return false;
		}
		return false;
	}

	public static function getImagesDirectory($userId){
		return Yii::app()->params['s3SpecialistImagesFolderName'].$userId.'/';
	}


}

