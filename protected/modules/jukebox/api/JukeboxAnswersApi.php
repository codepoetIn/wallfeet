<?php


class JukeboxAnswersApi
{
	/**
	 * This method gets userID , Question ID and arrary of data and creates the model
	 * Returns Model if sucessfully created.
	 * Returns the error Validated Model if validation fails
	 *
	 * Data arrary should have the following Hash keys
	 * 1.answer
	 * 2.reference URL
	 * 3.E-mail answer
	 * 4.correct
	 * 5.status
	 *
	 * @param arrary $data,string $userId
	 * @return model ||model with error
	 */
	public static function addJukeboxAnswer($userId,$questionId,$data)
	{

		$jukeboxAnswers = new JukeboxAnswers();
		$jukeboxAnswers->user_id = $userId;
		$jukeboxAnswers->jukebox_question_id = $questionId;
		$jukeboxAnswers->answer=$data->answer;
		$jukeboxAnswers->reference_url=$data->reference_url;
		$jukeboxAnswers->status=0;
		
	
		if($jukeboxAnswers->save()){
			return $jukeboxAnswers;
		}else {
			return false;
		}
	}
	
	/**
	 * This method accepts answer id and Deletes the Record.
	 * Returns 1 if successfully deleted.
	 * Returns 0 if Deletion Fails.
	 *
	 * @param string $answerId.
	 * @return 1 || 0.
	 */
	public static function deleteJukeboxAnswer($answerId)
	{
		return JukeboxAnswers::model()->deleteByPk($answerId);	
	}
	
	/**
	 * This method accepts a question id and Deletes all the answers posted to that question.
	 * Returns 1 if successfully deleted.
	 * Returns 0 if Deletion Fails.
	 *
	 * @param string $questionId.
	 * @return 1 || 0.
	 */
	public static function deleteAllJukeboxAnswers($questionId)
	{
		return JukeboxAnswers::model()->deleteAll(('jukebox_question_id=:questionId'),array(':questionId'=>$questionId));
	}
	
	/**
	 * This methods  accepts answer ID and arrary of data and Updates the model.
	 * Returns model if sucessfully updated.
	 * Returns false if not updated
	 * Returns false if answer ID is not found.
	 *
	 * Data arrary should have the following Hash keys
	 * 1.answer
	 * 2.reference URL
	 * 3.E-mail answer
	 * 4.correct
	 * 5.status
	 *
	 * @param arrary $data,string $answerId.
	 * @return model || false.
	 */
	public static function updateJukeboxAnswer($answerId,$data)
	{

		$jukeboxAnswers = JukeboxAnswers::model()->find('id=:answerId',array(':answerId'=>$answerId));
		if($jukeboxAnswers){
			$jukeboxAnswers->attributes = $data;
			$jukeboxAnswers->save();
			return $jukeboxAnswers;
		}else {
			return false;
		}
	}

