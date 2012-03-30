<?php
class RequirementApi {
	/**
	 * This method gets userId and array of data from user. 
	 * Returns model if creation successful
	 * Returns null if creation fails
	 ** Data arrary should have the following Hash keys
		    	*  string $i_want_to
 				*  string $description
 				*  double $covered_area_from
 				*  double $covered_area_to
			  	*  double $plot_area_from
 				*  double $plot_area_to
 				*  double $min_price
 				*  double $max_price
 	 *
	 * @param int $userId,array $data
	 * @return model|false
	 */
	
	public static function createRequirement($userId,$data){
		$requirement = new Requirement;
		$requirement->attributes=$data;
		$requirement->user_id=$userId;
		$requirement->save();
		return $requirement;
	}
	
	/**
	 * This method gets userId from user. 
	 * Returns number greater than 0 if deletion successful
	 * Returns 0 if deletion fails
	 
	 * @param int $userId
	 * @return >0|0
	 */
	
	
	public static function deleteRequirementByUserId($userId)
	{
		return Requirement::model()->deleteAll('user_id=:userId',array(':userId'=>$userId));
	}
	
	public static function deleteRequirementById($id)
	{
		return Requirement::model()->deleteByPk($id);
	}
	
	/**
	 * This method gets userId from user. 
	 * Returns model if search successful
	 * Returns false if search fails
	
	 * @param int $userId
	 * @return model|false
	 */
	public static function getCriteriaObjectForUser($userId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		return $criteria;
		
	}
	public static function searchMyRequirementWithCriteria($criteria)
	{
		$requirement=Requirement::model()->findAll($criteria);
		if($requirement)
			return $requirement;
		else
			return false;
	}
	public static function getRequirementByUserId($userId,$count='')
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		if($count)
		$criteria->limit = $count;
		
		$requirement=Requirement::model()->findAll($criteria);
		if($requirement)
			return $requirement;
		else
			return false;
	}
	
	/**
	 * This method gets userId and array of data from user. 
	 * Returns model if creation successful
	 * Returns null if creation fails
	
	 * @param int $userId,array $data
	 * @return 
	 */
	
	
	public static function getRequirementById($Id)
	{
		return Requirement::model()->findByPk($Id);
	}
	//doubt
	/*
	//public static function searchRequirementById($Id);
	
	//public static function search($data);
	*/
	
	/**
	 * This method gets userId and array of data from user. 
	 * Returns model if update successful
	 * Returns null if creation fails
	 ** Data arrary should have the following Hash keys
		    	*  string $i_want_to
 				*  string $description
 				*  double $covered_area_from
 				*  double $covered_area_to
			  	*  double $plot_area_from
 				*  double $plot_area_to
 				*  double $min_price
 				*  double $max_price
 	 *
	 * @param int $userId,array $data
	 * @return model|false
	 */
	
	public static function updateRequirement($userId,$data)
	{
		$specialist=Requirement::model()->find('user_id=:userId',array(':userId'=>$userId));
		if($specialist)
		{
			$specialist->attributes=$data;
			$specialist->save();
			return $specialist;
		}
		else
			return false;
	}
	
	
}
?>