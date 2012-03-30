<?php

class UserSettingApi {

	/**
	 * This method returns the value of the user setting for a particular key.
	 * Returns the value of the setting if found.
	 * Returns false if not found.
	 *
	 * @param string $userId
	 * @param string $key
	 * @return model|boolean
	 */
	public static function getSetting($userId,$key){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM user_settings WHERE user_id='.$userId);
		$model = UserSettings::model()->cache(1000, $dependency)->find('user_id=:userId AND label=:label',array(':userId'=>$userId,'label'=>$key));
		if($model)
		return $model->value;
		else
		return false;
	}

	/**
	 * This method returns all the user setting models packaged in an array.
	 * Returns an array of models if found.
	 * Returns false if not found.
	 *
	 * @param string $userId
	 * @return array of models
	 */
	public static function getAllSettings($userId){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM user_settings WHERE user_id='.$userId);
		$models = UserSettings::model()->cache(1000, $dependency)->findAll('user_id=:userId',array(':userId'=>$userId));

		return $models;
	}

	/**
	 * This method checks if a setting exists for a particular key.
	 * Returns true if found.
	 * Returns false if not found.
	 *
	 * @param string $userId
	 * @param string $key
	 * @return boolean|boolean
	 */
	public static function hasSetting($userId,$key){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM user_settings WHERE user_id='.$userId);
		$model = UserSettings::model()->cache(1000, $dependency)->find('user_id=:userId AND label=:label',array(':userId'=>$userId,'label'=>$key));
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
	 * @param string $userId
	 * @param array $data
	 * @return string|model
	 */
	public static function createSetting($userId,$data){
		$model = new UserSettings();
		$model->user_id = $userId;
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
	 * @param string $userId
	 * @param string $key
	 * @return boolean|boolean
	 */
	public static function deleteSetting($userId,$key){
		$model = UserSettings::model()->find('user_id=:userId AND label=:label',array(':userId'=>$userId,'label'=>$key));
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
	 * @param string $userId
	 * @param string $key
	 * @param array $data
	 * @return string|model|string
	 */	
	public static function updateSetting($userId,$key,$data){
		$model = UserSettings::model()->find('user_id=:userId AND label=:label',array(':userId'=>$userId,'label'=>$key));
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
	 * This method returns all the keys of the user settings in an array. 
	 * Returns an array of keys if found.
	 * Returns false if no keys.
	 * 
	 * @param string $userId
	 * @return array | boolean
	 */	
	public static function getKeys($userId){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM user_settings WHERE user_id='.$userId);
		$criteria=new CDbCriteria;
		$criteria->select='label';
		$criteria->condition='user_id=:userId';
		$criteria->params=array(':userId'=>$userId);

		$models = UserSettings::model()->cache(1000, $dependency)->findAll($criteria);
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