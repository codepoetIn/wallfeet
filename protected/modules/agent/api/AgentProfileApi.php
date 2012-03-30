<?php

class AgentProfileApi {

	/**
	 * This method returns the agent profile model for a particular userId.
	 * Returns the Agent profile model if userId found.
	 * Returns NULL if userId not found.
	 *
	 * @param string $userId
	 * @return model|NULL
	 */

	public static function getAgentDetails($userId) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$userAgentProfile = UserAgentProfile::model ()->find ( $criteria );
		return $userAgentProfile;

	}

	public static function getAgentProfileById($agentId){
		return UserAgentProfile::model()->findByPk($agentId);
	}

	/**
	 * This method accepts a userId and an array of data to creates the Agent profile model.
	 * Returns true if successfully created.
	 * Returns the error validated model if validation fails.
	 *
	 * data array should have the following hash keys -
	 * 1. id (optional)
	 * 2. company_name
	 * 3. company_description
	 * 4. address_line1
	 * 5. address_line2
	 * 6. country_id
	 * 7. state_id
	 * 8. city_id
	 * 9. mobile
	 * 10. telephone
	 * 11. email
	 *
	 * @param string $userId
	 * @param array $data
	 * @return model|model
	 */

	public static function createAgentProfile($userId, $data) {
		/*if (is_null ( $data ) || is_null ( trim ( $userId ) ))
			return false;
			*/
		$userAgentProfile = new UserAgentProfile ();
		$userAgentProfile->attributes = $data;
		$userAgentProfile->user_id = $userId;
		$userAgentProfile->save ();
		return $userAgentProfile;

	}

	/**
	 * This method accepts a userId and deletes the corresponding agent profile.
	 * Returns true if userId is found.
	 * Returns false if userId is not found.
	 *
	 * @param string $userId
	 * @return boolean|boolean
	 */
	public static function deleteAgentProfile($userId) {
		return UserAgentProfile::model ()->deleteAll( 'user_id=:userId', array (':userId' => $userId ) );

	}

	/**
	 * This method accepts a userId and an array of data and updates the model.
	 * Returns the validated model if successfully created.
	 * Returns the error validated model if validation fails.
	 * Returns false if the key is not found.
	 *
	 * data array should have the following hash keys -
	 * 1. id (optional)
	 * 2. organization_name
	 * 3. address_line1
	 * 4. address_line2
	 * 5. locality_id
	 * 6. mobile
	 * 7. telephone
	 * 8. email
	 *
	 * @param string $userId
	 * @param array $data
	 * @return model|model|string
	 */

	public static function updateAgentProfile($userId, $data) {
		$userAgentProfile = UserAgentProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		if ($userAgentProfile) {
			$userAgentProfile->attributes = $data;
			$userAgentProfile->save ();
			return $userAgentProfile;
		} else {
			return false;
		}
	}

	/**
	 * This method checks if an agent profile exists for a particular userId.
	 * Returns true if found.
	 * Returns false if not found.
	 *
	 * @param string $userId
	 * @return boolean|boolean
	 */

	public static function isAgent($userId) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$userAgentProfile = UserAgentProfile::model ()->find ( $criteria );
		if ($userAgentProfile != NULL)
		return true;
		else
		return false;
	}

	/**
	 * This method checks whether the user can be an agent
	 *
	 * @return true
	 */
	public static function canbeAgent() {
		return true;
	}

	public static function addImage($userId,$image){
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory($userId).$destinationFileName;
		$success = Yii::app()->s3->upload($image,$destinationFile, Yii::app()->params['s3BucketName']);
		if($success){
			return $destinationFileName;
		}else {
			return false;
		}
	}

	public static function getImage($userId){
		$model = UserAgentProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		$result = ImageUtils::getDefaultImage('agents');
		if ($model && $model->image) {
			$result = ImageUtils::getImageUrl ( 'agents', $userId, $model->image );
		}
		return $result;
	}

	public static function deleteImage($userId) {
		$model = UserAgentProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		if ($model) {
			$image = $model->image;
			$imageFile = self::getImagesDirectory ( $userId ) . $image;
			$success = Yii::app ()->s3->deleteObject ( Yii::app ()->params ['s3BucketName'], $imageFile );
			if ($success)
			return true;
			else
			return false;
		}
		return false;
	}

	public static function getImagesDirectory($userId) {
		return Yii::app ()->params ['s3AgentImagesFolderName'] . $userId . '/';
	}
	/**
	 * This method accepts an array data to search agents which is based on country_id , state_id , city_id
	 * Returns an array of agent profile if successfully found.
	 *
	 * data array should have the following hash keys -
	 * 1. country_id (optional)
	 * 2. state_id   (optional)
	 * 3. city_id    (optional)
	 *
	 * @param array $data
	 * @return array
	 */
	public static function searchAgents($data) {
		$criteria = new CDbCriteria ();
		$criteria->alias = 'uc';
		$criteria->join = 'LEFT JOIN user_profiles up on uc.id=up.user_id';
		$condition = null;
		$params = null;
		if (isset ( $data ['country_id'] ) && $data ['country_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'up.country_id=:country_id';
			$params [':country_id'] = $data ['country_id'];
		}
		if (isset ( $data ['state_id'] ) && $data ['state_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'up.state_id=:state_id';
			$params [':state_id'] = $data ['state_id'];
		}
		if (isset ( $data ['city_id'] ) && $data ['city_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'up.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
		}
		if (isset ( $data ['keyword'] ) && $data ['keyword'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(up.first_name like :keyword || up.last_name like :keyword || up.gender like :keyword || up.address_line1 like :keyword || up.address_line2 like :keyword || uc.email_id like :keyword)';
			$params [':keyword'] = '%' . $data ['keyword'] . '%';
		}

		if ($data ['user_type'] == "agent" && isset ( $data ['property_type_id'] ) && $data ['property_type_id'] != null) {
			$criteria->join .= ' LEFT JOIN property p on p.user_id=uc.id';
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(';
			$propertyTypes = $data ['property_type_id'];
			foreach ( $propertyTypes as $i => $propertyType ) {
				if ($i != 0)
				$condition .= ' || ';
				$condition .= 'p.property_type_id=' . $propertyType;
			}
			$condition .= ')';
		}

		if ($condition != '')
		$condition .= ' && ';
		if ($data ['user_type'] == "agent") {
			$condition .= 'uc.id IN (SELECT user_id FROM user_agent_profile)';
		}

		if ($condition != null) {
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		$users = UserCredentials::model ()->findAll ( $criteria );
		return $users;
	}

	public static function searchAgentWithCriteria($criteria)
	{
		$users = UserCredentials::model ()->findAll ( $criteria );
		return $users;
	}

	public static function getCriteriaObject($data)
	{
		$criteria = new CDbCriteria ();
		$criteria->alias = 'uc';
		$criteria->join = 'LEFT JOIN user_agent_profile up on uc.id=up.user_id LEFT JOIN user_agent_locations l on l.agent_id=up.id';
		$condition = null;
		$params = null;
		if (isset ( $data ['country_id'] ) && $data ['country_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'up.country_id=:country_id';
			$params [':country_id'] = $data ['country_id'];
		}
		if (isset ( $data ['state_id'] ) && $data ['state_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'up.state_id=:state_id';
			$params [':state_id'] = $data ['state_id'];
		}
		if (isset ( $data ['city_id'] ) && $data ['city_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(up.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
			
			$condition .= ' || ';
			$condition .= 'l.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
			$condition .= ' ) ';
			
		}
		if (isset ( $data ['keyword'] ) && $data ['keyword'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(up.company_description like :keyword || up.company_name like :keyword || up.address_line1 like :keyword || up.address_line2 like :keyword || uc.email_id like :keyword)';
			$params [':keyword'] = '%' . $data ['keyword'] . '%';
		}
			

		if ($data ['user_type'] == "agent" && isset ( $data ['property_type_id'] ) && $data ['property_type_id'] != null) {
				
			$propCond = '';
			$propertyTypes = $data ['property_type_id'];
			foreach ( $propertyTypes as $i => $propertyType ) {
				if ($i != 0)
				$propCond .= ' || ';
				$propCond .= 'p.property_type_id=' . $propertyType;
			}
				
			if($propCond){
				if ($condition != '')
				$condition .= ' && ';
				$condition .= "uc.id IN (SELECT user_id FROM property p where $propCond)";
			}
				
			/*$criteria->join .= ' LEFT JOIN property p on p.user_id=uc.id';
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(';
			$propertyTypes = $data ['property_type_id'];
			foreach ( $propertyTypes as $i => $propertyType ) {
				if ($i != 0)
				$condition .= ' || ';
				$condition .= 'p.property_type_id=' . $propertyType;
			}
			$condition .= ')';*/
		}

		if ($condition != '')
		$condition .= ' && ';
		if ($data ['user_type'] == "agent") {
			$condition .= 'uc.id IN (SELECT user_id FROM user_agent_profile)';
		}

		if ($condition != null) {
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		
		//var_dump($data);


		return $criteria;
	}

}

