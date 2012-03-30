<?php

class ProjectTypesApi {
	
	/**
	 * This method accepts project type and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $type
	 * @return model || model with errors
	 */
	
	public static function create($type) {
		$projectTypes = new ProjectTypes ();
		$projectTypes->project_type = $type;
		$projectTypes->save ();
		return $projectTypes;
	
	}
	
	/**
	 * This method accepts id and deletes the record.
	 * Returns 1 if successfully deleted. 
	 * Returns 0 if deletion fails.
	 * 
	 * @param string $Id
	 * @return integer
	 */
	
	public static function delete($Id) {
		return ProjectTypes::model ()->deleteAll ( ('id=:project_type_Id'), array (':project_type_Id' => $Id ) );
	
	}
	
	/**
	 * This method accepts an id and type and updates the model. 
	 * Returns the model if successfully updated. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the id is not found.
	 * 
	 * @param string $Id
	 * @param string $type
	 * @return model|boolean
	 */
	public static function update($Id, $type) {
		$projectTypes = ProjectTypes::model ()->find ( 'id=:project_type_Id', array (':project_type_Id' => $Id ) );
		if ($projectTypes) {
			$projectTypes->project_type = $type;
			return $projectTypes->save ();
		} else {
			return false;
		}
	}
	
	/**
	 * This method returns all the project types.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	
	public static function getAll() {
		$projectTypes = ProjectTypes::model ()->findAll ();
		if ($projectTypes)
			return $projectTypes;
		else
			return false;
	}
	
	/**
	 * This method returns the project types for the given id.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	
	public static function getProjectTypeById($Id) {
		$projectType = ProjectTypes::model ()->findByPk ( $Id );
		if ($projectType) {
			return $projectType->project_type;
		} else
			return false;
	}

}

?>