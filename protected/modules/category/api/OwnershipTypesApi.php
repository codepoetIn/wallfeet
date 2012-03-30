<?php

class OwnershipTypesApi {
	/**
	 * This method accepts ownership type and adds the record.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * data array contains following hash keys
	 * 1.ownershiptype
	 * 
	 * @param string $data
	 * @return model || model with errors
	 */
	
	public static function create($data){
		$categoryOwnershipTypes = new CategoryOwnershipTypes();
		$categoryOwnershipTypes->attributes = $data;
		$categoryOwnershipTypes->save();
		return $categoryOwnershipTypes;
	}

	/**
	 * This method accepts category ownership type id and deletes the record.
	 * Returns number of records affected if successfully deleted. 
	 * Returns 0 if deletion fails.
	 * 
	 * @param string $Id
	 * @return model || false
	 */
	
	public static function deleteById($id){
		return CategoryOwnershipTypes::model()->deleteByPk($id);

	}
	
	/**
	 * This method accepts ownership type name and deletes the record.
	 * Returns true if successfully deleted. 
	 * Returns false if deletion fails.
	 * 
	 * @param string $Id
	 * @return model || false
	 */
	
	
	public static function deleteByName($ownershipTypeName){
		$categoryOwnershipTypes = CategoryOwnershipTypes::model()->find('ownership_type=:ownership_type',array('ownership_type'=>$ownershipTypeName));
		return $categoryOwnershipTypes->delete();

	}

	
	/**
	 * This method accepts a category ownership Type id and ownership Type and updates the model. 
	 * Returns model if successfully updated. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the category ownership Typeid is not found.
	 * 
	 * @param string $Id
	 * @param string $data
	 * @return model||model with errors
	 */
	
	public static function update($data,$id){
		$categoryOwnershipTypes = CategoryOwnershipTypes::model()->findByPk($id);
		if($categoryOwnershipTypes){
			$categoryOwnershipTypes->attributes = $data;
			$categoryOwnershipTypes->save();
			return $categoryOwnershipTypes;
		}

		return false;
	}

	
	/**
	 * This method returns all the ownership types.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	
	public static function getAll(){
		$categoryOwnershipTypes = CategoryOwnershipTypes::model()->findAll();
		if($categoryOwnershipTypes)
			return $categoryOwnershipTypes;
		else
			return false;
	}
	
	/**
	 * This method returns  the ownership type for the given id.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */
	public static function getOwnershipTypeById($id){
		$categoryOwnershipTypes = CategoryOwnershipTypes::model()->findByPk($id);
		if($categoryOwnershipTypes)
			return $categoryOwnershipTypes->ownership_type;
		else
			return null;
	}
}

?>