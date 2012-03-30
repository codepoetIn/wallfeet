<?php
class JukeboxQuestionsApi
{
	/**
	 * This method accepts user's id and an array of data and creates the model.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * data array should have the following hash keys- 
	 * 1. question
	 * 2. description
	 * 3. category_id
	 * 4. email_answer
	 * 
	 * @param array $data,string $userId
	 * @return model || model with errors
	 */
	public static function addJukeboxQuestion($userId,$data)
	{
		$jukeboxQuestions = new JukeboxQuestions();
		$jukeboxQuestions->user_id = $userId;
		$jukeboxQuestions->attributes = $data;
		$jukeboxQuestions->save();
		return $jukeboxQuestions;
	}
	
	/**
	 * This method accepts question id and deletes the record.
	 * Returns 1 if successfully deleted. 
	 * Returns 0 if deletion fails.
	 * 
	 * @param string $questionId
	 * @return 1 || 0
	 */
	public static function deleteJukeboxQuestionById($questionId)
	{
	return JukeboxQuestions::model()->deleteByPk($questionId);
	
	}
	
	/**
	 * This method accepts a question id and an array of data and updates the model. 
	 * Returns model if successfully updated. 
	 * Returns false if the question id is not found or if updation fails.
	 * 
	 * data array may have the following hash keys -
	 * 1. question
	 * 2. description
	 * 3. category_id
	 * 4. email_answer
	 * 
	 * @param string $questionId
	 * @param array $data
	 * @return model || false
	 */
	
	public static function updateJukeboxQuestionById($questionId,$data)
	{
		$jukeboxQuestions = JukeboxQuestions::model()->find('id=:questionId',array(':questionId'=>$questionId));
		if($jukeboxQuestions){
			if(self::isUpdateable($questionId))
			{
			$jukeboxQuestions->attributes = $data;
			$jukeboxQuestions->save();
			return $jukeboxQuestions;
			}
			else 
			return false;
		}else {
			return false;
		}	
	}
	 
	
	/**
	 * This method accepts a question id and finds if the question has any answer posted. 
	 * Returns true if question does not have any answers posted to it. 
	 * Returns false if question have any answers posted to it.
	 * 
	 * 
	 * @param string $questionId
	 * @return true || false
	 */
	public static function isUpdateable($questionId)
	{
		$jukeboxAnswers=JukeboxAnswers::model()->find('jukebox_question_id=:questionId',array(':questionId'=>$questionId));
		if($jukeboxAnswers)
		return false;
		else
		return true;
	}
	
	/**
	 * This method accepts a data which is based on category id , keyword , time 
	 * Returns model if successfully found. 
	 * 
	 * data array should have the following hash keys -
	 * 1. category_id
	 * 2. keyword
	 * 3. time
	 * 
	 * @param array $data
	 * @return model
	 */
	
	public static function searchQuestion($data)
	{
		$criteria=new CDbCriteria;
		$condition = null;
		$params = null;
		
		if($data['category_id']!=""){
			$condition.= 'category_id=:categoryId';
			$params[':categoryId'] = $data['category_id']; 
		}
		
		if($data['keyword']!=""){
			if($condition!="")
				$condition.=' && ';
			$condition.= '(question like :keyword || description like :keyword)';
			$params[':keyword'] = '%'.$data['keyword'].'%'; 
		}
		
		if($data['time']!=""){
			if($condition!="")
				$condition.=' && ';
				$date = date("Y-m-d",strtotime("-".$data['time']." DAY"));
			$condition.= 'date(created_time) >= :date';
			$params[':date'] = $date; 
		}
		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		$questions = JukeboxQuestions::model()->findAll($criteria);

		return $questions;
	}
	
	public static function searchJukeboxWithCriteria($criteria)
	{
		$questions = JukeboxQuestions::model()->findAll($criteria);

		return $questions;
	}
	public static function getCriteriaObject($data)
	{
		$criteria=new CDbCriteria;
		$condition = null;
		$params = null;
		
		if($data['category_id']!=""){
			$condition.= 'category_id=:categoryId';
			$params[':categoryId'] = $data['category_id']; 
		}
		
		if($data['keyword']!=""){
			if($condition!="")
				$condition.=' && ';
			$condition.= '(question like :keyword || description like :keyword)';
			$params[':keyword'] = '%'.$data['keyword'].'%'; 
		}
		
		if($data['time']!=""){
			if($condition!="")
				$condition.=' && ';
				$date = date("Y-m-d",strtotime("-".$data['time']." DAY"));
			$condition.= 'date(created_time) >= :date';
			$params[':date'] = $date; 
		}
		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		return $criteria;
	}
	
	/**
	 * This method returns the questions based on the category id.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 *   
	 * @param string $categoryId
	 * @return model
	 */
	
	public static function getJukeboxQuestionByCategoryId($categoryId)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='category_id=:categoryId';
		$criteria->params=array(':categoryId'=>$categoryId);
		$jukeboxQuestions=JukeboxQuestions::model()->findAll($criteria);
		if($jukeboxQuestions)
		return $jukeboxQuestions;
		else 
		return false;
	}
	
/**
	 * This method returns the questions based on the question id.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 *   
	 * @param string $questionId
	 * @return model
	 */
	public static function getJukeboxQuestionById($questionId)
	{
		return JukeboxQuestions::model()->findByPk($questionId);
	}
	
	/**
	 * This method returns the questions of a particular user.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 *   
	 * @param string $userId
	 * @return model
	 */
	public static function getCriteriaObjectMyJukebox($userId)
		{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId';
		$criteria->params=array(':userId'=>$userId);
		return $criteria;
		}
	public static function searchMyJukeboxWithCriteria($criteria)
	{
		$jukeboxQuestions=JukeboxQuestions::model()->findAll($criteria);
		if($jukeboxQuestions)
		return $jukeboxQuestions;
		else 
		return false;
	}
	public static function getAllJukeboxQuestionsOfUser($userId,$count='')
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId';
		$criteria->params=array(':userId'=>$userId);
		if($count)
		$criteria->limit = $count;
		$jukeboxQuestions=JukeboxQuestions::model()->findAll($criteria);
		if($jukeboxQuestions)
		return $jukeboxQuestions;
		else 
		return false;
	}
	
}
?>