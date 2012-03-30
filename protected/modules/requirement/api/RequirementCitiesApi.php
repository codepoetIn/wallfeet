<?php
class RequirementCitiesApi {
	
	/**
	 * This method accepts a requirementId and array of city id and add them for a particular requirement.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $requirementId
	 * @param array $cityIds
	 * 
	 * @return model || model with errors
	 */
	
	public static function addCitiesForRequirement($requirementId, $cityIds) {
		$result = true;
		foreach ( $cityIds as $cityId ) {
			$requirementCities = new RequirementCities;
			$requirementCities->requirement_id = $requirementId;
			$requirementCities->city_id = $cityId;
			$result = $result && $requirementCities->save ();
		}
		return $result;
	}
	
	/**
	 * This method accepts a requirementId and delete all available cities for a particular requirement.
	 * Returns number of cities deleted if requirementId is found. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $requirementId
	 * 
	 * @return integer
	 */
	
	
	public static function deleteAllCitiesForRequirement($requirementId) {
		return RequirementCities::model()->deleteAll ( 'requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
	}

	
	/**
	 * This method returns the cities for a particular requirementId.
	 * Returns model if successfull
	 * Returns false if not found.
	 *
	 * @param string $requirementId
	 * @return model|false
	 */
	
	public static function getCitiesByRequirementId($requirementId)
	{
		$requirementCities = RequirementCities::model()->findAll('requirement_id=:requirementId', array (':requirementId' => $requirementId ) );
		if($requirementCities)
		return $requirementCities;
		else 
		return false;
	}
	
	public static function getCitiesForRequirements($requirementIds){

		$criteria=new CDbCriteria;
		$criteria->addInCondition('requirement_id',$requirementIds);

		$cities = RequirementCities::model()->findAll($criteria);
		$result = false;

		foreach($cities as $city){
			$result[$city->requirement_id][] = $city->city_id;
		}

		return $result;
	}
}
?>