<?php

class JukeboxRatingApi
{
	/**
	 * This method accepts question id and get the average rating for that question.
	 * Returns model if success.
	 * Returns the error validated model if validation fails.
	 *
	 *
	 * @param  string $questionId
	 * @return model || model with errors
	 */
	public static function getRating($questionId)
	{
		$criteria=new CDbCriteria;
		$criteria->select='avg(rate) AS rate';
		$criteria->condition='question_id=:questionId';
		$criteria->params=array(':questionId'=>$questionId);
		$avgRating=JukeboxRating::model()->find($criteria);
		if ($avgRating)
			return (int)$avgRating->rate;
		else
			return false;
	}

	/**
	 * This method accepts question id , user id and rate and adds the record.
	 * Returns model if successfully created.
	 * Returns the error validated model if validation fails.
	 *
	 * @param string $useId,$questionId,$rate
	 * @return model || model with errors
	 */
	public static function checkUserRating($questionId,$userId)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='question_id=:questionId AND user_id=:userId';
		$criteria->params=array(':questionId'=>$questionId,':userId'=>$userId);
		$juckboxRatingCheck=JukeboxRating::model()->find($criteria);
		return $juckboxRatingCheck;
	}
	
	public static function addRating($questionId,$userId,$rate)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='question_id=:questionId AND user_id=:userId';
		$criteria->params=array(':questionId'=>$questionId,':userId'=>$userId);
		$juckboxRatingCheck=JukeboxRating::model()->find($criteria);
		if($juckboxRatingCheck)
		{
			self::removeRating($questionId,$userId);
			$jukeboxRating = new JukeboxRating();
			$jukeboxRating->user_id = $userId;
			$jukeboxRating->question_id = $questionId;
			$jukeboxRating->rate=$rate;
			$jukeboxRating->save();
		}
		else
		{
			$jukeboxRating = new JukeboxRating();
			$jukeboxRating->user_id = $userId;
			$jukeboxRating->question_id = $questionId;
			$jukeboxRating->rate=$rate;
			$jukeboxRating->save();
		}

	}

	/**
	 * This method accepts user id,questionid and deletes the record.
	 * Returns 1 if successfully deleted.
	 * Returns 0 if deletion fails.
	 *
	 * @param string $questionId
	 * @param string $userId
	 * @return 1 || 0
	 */
	public static function removeRating($questionId,$userId)
	{
	 return JukeboxRating::model()->deleteAll(('question_id=:questionId AND user_id=:userId'),array(':questionId'=>$questionId,':userId'=>$userId));
	}



}