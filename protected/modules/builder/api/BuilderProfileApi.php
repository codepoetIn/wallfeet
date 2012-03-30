<?php
class BuilderProfileApi{

	public static function getFeaturedBuilder($count,$location=null) {
		
		if($location)
			{	
				
				$city=GeoCityApi::getCityByName($location['city']);
				$criteria = new CDbCriteria ();
				$criteria->condition = 'featured=:featured AND city_id=:city';
				$criteria->params = array (':featured' => 1,':city'=>$city->id);
				if ($count)
				$criteria->limit = $count;
				$criteria->order = 'rand()';
				$builders = UserBuilderProfile::model ()->findAll ( $criteria );
				$countBuilders=count($builders);
				if($countBuilders<$count)
				{
					$total=$count-$countBuilders;
					$criteria = new CDbCriteria ();
					$criteria->condition = 'featured=:featured AND state_id=:state AND city_id!=:city';
					$criteria->params = array (':featured' => 1,':state'=>$city->state_id,':city'=>$city->id);
					if ($count)
					$criteria->limit = $total;
					$criteria->order = 'rand()';
					$buildersState = UserBuilderProfile::model ()->findAll ( $criteria );
					$builders=ArrayUtils::joinArray($builders,$buildersState);
					$countBuilders=count($builders);
					if($countBuilders<$count)
						{
							$total=$count-$countBuilders;
							$country=GeoCountryApi::getCountryByName($location['country']);
							$criteria = new CDbCriteria ();
							$criteria->condition = 'featured=:featured AND state_id!=:state AND city_id!=:city AND country_id=:country';
							$criteria->params = array (':featured' => 1,':state'=>$city->state_id,':city'=>$city->id,':country'=>$country->id);
							if ($count)
							$criteria->limit = $total;
							$criteria->order = 'rand()';
							$buildersCountry = UserBuilderProfile::model ()->findAll ( $criteria );
							$builders=ArrayUtils::joinArray($builders,$buildersCountry);
							
						}
				}
				if ($builders)
				return $builders;
				else
				return false;
			}
			else
			{
				$criteria = new CDbCriteria ();
				$criteria->condition = 'featured=:featured';
				$criteria->params = array (':featured' => 1);
				if ($count)
				$criteria->limit = $count;
				$criteria->order = 'rand()';
				$builders = UserBuilderProfile::model ()->findAll ( $criteria );
				if ($builders)
				return $builders;
				else
				return false;
			}
		}
	public static function getTopBuilder($count,$location=null) {
		if($location)
		{
			
			$city=GeoCityApi::getCityByName($location['city']);
			
			if ($count){
			$sql = 'SELECT * from user_builder_profile JOIN
						(SELECT builder_id from user_builder_rating r 
							GROUP BY r.builder_id 
							order by AVG(r.rate) DESC LIMIT ' . "$count" . ')
	 					AS ratings ON (user_builder_profile.id=ratings.builder_id) where city_id=' . "$city->id" . ' ORDER BY rand()';
			}
			$sql = 'SELECT * from user_builder_profile JOIN
						(SELECT builder_id from user_builder_rating r 
							GROUP BY r.builder_id 
							order by AVG(r.rate) DESC)
	 					AS ratings ON (user_builder_profile.id=ratings.builder_id) where city_id=' . "$city->id" . ' ORDER BY rand()';
			$properties = Yii::app ()->db->createCommand ( $sql )->queryAll ();
			$countProperties=count($properties);
			if($countProperties<$count)
			{
				$total=$count-$countProperties;
				$sql = 'SELECT * from user_builder_profile JOIN
						(SELECT builder_id from user_builder_rating r 
							GROUP BY r.builder_id 
							order by AVG(r.rate) DESC)
	 					AS ratings ON (user_builder_profile.id=ratings.builder_id) where city_id!=' . "$city->id" . ' AND state_id=' . "$city->state_id" . ' ORDER BY rand() limit ' . "$total" . '';
				$propertiesState= Yii::app ()->db->createCommand ( $sql )->queryAll ();
				$properties=ArrayUtils::joinArray($properties,$propertiesState);
				$countProperties=count($properties);
				
				if($countProperties<$count)
					{
						$total=$count-$countProperties;
						$sql = 'SELECT * from user_builder_profile JOIN
								(SELECT builder_id from user_builder_rating r 
									GROUP BY r.builder_id 
									order by AVG(r.rate) DESC)
			 					AS ratings ON (user_builder_profile.id=ratings.builder_id) where city_id!=' . "$city->id" . ' AND state_id!=' . "$city->state_id" . ' ORDER BY rand() limit ' . "$total" . '';
							$propertiesCountry= Yii::app ()->db->createCommand ( $sql )->queryAll ();
							$properties=ArrayUtils::joinArray($properties,$propertiesCountry);
							
							
							
							
					}
			}
			
		}
		else
		{
			if ($count){
			$sql = 'SELECT * from user_builder_profile JOIN
						(SELECT builder_id from user_builder_rating r 
							GROUP BY r.builder_id 
							order by AVG(r.rate) DESC LIMIT ' . "$count" . ')
	 					AS ratings ON (user_builder_profile.id=ratings.builder_id) ORDER BY rand()';
			}
			$sql = 'SELECT * from user_builder_profile JOIN
						(SELECT builder_id from user_builder_rating r 
							GROUP BY r.builder_id 
							order by AVG(r.rate) DESC)
	 					AS ratings ON (user_builder_profile.id=ratings.builder_id) ORDER BY rand()';
			$properties = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		}
		
		
		if ($properties)
		return $properties;
		else
		return false;

		/*$criteria=new CDbCriteria;
		 $criteria->limit=$count;
		 $criteria->order='rand()';
		 $criteria->with = 'propertyRatings r';
		 $criteria->order='MAX(AVG(r.rate))';
		 $properties=Property::model()->findAll($criteria);
		 if($properties)
		 return $properties;
		 else
		 return false;*/

	}
	/**
	 * This method accepts a userId and an array of data to creates the builder profile model.
	 * Returns the validated model if successfully created.
	 * Returns the error validated model if validation fails.
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
	 * @return model
	 */


