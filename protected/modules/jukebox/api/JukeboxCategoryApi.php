<?php
class JukeboxCategoryApi
{
	/**
	 * This method accepts category and creates the model.
	 * Returns model if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * 
	 * @param string $category
	 * @return model || model with errors
	 */
	public static function addJukeboxCategory($category)
	{
		$jukeboxCategory = new JukeboxCategory();
		$jukeboxCategory->category = $category;
		$jukeboxCategory->save();
		return $jukeboxCategory;
	}
	
	/**
	 * This method accepts category id and deletes the record.
	 * Returns 1 if successfully deleted. 
	 * Returns 0 if deletion fails.
	 * 
	 * @param string $categoryId
	 * @return 1 || 0
	 */
	public static function deleteJukeboxCategoryById($categoryId)
	{
		return JukeboxCategory::model()->deleteByPk($categoryId);
	}
	
	/**
	 * This method accepts a category id and an array of data and updates the model. 
	 * Returns model if successfully updated. 
	 * Returns false if not updated.
	 * Returns false if the category id is not found.
	 * data array contains category.
	 * 
	 * @param string $categoryId
	 * @param array $data
	 * @return model || false
	 */
	
	public static function updateJukeboxCategoryById($categoryId,$data)
	{
		$jukeboxCategory = JukeboxCategory::model()->find('id=:categoryId',array(':categoryId'=>$categoryId));
		if($jukeboxCategory){
			$jukeboxCategory->attributes = $data;
			$jukeboxCategory->save();
			return $jukeboxCategory;
		}else {
			return false;
		}	
	}
	
	/**
	 * This method returns all the jukebox category.
	 * Returns model if successfully found. 
	 * Returns false if not successfull.
	 *   
	 * @return model || false
	 */
	public static function getAllJukeboxCategory()
	{
		$jukeboxCategory = JukeboxCategory::model()->findAll();
		if($jukeboxCategory)
		return $jukeboxCategory;
		else
		return false;
	}
	
	/**
	 * This method returns the category based on the category id.
	 * Returns 1 if successfully found. 
	 * Returns 0 if not successfull.
	 *   
	 * @param string $categoryId
	 * @return 1 || 0
	 */
	
	public static function getJukeboxCategoryById($categoryId)
	{
		return JukeboxCategory::model()->findByPk($categoryId);
		
	}

   
}
?>