<?php

/**
 * This method accepts a projectId and amenityId to add a particular amenity for a particular project.
 * Returns model if successfully created. 
 * Returns the error validated model if validation fails.
 * 
 * 
 * @param string $projectId
 * @param string $amenityId
 * 
 * @return model
 */

class ProjectAmenitiesApi {
	
	public static function addAmenityForProject($projectId, $amenityId) {
		$projectAmenities = new ProjectAmenities ();
		$projectAmenities->project_id = $projectId;
		$projectAmenities->amenity_id = $amenityId;
		$projectAmenities->save ();
		return $projectAmenities;
	
	}
	
	/**
	 * This method accepts a projectId and array of amenityIds to add amenities for a particular project.
	 * Returns true if successfully created. 
	 * Returns false if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * @param array $amenityIds
	 * 
	 * @return boolean
	 */
	
	public static function addAmenitiesForProject($projectId, $amenityIds) {
		$result = true;
		foreach ( $amenityIds as $amenityId ) {
			$projectAmenities = new ProjectAmenities ();
			$projectAmenities->project_id = $projectId;
			$projectAmenities->amenity_id = $amenityId;
			$result = $result && $projectAmenities->save ();
		}
		
		return $result;
	}
	
	/**
	 * This method accepts a projectId and amenityId to delete a particular amenity for a particular project.
	 * Returns 1 if projectId and amenityId is found. 
	 * Returns 0 if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * @param string $amenityId
	 * 
	 * @return integer
	 */
	
	public static function deleteAmenityForProject($projectId, $amenityId) {
		
		return ProjectAmenities::model ()->deleteAll ( ('project_id=:projectId AND amenity_id=:amenityId'), array (':projectId' => $projectId, ':amenityId' => $amenityId ) );
	
	}
	
	/**
	 * This method accepts a projectId and delete all available amenities for a particular project.
	 * Returns number of amenities deleted if projectId is found. 
	 * Returns 0 if validation fails.
	 * 
	 * 
	 * @param string $projectId
	 * 
	 * @return integer
	 */
	
	public static function deleteAllAmenitiesForProject($projectId) {
		return ProjectAmenities::model ()->deleteAll ( 'project_id=:projectId', array (':projectId' => $projectId ) );
	
	}
	
	/**
	 * This method returns the array of amenity for a particular projectId.
	 * Returns the array of amenity names using amenity_id as index if amenities for given projectid is successfully found.
	 * Returns false if not found.
	 *
	 * @param string $projectId
	 * @return array|boolean
	 */
	
	public static function getAmenitiesForProject($projectId) {
		
		$models = CategoryAmenities::model ()->findAllBySql ( "SELECT * FROM category_amenities where id IN
		(SELECT amenity_id FROM project_amenities WHERE project_id=:projectId)", array (':projectId' => $projectId ) );
		$result = array ();
		
		if ($models) {
			foreach ( $models as $obj ) {
				$result ["$obj->id"] = $obj->amenity;
			}
			return $result;
		} else
			return false;
	}
}

?>