	public static function createBuilderProfile($userId,$data){
		$builderprofile=new UserBuilderProfile();
		$builderprofile->attributes=$data;
		$builderprofile->user_id=$userId;
		$builderprofile->save();
		return $builderprofile;
	}



	/**
	 * This method accepts a userId and an array of data and updates the model.
	 * Returns the validated model if successfully updated.
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
	 * @param string $builderprofileId
	 * @param array $data
	 * @return model|model|string
	 */

	public static function updateBuilderProfile($userId, $data){
		$builderprofile=UserBuilderProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		if($builderprofile){
			$builderprofile->attributes=$data;
			$builderprofile->save();
			return $builderprofile;
		} else {
			return false;
		}

	}


	/**
	 * This method accepts a userId and deletes the corresponding builder profile.
	 * Returns true if userId is found.
	 * Returns false if userId is not found.
	 *
	 * @param string $builderprofileId
	 * @return boolean|boolean
	 */
	public static function deleteBuilderProfileById($builderprofileId){
		return UserBuilderProfile::model()->deleteByPk($builderprofileId);
	}
	
	
	public static function deleteBuilderProfile($userId) {
		return UserBuilderProfile::model ()->deleteAll ( 'user_id=:userId', array (':userId' => $userId ) );

	}


	/**
	 * This method returns the builder profile model for a particular userId.
	 * Returns the builder profile model if userId found.
	 * Returns false if userId not found.
	 *
	 * @param string $builderprofileId
	 * @return model|boolean
	 */

	public static function getBuilderProfileById($builderprofileId){
		return UserBuilderProfile::model()->findByPk($builderprofileId);
	}


	/**
	 * This method checks if a builder profile exists for a particular userId.
	 * Returns true if found.
	 * Returns false if not found.
	 *
	 * @param string $userId
	 * @return boolean|boolean
	 */
	public static function isBuilder($userId){
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userId';
		$criteria->params=array(':userId'=>$userId);
		$builderprofiles=UserBuilderProfile::model()->findAll($criteria);
		if($builderprofiles)
		return true;
		else
		return false;
	}



