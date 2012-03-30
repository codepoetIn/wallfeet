<?php

class ProjectRatingApi {
	
	/**
	 * This method accepts project id and get the average rating for that project.
	 * Returns model if success.
	 * Returns false if not successfull.
	 *
	 * @param  string $projectId
	 * @return model || false
	 */
	public static function getRating($projectId) {
		$criteria = new CDbCriteria ();
		$criteria->select = 'avg(rate) AS rate';
		$criteria->condition = 'project_id=:projectId';
		$criteria->params = array (':projectId' => $projectId );
		$avg_rating = ProjectRating::model ()->find ( $criteria );
		if ($avg_rating)
			return $avg_rating->rate;
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
	
	public static function addRating($userId, $projectId, $rate) {
		
		$criteria=new CDbCriteria;
		$criteria->condition='project_id=:projectId AND user_id=:userId';
		$criteria->params=array(':projectId'=>$projectId,':userId'=>$userId);
		$projectRatingCheck=ProjectRating::model()->find($criteria);		
		if($projectRatingCheck)
		{
		self::removeRating($projectId,$userId);
		$projectRating = new ProjectRating ();
		$projectRating->user_id = $userId;
		$projectRating->project_id = $projectId;
		$projectRating->rate = $rate;
		$projectRating->save ();
		
		}
		else
		{
		$projectRating = new ProjectRating ();
		$projectRating->user_id = $userId;
		$projectRating->project_id = $projectId;
		$projectRating->rate = $rate;
		$projectRating->save ();
		
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
	public static function isRated($projectId, $userId) {
		
		$projectrating = ProjectRating::model ()->find ( ('project_id=:projectId AND user_id=:userId'), array (':projectId' => $projectId, ':userId' => $userId ) );
		if ($projectrating != NULL)
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
	public static function removeRating($userId, $projectId) {
		return ProjectRating::model ()->deleteAll ( ('project_id=:projectId AND user_id=:userId'), array (':projectId' => $projectId, ':userId' => $userId ) );
	
	}
}

?>