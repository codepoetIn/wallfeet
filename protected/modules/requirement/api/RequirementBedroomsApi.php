<?php
class RequirementBedroomsApi {
	
	/**
	 * This method accepts a requirementId and array of bedrooms to add bedrooms for a particular requirement.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $requirementId
	 * @param array $bedrooms
	 * 
	 * @return model || model with errors
	 */
	public static function addBedroomsForRequirement($requirementId, $bedrooms) {
		$result = true;
		foreach($bedrooms as $bedroom){
			$requirementBedrooms = new RequirementBedrooms;
			$requirementBedrooms->requirement_id = $requirementId;
			$requirementBedrooms->bedrooms = $bedroom;
			$result = $result && $requirementBedrooms->save ();
		}
		return $result;
	}
	public static function addBedroomForRequirement($requirementId, $bedroom) {
		
		$requirementBedrooms = new RequirementBedrooms ();
		$requirementBedrooms->requirement_id = $requirementId;
		$requirementBedrooms->bedrooms = $bedroom;
		return $requirementBedrooms->save ();
	
	}
	
	/**
	 * This method accepts a requirementId and delete all available bedrooms for a particular requirement.
	 * Returns number of bedrooms deleted if requirementId is found. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $requirementId
	 * 
	 * @return integer
	 */
	
	
	public static function deleteAllBedroomsForRequirement($requirementId) {
		return RequirementBedrooms::model()->deleteAll ( 'requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
	}
	
	
	/**
	 * This method returns the bedrooms for a particular requirementId.
	 * Returns model if successfull
	 * Returns false if not found.
	 *
	 * @param string $requirementId
	 * @return model|false
	 */
	
	public static function getBedroomsByRequirementId($requirementId)
	{
		$requirementBedrooms = RequirementBedrooms::model()->findAll('requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
		if($requirementBedrooms)
		return $requirementBedrooms;
		else 
		return false;
	}
	
}
?>