	/**
	 * This method accepts Question ID and returns the answers for that question.
	 * returns model if successfull
	 * Returns false if not found. 
	 * 
	 * @param string questionId
	 * @return model || false
	 */
	public static function getJukeboxAnswers($questionId)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='jukebox_question_id=:questionId';
		$criteria->params=array(':questionId'=>$questionId);
		$jukeboxAnswers=JukeboxAnswers::model()->findAll($criteria);
		if($jukeboxAnswers)
		return $jukeboxAnswers;
		else 
		return false;
	}
	
	/**
	 * This method accepts the answer id and returns the answer.  
	 * returns 1 if successfull
	 * returns 0 if not successfull 
	 * 
	 * @param string $answerId
	 * @return 1 || 0.
	 */
	public static function getJukeboxAnswerById($answerId)
	{
		return JukeboxAnswers::model()->findByPk($answerId);
	}
	
	/**
	 * This method accepts the answer ID. 
	 * Returns the correct answer count of the answers whose status is 1. 
	 * 
	 * 
	 * @param string $answerId
	 * @return model.
	 */
	public static function getCorrectAnswerCount($answerId)
	{
		
		$criteria=new CDbCriteria;
		$criteria->condition='jukebox_answer_id=:answerId AND status=:status';
		$criteria->params=array(':answerId'=>$answerId,':status'=>1);
		$correctAnswerCount=JukeboxAnswersAttributes::model()->count($criteria);
		return $correctAnswerCount;
	}
	
	/**
	 * This method accepts the answer ID. 
	 * Returns the correct answer count of the answers whose status is 0. 
	 * 
	 * 
	 * @param string $answerId
	 * @return model.
	 */	
	public static function getWrongAnswerCount($answerId)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='jukebox_answer_id=:answerId AND status=:status';
		$criteria->params=array(':answerId'=>$answerId,':status'=>0);
		$wrongAnswerCount=JukeboxAnswersAttributes::model()->count($criteria);
		return $wrongAnswerCount;
	}
	
	/**
	 * This method accepts the answer Id and user id. 
	 * adds a record by marking status as 1 . 
	 * 
	 * @param string $answerId , $userId
	 * @return model.
	 */
	public static function addCorrectAnswer($answerId,$userId)
	{
		$jukeboxAnswersAttributes = new JukeboxAnswersAttributes();
		$jukeboxAnswersAttributes->user_id = $userId;
		$jukeboxAnswersAttributes->jukebox_answer_id = $answerId;
		$jukeboxAnswersAttributes->status = 1;
		$jukeboxAnswersAttributes->save();
		return $jukeboxAnswersAttributes;
			
	}
	
	/**
	 * This method accepts the answer Id and user id. 
	 * adds a record by marking status as 0 . 
	 * 
	 * @param string $answerId , $userId
	 * @return model.
	 */
	public static function addWrongAnswer($answerId,$userId)
	{
		$jukeboxAnswersAttributes = new JukeboxAnswersAttributes();
		$jukeboxAnswersAttributes->user_id = $userId;
		$jukeboxAnswersAttributes->jukebox_answer_id = $answerId;
		$jukeboxAnswersAttributes->status = 0;
		$jukeboxAnswersAttributes->save();
		return $jukeboxAnswersAttributes;
	}
	
	/**
	 * This method accepts the attributeId. 
	 * changes the status field as 0 . 
	 * 
	 * @param string $attributeId
	 * @return model.
	 */
	public static function undoCorrectAnswer($attributeId)
	{
		$jukeboxAnswersAttributes = JukeboxAnswersAttributes::model()->deleteAll('id=:attributeId',array(':attributeId'=>$attributeId));
			
		return $jukeboxAnswersAttributes;		
	}
	
	/**
	 * This method accepts the attributeId. 
	 * changes the status field as 1 . 
	 * 
	 * @param string $attributeId
	 * @return model.
	 */
	public static function undoWrongAnswer($attributeId)
	{
		$jukeboxAnswersAttributes = JukeboxAnswersAttributes::model()->deleteAll('id=:attributeId',array(':attributeId'=>$attributeId));
		
		return $jukeboxAnswersAttributes;		
	}
	
	/**
	 * This method accepts the questionId and userId. 
	 * retrieves all the answers and the status of if posted by that user . 
	 * 
	 * @param string $questionId,userId
	 * @return model.
	 */
	public static function getAllAttributes($questionId,$userId)
	{
		$jukeboxAnswers=self::getJukeboxAnswers($questionId);
		$result = null;
		if($jukeboxAnswers) {
			foreach($jukeboxAnswers as $answers){
				$jukeboxAnswersAttributes = JukeboxAnswersAttributes::model()->find('jukebox_answer_id=:answerId AND user_id=:userId',array(':answerId'=>$answers->id,':userId'=>$userId));
				if($jukeboxAnswersAttributes)
					$result[$answers->id] =	$jukeboxAnswersAttributes->status;		
			}
			return $result;
		}
		return false;
			
	}
	public static function isUserAnswerRated($userid)
	{
		$count=0;
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userid';
		$criteria->params=array(':userid'=>$userid);
		$result=JukeboxAnswersAttributes::model()->find($criteria);
		if($result)
		$count=count($result);
		if($count==0)
		return true;
			else
		return false;
    }
	public static function userAnswercorrect($answerid)
	{
		
		$result=self::isUserAnswerRated(Yii::app()->user->id);
		if($result=true)
		{
		$criteria=new CDbCriteria;
		$criteria->condition='jukebox_answer_id=:answerId AND user_id=:userid AND status=:status';
		$criteria->params=array(':answerId'=>$answerid,':userid'=>Yii::app()->user->id,':status'=>'1');
		return JukeboxAnswersAttributes::model()->find($criteria);
		}
	}
	public static function userWrongcorrect($answerid)
		{
			$result=self::isUserAnswerRated(Yii::app()->user->id);
			if($result=true)
			{
				$criteria=new CDbCriteria;
				$criteria->condition='jukebox_answer_id=:answerId AND user_id=:userid AND status=:status';
				$criteria->params=array(':answerId'=>$answerid,':userid'=>Yii::app()->user->id,':status'=>'0');
				return JukeboxAnswersAttributes::model()->find($criteria);
			}
		}
	public static function userCorrectAnswers($answersid)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='jukebox_answer_id=:answerid AND user_id=:userid';
        $criteria->params=array('answerid'=>$answersid,'userid'=>Yii::app()->user->id);
        $userAnswers=JukeboxAnswersAttributes::model()->find($criteria);
        return $userAnswers;
	}
}
?>