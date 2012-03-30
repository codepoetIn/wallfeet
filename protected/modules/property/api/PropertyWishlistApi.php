<?php

class PropertyWishlistApi {
	/**
	 * This method accepts Id's of property and user table.
	 * Returns true if successfully added.
	 * Returns the error validated model if validation fails.
	 *
	 * @param string $userId and $propertyId
	 * @return string|model
	 */
	public static function getWishlistUserOnProperty($propertyId,$userId)
	{
		$propertyWishlist = PropertyWishlist::model ()->find ( 'user_id=:user_id AND property_id=:propertyid', array (':user_id' => $userId,'propertyid'=>$propertyId ) );

		if ($propertyWishlist)
		return $propertyWishlist;
		else
		return false;
	}
	public static function addToWishlist($propertyId, $userId) {

		$propertyWishlist = new PropertyWishlist ();
		$propertyWishlist->property_id = $propertyId;
		$propertyWishlist->user_id = $userId;

		$propertyWishlist->save ();

		return $propertyWishlist;
	}
	/**
	 * This method accepts propertyId and userId and deletes the corresponding setting.
	 * Returns 1 if successfully deleted.
	 * Returns 0 if it is not deleted.
	 *
	 * @param string $userId
	 * @return 1 || 0
	 */

	public static function deleteFromWishlist($propertyId, $userId) {

		return PropertyWishlist::model ()->deleteAll ( ('property_id=:property_id AND user_id=:user_id'), array (':property_id' => $propertyId, ':user_id' => $userId ) );
	}

	/**
	 * This method accepts Id of a user.
	 * deletes all the wishlist corresponding to that user.
	 * Returns true if successfully deleted.
	 * Returns false if it is not deleted.
	 *
	 * @param string $userId
	 */
	public static function deleteAllFromWishlist($userId) {
		return PropertyWishlist::model ()->deleteAll ( 'user_id=:user_id', array (':user_id' => $userId ) );

	}

	/**
	 * This method returns wishlist of a user.
	 * Returns model if wishlist is available.
	 * Returns false if it is not available.
	 *
	 * @param string $userId
	 * @return boolean || model
	 */
	public static function getWishlist($userId,$count='') {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		if($count)
		$criteria->limit = $count;
		$propertyWishlist = PropertyWishlist::model ()->findAll ( $criteria );

		if ($propertyWishlist)
		return $propertyWishlist;
		else
		return false;
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
	 * This method returns wishlist of a user.
	 * Returns model if wishlist is available.
	 * Returns false if it is not available.
	 *
	 * @param string $userId
	 * @return array || false
	 */
	public static function getWishlistAsArray($userId) {
		$propertyWishlist = PropertyWishlist::model ()->findAll ( 'user_id=:user_id', array (':user_id' => $userId ) );
		$result = array ();
		if ($propertyWishlist) {
			foreach ( $propertyWishlist as $property ) {
				$result[$property->property_id] = $property->property_id;
			}
			return $result;
		}
		return false;
	}
	
	public static function getCriteriaObjectForUser($userId){
		$wishlist = PropertyWishlist::model()->findAll('user_id=:userId',array(':userId'=>$userId));
		$propertyIds= array();
		foreach($wishlist as $property){
			$propertyIds[] = $property->property_id;
		}
		$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$propertyIds);
		return $criteria;
	}
	
	public static function searchWithCriteria($criteria){
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties)
		return $properties;
		else
		return false;
	}

	public static function getWishlistPropertiesByUserId($userId) {
		$models = Property::model ()->findAllBySql("SELECT * FROM property where id IN(SELECT property_id FROM property_wishlist WHERE user_id=:userId)", array(':userId' => $userId));
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