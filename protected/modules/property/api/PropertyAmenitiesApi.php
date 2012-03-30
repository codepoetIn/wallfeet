<?php

class PropertyAmenitiesApi {
	
	/**
	 * This method accepts a propertyId and amenityId to add a particular amenity for a particular property.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $propertyId
	 * @param string $amenityId
	 * 
	 * @return model
	 */
	public static function addAmenityForProperty($propertyId, $amenityId) {
		$propertyAmenities = new PropertyAmenities ();
		$propertyAmenities->property_id = $propertyId;
		$propertyAmenities->amenity_id = $amenityId;
		$propertyAmenities->save ();
		return $propertyAmenities;
	}
	
	/**
	 * This method accepts a propertyId and array of amenityIds to add amenities for a particular property.
	 * Returns true if successfully created. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $propertyId
	 * @param array $amenityIds
	 * 
	 * @return boolean
	 */
	
	public static function addAmenitiesForProperty($propertyId, $amenityIds) {
		
		$result = true;
		foreach ( $amenityIds as $amenityId ) {
			$propertyAmenities = new PropertyAmenities ();
			$propertyAmenities->property_id = $propertyId;
			$propertyAmenities->amenity_id = $amenityId;
			$result = $result && $propertyAmenities->save ();
		}
		
		return $result;
	}
	
	/**
	 * This method accepts a propertyId and amenityId to delete a particular amenity for a particular property.
	 * Returns 1 if propertyId and amenityId is found. 
	 * Returns 0 if validation fails.
	 * 
	 * 
	 * @param string $propertyId
	 * @param string $amenityId
	 * 
	 * @return integer
	 */
	
	public static function deleteAmenityForProperty($propertyId, $amenityId) {
		
		return PropertyAmenities::model ()->deleteAll ( ('property_id=:propertyId AND amenity_id=:amenityId'), array (':propertyId' => $propertyId, ':amenityId' => $amenityId ) );
	
	}
	
	/**
	 * This method accepts a propertyId and delete all available amenities for a particular property.
	 * Returns number of amenities deleted if propertyId is found. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $propertyId
	 * 
	 * @return integer
	 */
	
	public static function deleteAllAmenitiesForProperty($propertyId) {
		return PropertyAmenities::model ()->deleteAll ( 'property_id=:propertyId', array (':propertyId' => $propertyId ) );
	}
/**
	 * This method returns the array of amenity Id for a particular propertyId.
	 * Returns the array of amenity names using amenity_id as index if amenities for given propertyid is successfully found.
	 * Returns false if not found.
	 *
	 * @param string $propertyId
	 * @return array|boolean
	 */
	public static function getAmenitiesIdForPropertyHouse($propertyId)
	{
			$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where amenity_type=:amenity_type AND id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId)", array (':propertyId' => $propertyId,':amenity_type'=>0 ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result [$obj->id] = $obj->id;
			}
			return $result;
		} else
			return false;
	}
	public static function getAmenitiesIdForPropertyExternal($propertyId)
	{
		$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where amenity_type=:amenity_type AND id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId)", array (':propertyId' => $propertyId,':amenity_type'=>1 ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result [$obj->id] = (int)$obj->id;
			}
			return $result;
		} else
			return false;
	}
	/**
	 * This method returns the array of amenity for a particular propertyId.
	 * Returns the array of amenity names using amenity_id as index if amenities for given propertyid is successfully found.
	 * Returns false if not found.
	 *
	 * @param string $propertyId
	 * @return array|boolean
	 */
	public static function getAmenitiesForPropertyHouse($propertyId)
	{
			$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where amenity_type=:amenityType AND id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId AND category_amenities.amenity_type=:amenityType)", array (':propertyId' => $propertyId,'amenityType'=>'0' ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result [$obj->id] = $obj->amenity;
			}
			return $result;
		} else
			return false;
	}
	public static function getAmenitiesForPropertyExternal($propertyId)
	{
		$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where amenity_type=:amenityType AND id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId)", array (':propertyId' => $propertyId,'amenityType'=>'1' ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result [$obj->id] = $obj->amenity;
			}
			return $result;
		} else
			return false;
	}
	public static function getAmenitiesForProperty($propertyId) {
		
		$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId)", array (':propertyId' => $propertyId ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result [$obj->id] = $obj->amenity;
			}
			return $result;
		} else
			return false;
	
	}
	public static function getAmenitiesIdForProperty($propertyId) {
		
		$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId)", array (':propertyId' => $propertyId ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result [$obj->id] = $obj->id;
			}
			return $result;
		} else
			return false;
	
	}
	public static function getAmenitiesById($amenitiesId)
	{
		return DbUtils::getDbValues(new CategoryAmenities,'id',$amenitiesId,'amenity ');
		$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where id IN
		(SELECT amenity_id FROM property_amenities WHERE property_id=:propertyId)", array (':propertyId' => $propertyId ) );
	}
	

}
?>