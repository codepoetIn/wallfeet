<?php

class AgentRatingApi {
	
	/**
	 * This method accepts user id and get the average rating for Agent.
	 * Returns model if success. 
	 * Returns false if not successfull.
	 * 
	 * @param  string $agentId
	 * @return model || false
	 */
	public static function getRating($agentId)
	{
		$criteria=new CDbCriteria;
		$criteria->select='avg(rate) AS rate';
		$criteria->condition='agent_id=:agentId';
		$criteria->params=array(':agentId'=>$agentId);
		$agent_rating=UserAgentRating::model()->find($criteria);
		if($agent_rating)
		return (int)$agent_rating->rate;
		else 
		return false;
	}

	/**
	 * This method accepts agent id , user id and rate and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $user_id,$propertyId,$rate
	 * @return model || model with errors
	 */
	public static function addRating($agentId,$userId,$rate)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='agent_id=:agentId AND user_id=:userId';
		$criteria->params=array(':agentId'=>$agentId,':userId'=>$userId);
		$agentRatingCheck=UserAgentRating::model()->find($criteria);		
		if($agentRatingCheck)
		{
		self::removeRating($agentId,$userId);
		$agent_rating = new UserAgentRating();
		$agent_rating->user_id = $userId;
		$agent_rating->agent_id = $agentId;
		$agent_rating->rate=$rate;
		$agent_rating->save();
		return $agent_rating;
		}
		else
		{
		$agent_rating = new UserAgentRating();
		$agent_rating->user_id = $userId;
		$agent_rating->agent_id = $agentId;
		$agent_rating->rate=$rate;
		$agent_rating->save();
		return $agent_rating;
		}
	}
	/**
	 * This method accepts user id, agent id and checks if it is rated.
	 * Returns true if it is rated. 
	 * Returns false if it is not.
	 * 
	 * @param string $agentId
	 * @param string $user_Id
	 * @return true || false
	 */
public static function isRated($agentId, $userId) {
		
		$agentRating = UserAgentRating::model ()->find ( ('agent_id=:agentId AND user_id=:userId'), array (':agentId' => $agentId, ':userId' => $userId ) );
		if ($agentRating != NULL)
			return true;
		
		else
			
			return false;
	}
	/**
	 * This method accepts user id, agent id and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $agentId
	 * @param string $user_Id
	 * @return true || false
	 */
	public static function removeRating($agentId,$userId)
	{
		return UserAgentRating::model()->deleteAll(('agent_id=:agentId AND user_id=:userId'),array(':agentId'=>$agentId,':userId'=>$userId));
		 	
	}
}

?>