<?php
class ProjectPropertiesApi {
	
	/**
	 * This method returns the array of property for a particular projectId.
	 * Returns the array of property names using property_id as index if properties for given projectid is successfully found.
	 * Returns false if not found.
	 *
	 * @param string $projectId
	 * @return array|boolean
	 */
	
	public static function getProperties($projectId) {
		
		$models = Property::model ()->findAllBySql ( "SELECT * FROM property where id IN(SELECT property_id FROM project_properties WHERE project_id=:projectId)", array (':projectId' => $projectId ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result ["$obj->id"] = $obj->property_name;
			}
			return $result;
		} else
			return false;
	}
	
	public static function getPropertiesModel($projectId) {
		
		$models = Property::model ()->findAllBySql ( "SELECT * FROM property where id IN(SELECT property_id FROM project_properties WHERE project_id=:projectId)", array (':projectId' => $projectId ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $model ) {
				$result [] = $model;
			}
			return $result;
		} else
			return false;
	}
	
	/**
	 * This method accepts a projectId and propertyId to add a particular property for a particular project.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * @param string $propertyId
	 * 
	 * @return model
	 */
	public static function addProperty($projectId, $propertyId) {
		
		$projectProperties = new ProjectProperties ();
		$projectProperties->project_id = $projectId;
		$projectProperties->property_id = $propertyId;
		
		$projectProperties->save ();
		return $projectProperties;
	
	}
	
	/**
	 * This method accepts a projectId and array of propertyIds to add properties for a particular project.
	 * Returns true if successfully created. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * @param array $propertyIds
	 * 
	 * @return boolean
	 */
	
	public static function addProperties($projectId, $propertyIds) {
		
		$result = true;
		foreach ( $propertyIds as $propertyId ) {
			$projectProperties = new ProjectProperties ();
			$projectProperties->project_id = $projectId;
			$projectProperties->property_id = $propertyId;
			$result = $result && $projectProperties->save ();
		}
		
		return $result;
	
	}
	
	/**
	 * This method accepts a projectId and propertyId to delete a particular property for a particular project.
	 * Returns 1 if projectId and propertyId is found. 
	 * Returns 0 if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * @param string $propertyId
	 * 
	 * @return integer
	 */
	public static function deleteProperty($projectId, $propertyId) {
		return ProjectProperties::model ()->deleteAll ( ('project_id=:projectId AND property_id=:propertyId'), array (':projectId' => $projectId, ':propertyId' => $propertyId ) );
	
	}
	
	/**
	 * This method accepts a projectId and delete all available properties for a particular project.
	 * Returns number of properties deleted if projectId is found. 
	 * Returns 0 if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * 
	 * @return integer
	 */
	
	public static function deleteAllProperties($projectId) {
		return ProjectProperties::model ()->deleteAll ( 'project_id=:projectId', array (':projectId' => $projectId ) );
	
	}
	
	public static function getPropertyCount($projectId){
		$models = Property::model ()->findAllBySql ( "SELECT * FROM property where id IN(SELECT property_id FROM project_properties WHERE project_id=:projectId)", array (':projectId' => $projectId ) );
		$result=0;
		if($models)
			$result=count($models);
		return $result;
	}

}

?>