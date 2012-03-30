<?php
class PropertyTypesApi {
	
	/**
	 * This method accepts property type and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $type
	 * @return model || model with errors
	 */
	public static function create($type) {
		$property_types = new PropertyTypes ();
		$property_types->property_type = $type;
		$property_types->save ();
		return $property_types;
	
	}
	/**
	 * This method accepts type id and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $typeId
	 * @return true || false
	 */
	
	public static function delete($typeId) {
		return PropertyTypes::model ()->deleteAll ( ('id=:property_type_Id'), array (':property_type_Id' => $typeId ) );
	
	}
	
	/**
	 * This method accepts a propertyType id and Type and updates the model. 
	 * Returns true if successfully updated. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the propertyTypeid is not found.
	 * 
	 * @param string $propertyTypeId
	 * @param string $type
	 * @return model||model with errors
	 */
	public static function update($propertyTypeId, $type) {
		$property_types = PropertyTypes::model ()->findByPk($propertyTypeId);
		if ($property_types) {
			$property_types->property_type = $type;
			$property_types->save ();
			return $property_types;
		
		} else {
			return false;
		}
	
	}
	
	/**
	 * This method returns all the property types.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	
	public static function getAll() {
		$property_types = PropertyTypes::model ()->findAll ();
		if ($property_types)
			return $property_types;
		else
			return false;
	}
	
	
	public static function propertyList() {
		$model=PropertyTypes::model()->findAll();
		$propertyList = null;
		foreach($model as $property){
			$propertyList[$property->id] = $property->property_type;
		}
		return $propertyList;
	}
	
	/**
	 * This method returns the property types for the given type id.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	
	public static function getPropertyTypeById($typeId) {
		$propertyTypes = PropertyTypes::model ()->findByPk ($typeId);
		if ($propertyTypes) {
			return $propertyTypes->property_type;
		} else
			return false;
	}

}

?>