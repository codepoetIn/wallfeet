<?php
class PropertyAgeOfConstructionApi{
	
	/**
	 * This method accepts age and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $age
	 * @return model || model with errors
	 */
	public static function create($age) {
		$propertyAgeOfConstruction = new PropertyAgeOfConstruction();
		$propertyAgeOfConstruction->age = $age;
		$propertyAgeOfConstruction->save ();
		return $propertyAgeOfConstruction;
	
	}
	
	/**
	 * This method accepts a propertyAgeOfConstructionId and age and updates the model. 
	 * Returns true if successfully updated. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the question id is not found.
	 * 
	 * @param string $propertyAgeOfConstructionId
	 * @param string $data
	 * @return model||model with errors
	 */
	public static function update($propertyAgeOfConstructionId, $data) {
		$propertyAgeOfConstruction = PropertyAgeOfConstruction::model()->find ( 'id=:propertyAgeOfConstructionId', array (':propertyAgeOfConstructionId' => $propertyAgeOfConstructionId ) );
		if ($propertyAgeOfConstruction) {
			$propertyAgeOfConstruction->age = $data;
			$propertyAgeOfConstruction->save();
			return $propertyAgeOfConstruction;
		} else {
			return false;
		}
	}
	
	/**
	 * This method accepts propertyAgeOfConstructionId and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $propertyAgeOfConstructionId
	 * @return true || false
	 */
	
	public static function delete($propertyAgeOfConstructionId) {
		return PropertyAgeOfConstruction::model ()->deleteAll ( ('id=:propertyAgeOfConstructionId'), array (':propertyAgeOfConstructionId' => $propertyAgeOfConstructionId ) );
	
	}
	
	/**
	 * This method returns the property age of construction.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model
	 */
	
	public static function getpropertyAgeById($Id)
	{
		return PropertyAgeOfConstruction::model()->findByPk($Id);
	}

}
?>