	/*/**
	 * This method returns the builder profile model for a particular userId.
	 * Returns the builder profile model if found.
	 * Returns false if not found.
	 *
	 * @param string $userId
	 * @return model|boolean
	 */
	public static function getBuilderDetails($userId) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		return UserBuilderProfile::model ()->find( $criteria );
	}


	public static function addImage($userId,$image){
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory($userId).$destinationFileName;
		$success = Yii::app()->s3->upload($image , $destinationFile, Yii::app()->params['s3BucketName']);
		if($success){
			return $destinationFileName;
		}else {
			return false;
		}
	}

	public static function getImage($userId){
		$model = UserBuilderProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
		$result = ImageUtils::getDefaultImage('builders');
		if ($model && $model->image) {
			$result = ImageUtils::getImageUrl ( 'builders', $userId, $model->image );
		}
		return $result;
	}

	public static function deleteImage($userId) {
		$model = UserBuilderProfile::model ()->find ( 'user_id=:userId', array (':userId' => $userId ) );
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
		return Yii::app ()->params ['s3BuilderImagesFolderName'] . $userId . '/';
	}

	public static function getCriteriaObject($data)
	{
		$criteria = new CDbCriteria;
		$criteria->alias = 'uc';
		$criteria->join = 'LEFT JOIN user_builder_profile up on uc.id=up.user_id LEFT JOIN user_agent_locations l on l.agent_id=up.id';
		$condition = null;
		$params = null;
		if(isset($data['country_id']) && $data['country_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.country_id=:country_id';
			$params[':country_id'] = $data['country_id'];
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

		if($data['user_type']=="builder" && isset($data['property_type_id']) && $data['property_type_id']!=null){
			$criteria->join.=' LEFT JOIN property p on p.user_id=uc.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$propertyTypes = $data['property_type_id'];
			foreach($propertyTypes as $i=>$propertyType){
				if($i!=0)
				$condition.=' || ';
				$condition.='p.property_type_id='.$propertyType;
			}
			$condition.= ')';
		}

		if($condition!='')
		$condition.=' && ';
		if($data['user_type']=="builder"){
			$condition.='uc.id IN (SELECT user_id FROM user_builder_profile)';
		}

		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		
	//	var_dump($condition);die();
		return $criteria;
	}
	
	
	public static function searchBuilderWithCriteria($criteria)
	{
		$users = UserCredentials::model()->findAll($criteria);

		return $users;
	}
	
	
	public static function searchBuilders($data){
		$criteria = new CDbCriteria;
		$criteria->alias = 'uc';
		$criteria->join = 'LEFT JOIN user_profiles up on uc.id=up.user_id';
		$condition = null;
		$params = null;
		if(isset($data['country_id']) && $data['country_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.country_id=:country_id';
			$params[':country_id'] = $data['country_id'];
		}
		if(isset($data['state_id']) && $data['state_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.state_id=:state_id';
			$params[':state_id'] = $data['state_id'];
		}
		if(isset($data['city_id']) && $data['city_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'up.city_id=:city_id';
			$params[':city_id'] = $data['city_id'];
		}
		if(isset($data['keyword']) && $data['keyword']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= '(up.first_name like :keyword || up.last_name like :keyword || up.gender like :keyword || up.address_line1 like :keyword || up.address_line2 like :keyword || uc.email_id like :keyword)';
			$params[':keyword'] = '%'.$data['keyword'].'%';
		}

		if($data['user_type']=="builder" && isset($data['property_type_id']) && $data['property_type_id']!=null){
			$criteria->join.=' LEFT JOIN property p on p.user_id=uc.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$propertyTypes = $data['property_type_id'];
			foreach($propertyTypes as $i=>$propertyType){
				if($i!=0)
				$condition.=' || ';
				$condition.='p.property_type_id='.$propertyType;
			}
			$condition.= ')';
		}

		if($condition!='')
		$condition.=' && ';
		if($data['user_type']=="builder"){
			$condition.='uc.id IN (SELECT user_id FROM user_builder_profile)';
		}

		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		$users = UserCredentials::model()->findAll($criteria);

		return $users;
	}
}
