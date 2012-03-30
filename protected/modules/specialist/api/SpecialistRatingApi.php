<?php

class SpecialistRatingApi {
	
	
	/**
	 * This method accepts user id and get the average rating for that specialist.
	 * Returns model if success.
	 * Returns false if not successfull.
	 *
	 * @param  string $userId
	 * @return model || false
	 */
	public static function getRating($userId) {
		$criteria = new CDbCriteria ();
		$criteria->select = 'avg(rate) AS rate';
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$avg_rating = UserSpecialistRating::model ()->find ( $criteria );
		if ($avg_rating)
			return (int)$avg_rating->rate;
		else
			return false;
	
	}
	
	/**
	 * This method accepts a userId,projectId and rate to add a particular rate for a particular projectId and userId.
	 * Returns model if successfully created.
	 * Returns the error validated model if validation fails.
	 *
	 *
	 * @param string $projectId,$user_id,$rate
	 * @return model
	 */
	
	public static function addRating($userId, $specialistId, $rate) {
		
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId AND specialist_id=:specialistId';
		$criteria->params=array(':specialistId'=>$specialistId,':userId'=>$userId);
		$specialistRating=UserSpecialistRating::model()->find($criteria);		
		if($specialistRating)
		{
		self::removeRating($specialistId,$userId);
		$specialistRating = new UserSpecialistRating ();
		$specialistRating->user_id = $userId;
		$specialistRating->specialist_id = $specialistId;
		$specialistRating->rate = $rate;
		$specialistRating->save ();
		
		}
		else
		{
		$specialistRating = new UserSpecialistRating ();
		$specialistRating->user_id = $userId;
		$specialistRating->specialist_id = $specialistId;
		$specialistRating->rate = $rate;
		$specialistRating->save ();
		
		}
	}
		/**
	 * This method accepts user id, property id and checks if it is rated.
	 * Returns true if it is rated. 
	 * Returns false if it is not.
	 * 
	 * @param string $propertyId
	 * @param string $user_Id
	 * @return true || false
	 */
	public static function isRated($specialistId, $userId) {
		
		$specialistRating = UserSpecialistRating::model ()->find ( ('specialist_id=:specialistId AND user_id=:userId'), array (':specialistId' => $specialistId, ':userId' => $userId ) );
		if ($specialistRating != NULL)
			return true;
		
		else
			
			return false;
	
	}
	/**
	 * This method accepts projectId,userId and deletes the record.
	 * Returns 1 if successfully deleted.
	 * Returns 0 if deletion fails.
	 *
	 * @param string $projectId
	 * @param string $userId
	 *
	 * @return integer
	 */
	public static function removeRating($userId, $specialistId) {
		return UserSpecialistRating::model ()->deleteAll ( ('specialist_id=:specialistId AND user_id=:userId'), array (':specialistId' => $specialistId, ':userId' => $userId ) );
	
	}
}

?>