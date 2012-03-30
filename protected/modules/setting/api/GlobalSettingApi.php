<?php

class GlobalSettingApi {

	/**
	 * This method returns the value of the global setting for a particular key.
	 * Returns the value of the setting if found. 
	 * Returns false if not found. 
	 * 
	 * @param string $key
	 * @return model|boolean
	 */
	public static function getSetting($key){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM global_settings');
		$model = GlobalSettings::model()->cache(1000, $dependency)->find('label=:label',array(':label'=>$key));
		if($model)
		return $model->value;
		else
		return false;
	}

	/**
	 * This method returns all the global setting models packaged in an array. 
	 * Returns an array of models if found.
	 * Returns false if not found.
	 * 
	 * @return array of models
	 */
	public static function getAllSettings(){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM global_settings');
		$models = GlobalSettings::model()->cache(1000, $dependency)->findAll();

		return $models;
	}

	/**
	 * This method checks if a global setting exists for a particular key. 
	 * Returns true if found.
	 * Returns false if not found.
	 * 
	 * @param string $key
	 * @return boolean|boolean
	 */
	public static function hasSetting($key){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM global_settings');
		$model = GlobalSettings::model()->cache(1000, $dependency)->find('label=:label',array(':label'=>$key));
		if($model)
		return true;
		else
		return false;
	}

	/**
	 * This method accepts an array of data and creates the model.
	 * Returns true if successfully created. 
	 * Returns the error validated model if validation fails.
	 * 
	 * data array should have the following hash keys -
	 * 1. id (optional)
	 * 2. label
	 * 3. value
	 * 
	 * @param array $data
	 * @return string|model
	 */
	public static function createSetting($data){
		$model = new GlobalSettings();
		$model->attributes = $data;
		if($model->save())
		return true;
		else
		return $model;
	}

	/**
	 * This method accepts a key and deletes the corresponding setting. 
	 * Returns true if key is found.
	 * Returns false if key is not found.
	 * 
	 * @param string $key
	 * @return boolean|boolean
	 */
	public static function deleteSetting($key) {
		$model = GlobalSettings::model()->find('label=:label',array(':label'=>$key));
		if($model){
			$model->delete();
			return true;
		}else {
			return false;
		}
	}

	/**
	 * This method accepts a key and an array of data and updates the model. 
	 * Returns true if successfully created. 
	 * Returns the error validated model if validation fails.
	 * Returns false if the key is not found.
	 * 
	 * data array should have the following hash keys -
	 * 1. id (optional)
	 * 2. label
	 * 3. value
	 * 
	 * @param string $key
	 * @param array $data
	 * @return string|model|string
	 */
	public static function updateSetting($key,$data){
		$model = GlobalSettings::model()->find('label=:label',array(':label'=>$key));
		if($model){
			$model->attributes = $data;
			if($model->save())
			return true;
			else
			return $model;
		}else {
			return false;
		}
	}

	/**
	 * This method returns all the keys of the global settings in an array. 
	 * Returns an array of keys if found.
	 * Returns false if no keys.
	 * 
	 * @return array | boolean
	 */
	public static function getKeys(){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM global_settings');
		$criteria=new CDbCriteria;
		$criteria->select='label';
		$models = GlobalSettings::model()->cache(1000, $dependency)->findAll($criteria);
		if($models) {
			$result = array();
			foreach($models as $model){
				$result[] = $model->label;
			}
			return $result;
		}
		else
		return false;
	}

}

?>