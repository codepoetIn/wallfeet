<?php

class PropertyRatingApi {
	
	/**
	 * This method accepts property id and get the average rating for that property.
	 * Returns model if success. 
	 * Returns false if not successfull.
	 * 
	 * @param  string $propertyId
	 * @return model || false
	 */
	public static function getRating($propertyId)
	{
		$criteria=new CDbCriteria;
		$criteria->select='avg(rate) AS rate';
		$criteria->condition='property_id=:propertyId';
		$criteria->params=array(':propertyId'=>$propertyId);
		$property_rating=PropertyRating::model()->find($criteria);
		if($property_rating)
		return $property_rating->rate;
		else 
		return false;
	}

	/**
	 * This method accepts property id , user id and rate and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $user_id,$propertyId,$rate
	 * @return model || model with errors
	 */
	public static function addRating($propertyId,$userId,$rate)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='property_id=:propertyId AND user_id=:userId';
		$criteria->params=array(':propertyId'=>$propertyId,':userId'=>$userId);
		$propertyRatingCheck=PropertyRating::model()->find($criteria);		
		if($propertyRatingCheck)
		{
		self::removeRating($propertyId,$userId);
		$property_rating = new PropertyRating();
		$property_rating->user_id = $userId;
		$property_rating->property_id = $propertyId;
		$property_rating->rate=$rate;
		$property_rating->save();
		return $property_rating;
		}
		else
		{
		$property_rating = new PropertyRating();
		$property_rating->user_id = $userId;
		$property_rating->property_id = $propertyId;
		$property_rating->rate=$rate;
		$property_rating->save();
		return $property_rating;
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
	public static function isRated($propertyId, $userId) {
		
		$propertyrating = PropertyRating::model ()->find ( ('property_id=:propertyId AND user_id=:userId'), array (':propertyId' => $propertyId, ':userId' => $userId ) );
		if ($propertyrating != NULL)
			return true;
		
		else
			
			return false;
	}
	/**
	 * This method accepts user id, property id and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $propertyId
	 * @param string $user_Id
	 * @return true || false
	 */
	public static function removeRating($propertyId,$userId)
	{
		return PropertyRating::model()->deleteAll(('property_id=:propertyId AND user_id=:userId'),array(':propertyId'=>$propertyId,':userId'=>$userId));
		 	
	}
}

?>