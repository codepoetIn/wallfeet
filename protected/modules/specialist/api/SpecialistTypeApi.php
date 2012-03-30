<?php


class SpecialistTypeApi {
	
	/**
	 * This method Accepts user ID and specialist type id from user.
	 * creates a model.
	 * return 1 for successful insertion else returns 0.
	 * 	 *
	 * @param int user id,array specialistTypeId.
	 * @return model.
	 */
	
	public static function create($userId,$specialistTypeId)
	{
		$model=new UserSpecialistType();
		$model->user_id=$userId;
		$model->specialist_type_id=$specialistTypeId;
		$model->save();
		return $model;
	}
	
	public static function createSpecialistTypes($userId, $specialistTypeIds) {
		
		$result = true;
		foreach ( $specialistTypeIds as $specialistTypeId ) {
			$specialistType = new UserSpecialistType ();
			$specialistType->user_id = $userId;
			$specialistType->specialist_type_id  = $specialistTypeId;
			$result = $result && $specialistType->save ();
		}
		
		return $result;
	}
	
	/**
	 * This method Accepts user ID.
	 * return 1 for successful deletion else returns 0.
	 * 	 *
	 * @param int user userid.
	 * @return 1|0.
	 */
	
	
	public static function delete($userId)
	{
		return UserSpecialistType::model()->deleteAll('user_id=:userId',array(':userId'=>$userId));
	}
	
	/**
	 * This method Accepts user ID from user.
	 * performs query.
	 * return model for successful find else returns false.
	 * 	 *
	 * @param int user id,array specialistTypeId.
	 * @return model|false.
	 */
	
	public static function getSpecialistTypeByUserId($userId=null)
	{
		if($userId)
		{
		$result = Specializations::model()->findAllBySql("SELECT id,specialist FROM specializations WHERE id IN
                                          (SELECT specialist_type_id FROM user_specialist_type WHERE user_id=:b)",
		array(':b'=>$userId));
		}
		else
		{
		$result = Specializations::model()->findAllBySql("SELECT id,specialist FROM specializations WHERE id IN
                                          (SELECT specialist_type_id FROM user_specialist_type)");
		}
		if($result)
		return $result;
		else
		false;
	}
}