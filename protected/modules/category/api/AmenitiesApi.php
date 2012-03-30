<?php

class AmenitiesApi {

	/**
	 * This method gets arrary of data and creates the model
	 * Returns Model if sucessfully created.
	 * Returns the error Validated Model if validation fails
	 *
	 * Data arrary should have the following Hash keys
	 * 1.amenity
	 * 
	 * @param arrary $data
	 * @return model ||model with error
	 */
	public static function create($data){
		$categoryAmenties = new CategoryAmenities();
		$categoryAmenties->attributes = $data;
		return $categoryAmenties->save();
	}
	
	/**
	 * This method gets id from the user
	 * Returns data if search successful.
	 * Returns false if search unsuccessful.
	 *
	  *
	 * @param int $Id
	 * @return data||false
	 */
	
	public static function getAmenitiesById($Id)
	{
		$categoryAmenties=CategoryAmenities::model()->findByPk($Id);
		if($categoryAmenties)
			return $categoryAmenties->amenity;
		else
			return false;
	}
	
	/**
	 * This method gets id from the user and deletes the record
	 * Returns number of records deleted.
	 * Returns 0 if deletion fails.
	 *
	  *
	 * @param int $Id
	 * @return integer
	 */
	
	
	public static function deleteById($id){
		return CategoryAmenities::model()->deleteByPk($id);
	}
	
	
	/**
	 * This method gets amenityName and deletes the record
	 * Returns number of records deleted.
	 * Returns 0 if deletion fails.
	 *
	  *
	 * @param string $amenityName
	 * @return integer
	 */
	public static function deleteByName($amenityName){
		return CategoryAmenities::model()->deleteAll('amenity=:amenity',array(':amenity'=>$amenityName));
		
	}

	
	/**
	 * This method accepts a category amenity id and amenity name and updates the model. 
	 * Returns model if successfully updated. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the category Amenity id is not found.
	 * 
	 * @param string $Id
	 * @param string $data
	 * @return model||model with errors||false
	 */
	
	
	public static function update($data,$id)
	{
		$categoryAmenties = CategoryAmenities::model()->findByPk($id);
		if($categoryAmenties)
		{
			$categoryAmenties->attributes = $data;
			$categoryAmenties->save();
			return $categoryAmenties;
		} 
		else 
			return false;
	}

	/**
	 * This method returns all the amenities.
	 * Returns model if successfully found. 
	 * Returns false if not found.
	 * 
	 * @return model || false
	 */

	public static function getAll()
	{
		$categorAmenties = CategoryAmenities::model()->findAll();
		if($categorAmenties)
			return $categorAmenties;
		else
			return false;
	}
	
	
	public static function amenityList() {
		$model=CategoryAmenities::model()->findAll();
		$amenityList = null;
		foreach($model as $amenity){
			$amenityList[$amenity->id] = $amenity->amenity;
		}
		return $amenityList;
	}
}

?>