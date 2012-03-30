<?php

class SpecializationsApi {


	/**
	 * This method gets id from user.
	 * searches the model specializations using id
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param int $id
	 * @return model|false
	 */

	public static function getSpecializationById($Id)
	{
		return Specializations::model()->findByPk($Id);
	}

	/**
	 * This method gets array of data from user.
	 * inserts data to database.
	 * Returns the model for successful insertion.
	 * Returns false if error occurs.
	 *
	 * @param array $data
	 * @return model|false
	 */
	public static function createSpecialization($data)
	{
		$specialist=new Specializations();
		$specialist->attributes=$data;
		$specialist->save();
		return $specialist;
	}
	
	/**
	 * This method gets id and specialist name from user.
	 * searches data using id.
	 * updates the data and returns the model.
	 *
	 * @param int $id,string $specialistName
	 * @return model
	 */
	
	public static function updateSpecialization($id,$specialistName)
	{
		$specialist=Specializations::model()->findByPk($id);
		$specialist->specialist=$specialistName;
		$specialist->save();
		return $specialist;
	}

	/**
	 * This method gets array of data from user.
	 * searches the model specialization.
	 * Returns true for successful deletion of data.
	 * Returns false if not found or due to some error.
	 *
	 * @param int $id
	 * @return model|false
	 */

	public static function deleteSpecializations($specializationIds)
	{
		$result = true;
		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$specializationIds);
		return Specializations::model()->deleteAll($criteria);
	}

	/**
	 * This method gets id from user.
	 * searches the model UserSpecialistProfile using id
	 * Returns true for the successful deletion of data.
	 * Returns false if not found or due to some error.
	 *
	 * @param int $id
	 * @return model|false
	 */

	public static function deleteSpecialization($specializationId)
	{
		return Specializations::model()->deleteByPk($specializationId);
	}
	
	/**
	 * returns specialization list.
	 
	 
	 *
	 * @return model
	 */
	

	public static function getAll()
	{
		$criteria=new CDbCriteria;
		$criteria->select='specialist';
		$specialist=Specializations::model()->findAll($criteria);
		if($specialist)
			return $specialist;
		else
			return false;

	}

}



?>