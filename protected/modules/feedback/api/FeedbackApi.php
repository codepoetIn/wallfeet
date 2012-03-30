<?php
class FeedbackApi 
{
	public static function getFeedbackById($id)
	{
		$feedBack=Feedback::model ()->findByPk ( $id );
		if($feedBack){
			return $feedBack;
		}
		return null;
	}
}