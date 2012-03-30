<?php
class RequirementAmenitiesApi {
	
	/**
	 * This method gets requirementID and amenityIDs from user and creates the model
	 * Returns Model if sucessfully created.
	 * Returns the error Validated Model if validation fails
	 *
	 * @param int $requirementId,array $amenityIds
	 * @return model ||model with error
	 */
	
	public static function addAmenitiesForRequirement($requirementId, $amenityIds) {
		$result = true;
		foreach ( $amenityIds as $amenityId ) {
			$requirementAmenities = new RequirementAmenities;
			$requirementAmenities->requirement_id = $requirementId;
			$requirementAmenities->amenity_id = $amenityId;
			$result = $result && $requirementAmenities->save ();
		}
		return $result;
	}
	
	/**
	 * This method gets requirementId from User. 
	 * Returns integer value greater than 0 for successful deletion.
	 * Returns 0 if deletion unsuccessful.
	 *
	 *
	 * @param int $requirementId
	 * @return num>0||0 
	 */
	
	public static function deleteAllAmenitiesForRequirement($requirementId) {
		return RequirementAmenities::model ()->deleteAll ( 'requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
	}
	
	/**
	 * This method gets requirementId from User. 
	 * Returns model for successful search.
	 * Returns false if search unsuccessful
	 *
	 *
	 * @param int $requirementId
	 * @return model|false
	 */
	
	public static function getAmenitiesByRequirementId($requirementId)
	{
		$criteria=new CDbCriteria;
		$criteria->select='amenity_id';
		$criteria->condition='requirement_id=:requirementId';
		$criteria->params=array(':requirementId'=>$requirementId);
		$requirement=RequirementAmenities::model()->findAll($criteria);
		if($requirement)
			return $requirement;
		else
			return false;
	}
	
	public static function getAmenitiesForRequirements($requirementIds){

		$criteria=new CDbCriteria;
		$criteria->addInCondition('requirement_id',$requirementIds);

		$amenities = RequirementAmenities::model()->findAll($criteria);
		$result = false;

		foreach($amenities as $amenity){
			$result[$amenity->requirement_id][] = $amenity->amenity_id;
		}

		return $result;
	}

	
	/*public static function deleteAmenity($requirementId,$amenityId)
	{
		
	}*/
}
?>