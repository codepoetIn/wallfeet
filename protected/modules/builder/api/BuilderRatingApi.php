
<?php

class BuilderRatingApi {
	
	/**
	 * This method accepts builder id and get the average rating for that builder.
	 * Returns model if success. 
	 * Returns false if not successfull.
	 * 
	 * @param  string $builderId
	 * @return model || false
	 */
	public static function getRating($builderId)
	{
		$criteria=new CDbCriteria;
		$criteria->select='avg(rate) AS rate';
		$criteria->condition='builder_id=:builderId';
		$criteria->params=array(':builderId'=>$builderId);
		$builder_rating=UserBuilderRating::model()->find($criteria);
		if($builder_rating)
		return (int)$builder_rating->rate;
		else 
		return false;
	}

	/**
	 * This method accepts builder id , user id and rate and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $user_id,$builderId,$rate
	 * @return model || model with errors
	 */
	public static function addRating($builderId,$userId,$rate)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='builder_id=:builderId AND user_id=:userId';
		$criteria->params=array(':builderId'=>$builderId,':userId'=>$userId);
		$builderRatingCheck=UserBuilderRating::model()->find($criteria);		
		if($builderRatingCheck)
		{
		self::removeRating($builderId,$userId);
		$builder_rating = new UserBuilderRating();
		$builder_rating->user_id = $userId;
		$builder_rating->builder_id = $builderId;
		$builder_rating->rate=$rate;
		$builder_rating->save();
		return $builder_rating;
		}
		else
		{
		$builder_rating = new UserBuilderRating();
		$builder_rating->user_id = $userId;
		$builder_rating->builder_id = $builderId;
		$builder_rating->rate=$rate;
		$builder_rating->save();
		return $builder_rating;
		}
	}
	/**
	 * This method accepts user id, builder id and checks if it is rated.
	 * Returns true if it is rated. 
	 * Returns false if it is not.
	 * 
	 * @param string $builderId
	 * @param string $user_Id
	 * @return true || false
	 */
	public static function isRated($builderId, $userId) {
		
		$builderrating = UserBuilderRating::model ()->find ( ('builder_id=:builderId AND user_id=:userId'), array (':builderId' => $builderId, ':userId' => $userId ) );
		if ($builderrating != NULL)
			return true;
		
		else
			
			return false;
	}
	/**
	 * This method accepts user id, builder id and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $builderId
	 * @param string $user_Id
	 * @return true || false
	 */
	public static function removeRating($builderId,$userId)
	{
		return UserBuilderRating::model()->deleteAll(('builder_id=:builderId AND user_id=:userId'),array(':builderId'=>$builderId,':userId'=>$userId));
		 	
	}
}

?>