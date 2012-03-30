<?php

class ProjectWishlistApi {

	public static function getWishlistUserOnProject($projectId,$userId)
	{
		$projectWishlist = ProjectWishlist::model ()->findAll ( 'user_id=:user_id AND project_id=:projectid', array (':user_id' => $userId,'projectid'=>$projectId ) );

		if ($projectWishlist)
		return $projectWishlist;
		else
		return false;
	}
	/**
	 * This method accepts projectId and userId .
	 * Returns model if successfully added.
	 * Returns the error validated model if validation fails.
	 *
	 *
	 * @param string $userId and $projectId
	 * @return model
	 */

	public static function addToWishlist($projectId, $userId) {
		$projectWishlist = new ProjectWishlist ();
		$projectWishlist->project_id = $projectId;
		$projectWishlist->user_id = $userId;
		$projectWishlist->save ();
		return $projectWishlist;

	}

	/**
	 * This method accepts projectId and userId and deletes the corresponding record.
	 * Returns 1 if successfully deleted.
	 * Returns 0 if it is not deleted.
	 *
	 * @param string $userId
	 * @return integer
	 */
	public static function deleteFromWishlist($projectId, $userId) {
		return ProjectWishlist::model ()->deleteAll ( ('project_id=:project_id AND user_id=:user_id'), array (':project_id' => $projectId, ':user_id' => $userId ) );
	}

	/**
	 * This method accepts the userId of a user and deletes all the wishlist corresponding to that user.
	 * Returns number of projects successfully deleted.
	 * Returns 0 if it is not deleted.
	 *
	 * @param string $userId
	 */

	public static function deleteAllFromWishlist($userId) {
		return ProjectWishlist::model ()->deleteAll ( 'user_id=:user_id', array (':user_id' => $userId ) );
	}

	/**
	 * This method returns wishlist of a user.
	 * Returns model if wishlist is available.
	 * Returns false if it is not available.
	 *
	 * @param string $userId
	 * @return model|boolean
	 */
	public static function getWishlist($userId,$count='') {
		{
			$criteria = new CDbCriteria ();
			$criteria->condition = 'user_id=:userId';
			$criteria->params = array (':userId' => $userId );
			if($count)
			$criteria->limit = $count;
			$projectWishlist = ProjectWishlist::model ()->findAll ( $criteria);
				
			if ($projectWishlist)
			return $projectWishlist;
			else
			return false;
		}

	}
	public static function getWishlistCount($userId)
	{
		$count=self::getWishlist($userId);
		if($count)
		return count($count);
		else
		return 0;
	}

	/**
	 * This method returns wishlist of a user in an array.
	 * Returns array if wishlist is available.
	 * Returns false if it is not available.
	 *
	 * @param string $userId
	 * @return array|boolean
	 */
	public static function getWishlistAsArray($userId) {
		$projectWishlist = ProjectWishlist::model ()->findAll ( 'user_id=:user_id', array (':user_id' => $userId ) );
		$result = array ();
		if ($projectWishlist) {
			foreach ( $projectWishlist as $project ) {
				$result [$project->project_id] = $project->project_id;
			}
			return $result;
		}
		return false;
	}

	public static function getWishlistProjectsByUserId($userId) {
		$models = Projects::model ()->findAllBySql("SELECT * FROM projects where id IN(SELECT project_id FROM project_wishlist WHERE user_id=:userId)", array(':userId' => $userId));
		$result = array ();
		if ($models) {
			foreach($models as $model) {
				$result[] = $model;
			}
			return $result;
		} else
		return false;
	}
}

?>