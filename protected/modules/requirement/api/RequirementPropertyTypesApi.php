<?php
class RequirementPropertyTypesApi {
	
	/**
	 * This method accepts a requirementId and array of property types and add them for a particular requirement.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $requirementId
	 * @param array $propertyTypeIds
	 * 
	 * @return model || model with errors
	 */
	public static function addPropertyTypesForRequirement($requirementId, $propertyTypeIds) {
		$result = true;
		foreach ( $propertyTypeIds as $propertyTypeId ) {
			$requirementPropertyTypes = new RequirementPropertyTypes;
			$requirementPropertyTypes->requirement_id = $requirementId;
			$requirementPropertyTypes->property_type_id = $propertyTypeId;
			$result = $result && $requirementPropertyTypes->save ();
		}
		return $result;
	}
	
	/**
	 * This method accepts a requirementId and delete all available property types for a particular requirement.
	 * Returns number of property types deleted if requirementId is found. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $requirementId
	 * 
	 * @return integer
	 */
	
	
	public static function deleteAllPropertyTypesForRequirement($requirementId) {
		return RequirementPropertyTypes::model()->deleteAll ( 'requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
	}
	
	
	/**
	 * This method returns the property types for a particular requirementId.
	 * Returns model if successfull
	 * Returns false if not found.
	 *
	 * @param string $requirementId
	 * @return model|false
	 */
	
	public static function getPropertyTypesByRequirementId($requirementId)
	{
		$requirementPropertyTypes = RequirementPropertyTypes::model()->findAll('requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
		if($requirementPropertyTypes)
		return $requirementPropertyTypes;
		else 
		return false;
	}
	
	public static function getPropertiesForRequirements($requirementIds){

		$criteria=new CDbCriteria;
		$criteria->addInCondition('requirement_id',$requirementIds);

		$propertyTypes = RequirementPropertyTypes::model()->findAll($criteria);
		$result = false;

		foreach($propertyTypes as $propertyType){
			$result[$propertyType->requirement_id][] = $propertyType->property_type_id;
		}

		return $result;
	}
	
}
?>