<?php
class PropertyApi {
	/**
	 * This method is used to get all properties.
	 * Returns model if successfully found.
	 * Returns false if not found.
	 *
	 * @return model || false
	 */
	public static function getAllPropertiesCount($userid) {
		$count = self::getPropertiesOfUser ( $userid );
		if ($count)
		return count ( $count );
		else
		return 0;

	}
	public static function getAllProperties() {
		$criteria =  new CDbCriteria;
		$criteria->condition = 'id NOT IN (SELECT property_id FROM project_properties)';
		$properties = Property::model ()->findAll ($criteria);
		if ($properties)
		return $properties;
		else
		return false;
	}
	public static function getSimilarProperties($property, $limit,$id) {
	//	echo $id;die();
		$criteria = new CDbCriteria ();
		$criteria->condition = '(i_want_to=:i_want_to OR bedrooms=:bedrooms OR property_type_id=:property_type_id OR transaction_type_id=:transaction_type_id OR city_id=:city_id OR locality_id=:locality_id OR age_of_construction=:age_of_construction OR ownership_type_id=:ownership_type_id) AND id!=:id';
		$criteria->params = array (':id'=>$id,':i_want_to' => $property->i_want_to, ':bedrooms' => $property->bedrooms, ':property_type_id' => $property->property_type_id, ':transaction_type_id' => $property->transaction_type_id, ':city_id'=>$property->city_id,':locality_id' => $property->locality_id, ':age_of_construction' => $property->age_of_construction, ':ownership_type_id' => $property->ownership_type_id );
		$criteria->order = 'created_time DESC';
		if($limit)
		$criteria->limit=$limit;
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties) {
			return $properties;
		}
		else
		return false;

	}
	public static function getNameByPropertyId($propertyId){
		$Property=Property::model ()->findByPk ( $propertyId );
		if($Property){
			return $Property->property_name;
		}
		return null;
	}
	/**
	 * This method returns the property based on property id.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $propertyId
	 * @return model || null
	 */

	public static function getPropertyById($propertyId) {
		return Property::model ()->findByPk ( $propertyId );
	}

	/**
	 * This method returns the property types of a particular user.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $userId
	 * @return model || false
	 */

	public static function getPropertyTypesByUserId($userId) {
		$criteria = new CDbCriteria ();
		$criteria->select = 'property_type_id';
		$criteria->distinct = true;
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties)
		return $properties;
		else
		return false;
	}

	/**
	 * This method returns the properties of a particular user.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $userId
	 * @return model || false
	 */
	public static function getCriteriaObjectForUser($userId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId and id NOT IN (SELECT property_id FROM project_properties)';
		$criteria->params = array (':userId' => $userId );
		return $criteria;
	}
	public static function searchMyPropertyWithCriteria($criteria)
	{
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties)
		return $properties;
		else
		return false;
	}
	public static function getPropertiesOfUser($userId,$count='') {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId and id NOT IN (SELECT property_id FROM project_properties)';
		$criteria->params = array (':userId' => $userId );
		if($count)
		$criteria->limit = $count;
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties)
		return $properties;
		else
		return false;
	}

	/*public static function searchProperties($data);*/

	/**
	 * This method accepts a property id and an array of data and updates the model.
	 * Returns true if successfully updated.
	 * Returns the error validated model if validation fails.
	 * Returns false if the property id is not found.
	 *
	 * data array may have the following hash keys -
	 * 1.user_id
	 * 2.i_want_to
	 * 3.property_name
	 * 4.description
	 * 5.features
	 * 6.featured
	 * 7.jackpot_investment
	 * 8.instant_home
	 * 9.property_type_id
	 * 10.transaction_type_id
	 * 11.locality_id
	 * 12.address
	 * 13.properties_available
	 * 14.bathrooms
	 * 15.bedrooms
	 * 16.furnished
	 * 17.age_of_construction
	 * 18.ownership_type
	 * 19.covered_area_price
	 * 20.land_area_price
	 * 21.total_price
	 * 22.per_unit_price
	 * 23.area_type
	 * 24.display_price
	 * 25.price_negotiable
	 * 26.available_from
	 * 27.available_units
	 * 28.facing, floor_number
	 * 29.total_floors
	 * 30.landmarks
	 * 31.tax_fees
	 * 32.terms_and_conditions
	 * 33.views
	 * 34.recently_viewed
	 *
	 *
	 * @param string $propertyId
	 * @param array $data
	 * @return model||model with errors||false
	 */

	public static function updatePropertyById($propertyId, $data) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->attributes = $data;
			$property->save ();
			return $property;
		} else {
			return false;
		}

	}

	/**
	 * This method accepts property id and deletes the record.
	 * Returns true if successfully deleted.
	 * Returns false if deletion fails.
	 *
	 * @param string $propertyId
	 * @return true || false
	 */

	public static function deletePropertyById($propertyId) {
		return Property::model ()->deleteByPk ( $propertyId );
	}

	/**
	 * This method accepts user's id and an array of data and creates the model.
	 * Returns model if successfully created.
	 * Returns the error validated model if validation fails.
	 *
	 * data array should have the following hash keys-
	 * 1.user_id
	 * 2.i_want_to
	 * 3.property_name
	 * 4.description
	 * 5.features
	 * 6.featured
	 * 7.jackpot_investment
	 * 8.instant_home
	 * 9.property_type_id
	 * 10.transaction_type_id
	 * 11.locality_id
	 * 12.address
	 * 13.properties_available
	 * 14.bathrooms
	 * 15.bedrooms
	 * 16.furnished
	 * 17.age_of_construction
	 * 18.ownership_type
	 * 19.covered_area_price
	 * 20.land_area_price
	 * 21.total_price
	 * 22.per_unit_price
	 * 23.area_type
	 * 24.display_price
	 * 25.price_negotiable
	 * 26.available_from
	 * 27.available_units
	 * 28.facing, floor_number
	 * 29.total_floors
	 * 30.landmarks
	 * 31.tax_fees
	 * 32.terms_and_conditions
	 * 33.views
	 * 34.recently_viewed

	 * @param array $data,string $userId
	 * @return model || model with errors
	 */

	public static function createProperty($userId, $data) {
		$property = new Property ();
		$property->attributes = $data;
		$property->user_id = $userId;
		$property->save ();
		return $property;
	}

	/**
	 * This method finds whether the user has any property or not.
	 * Returns true if user has property.
	 * Returns the false if the user doesnot have any property.
	 *
	 * @param string $userId
	 * @return true || false
	 */

	public static function hasProperty($userId) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties)
		return true;
		else
		return false;
	}

	/**
	 * This method returns the owner of a particular property.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $propertyId
	 * @return model || false
	 */

	public static function getOwner($propertyId) {
		$criteria = new CDbCriteria ();
		$criteria->select = 'user_id';
		$criteria->condition = 'id=:propertyId';
		$criteria->params = array (':propertyId' => $propertyId );
		$property = Property::model ()->find ( $criteria );
		if ($userId) {
			$criteria = new CDbCriteria ();
			$criteria->condition = 'user_id=:userId';
			$criteria->params = array (':userId' => $property->user_id );
			$userprofile = UserProfiles::model ()->find ( $criteria );
			$usercredentials = UserApi::getUserDetails ( $property->user_id );
			$userdetails = ArrayUtils::mergeArray ( $usercredentials->getAttributes (), $userprofile->getAttributes () );
			return $userdetails;
		} else
		return false;
	}

	
	/**
	 * This method gets the count and returns the top properties
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param string $count
	 * @return model || boolean
	 */
	// Check Top Rated and use Random order
	public static function getTopProperties($count) {
		if ($count)
		$sql = 'SELECT * from property JOIN
					(SELECT property_id from property_rating r 
						GROUP BY r.property_id 
						order by AVG(r.rate) DESC LIMIT ' . "$count" . ')
 					AS ratings ON (property.id=ratings.property_id) ORDER BY rand()';
		$sql = 'SELECT * from property JOIN
					(SELECT property_id from property_rating r 
						GROUP BY r.property_id 
						order by AVG(r.rate) DESC)
 					AS ratings ON (property.id=ratings.property_id) ORDER BY rand()';
		$properties = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		/*$criteria=new CDbCriteria;
		 $criteria->join = 'SELECT property_id from property_rating r GROUP BY r.property_id order by AVG(r.rate) DESC';
		 $criteria->limit=$count;
		 $criteria->order='rand()';
		 $property=Property::model()->findAll($criteria);*/
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
	 * This method gets the count and returns the featured properties
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param string $count
	 * @return model || boolean
	 */

	public static function getFeaturedProperties($count,$location=null) {
		if($location)
			{
			$city=GeoCityApi::getCityByName($location['city']);
			$criteria = new CDbCriteria ();
			$criteria->condition = 'featured=:featured  AND city_id=:city';
			$criteria->params = array (':featured' => 1,':city'=>$city->id);
			if ($count)
			$criteria->limit = $count;
			$criteria->order = 'rand()';
			$properties = Property::model ()->findAll ( $criteria );
			$countProperties=count($properties);
			if($countProperties<$count)
				{
					$total=$count-$countProperties;
					$country=GeoCountryApi::getCountryByName($location['country']);
					$criteria = new CDbCriteria ();
					$criteria->condition = 'featured=:featured  AND state_id=:state AND city_id!=:cityId';
					$criteria->params = array (':featured' => 1,':state'=>$city->state_id,':cityId'=>$city->id);
					$criteria->limit = $total;
					$criteria->order = 'rand()';
					$propertiesState = Property::model ()->findAll ( $criteria );
					$properties=ArrayUtils::joinArray($properties,$propertiesState);
					$countProperties=count($properties);
					if($countProperties<$count)
						{
							$total=$count-$countProperties;
							$criteria = new CDbCriteria ();
							$criteria->condition = 'featured=:featured  AND state_id!=:state AND city_id!=:cityId';
							$criteria->params = array (':featured' => 1,':state'=>$city->state_id,':cityId'=>$city->id);
							$criteria->limit = $total;
							$criteria->order = 'rand()';
							$propertiesState = Property::model ()->findAll ( $criteria );
							$properties=ArrayUtils::joinArray($properties,$propertiesState);
							
						}
				}
			if ($properties)
			return $properties;
			else
			return false;
			}
			else
			{
			$criteria = new CDbCriteria ();
			$criteria->condition = 'featured=:featured';
			$criteria->params = array (':featured' => 1 );
			if ($count)
			$criteria->limit = $count;
			$criteria->order = 'rand()';
			$properties = Property::model ()->findAll ( $criteria );
			if ($properties)
			return $properties;
			else
			return false;
			}
	}

	/**
	 * This method gets the count and returns the jackpot properties
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param string $count
	 * @return model || boolean
	 */

	// Use Random order
	public static function getJackpotProperties($count) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'jackpot_investment=:jackpot_investment';
		$criteria->params = array (':jackpot_investment' => 1 );
		if ($count)
		$criteria->limit = $count;
		$citeria->order = 'rand()';
		$properties = Property::model ()->findAll ( $criteria );
		if ($properties)
		return $properties;
		else
		return false;
	}

	/**
	 * This method gets the property id and creates a new jackpot
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return boolean
	 */

	public static function makeJackpot($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->jackpot_investment = 1;
			return $property->save ();
		} else
		return false;
	}

	/**
	 * This method gets the property id and removes the jackpot
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return boolean
	 */

	public static function removeJackpot($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->jackpot_investment = 0;
			return $property->save ();
		} else
		return false;
	}

	/**
	 * This method gets the property id and creates a new instant earning
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return model || boolean
	 */

	public static function makeInstantEarnings($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->instant_home = 1;
			return $property->save ();
		} else
		return false;
	}

	/**
	 * This method gets the property id and removes the instant earning
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return model || boolean
	 */

	public static function removeInstantEarnings($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->instant_home = 0;
			return $property->save ();
		} else
		return false;
	}

	/**
	 * This method gets the property id and creates a new featured
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return boolean
	 */

	public static function makeFeatured($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->featured = 1;
			return $property->save ();
		} else
		return false;

	}

	/**
	 * This method gets the property id and removes the featured
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return boolean
	 */

	public static function removeFeatured($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		if ($property) {
			$property->featured = 0;
			return $property->save ();
		} else
		return false;

	}

	/**
	 * This method returns the property type for a property id.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $propertyId
	 * @return model || false
	 */

	/*public static function getPropertyType($propertyId){
		$property=Property::model()->findByPk($propertyId);
		if($property){
		$typesModel=PropertyTypes::model()->findByPk($property->property_type_id);
		if($typesModel)
		return $typesModel->property_type;
		else
		return false;
		}
		else
		return false;
		}*/

	/**
	 * This method returns the transaction type for a property id.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $propertyId
	 * @return model || false
	 */

	/*public static function getTransactionType($propertyId){
		$property=Property::model()->findByPk($propertyId);
		$transactionTypes=PropertyTransactionTypes::model()->findByPk($property->transaction_type_id);
		return $transactionTypes->transaction_type;
		or
		return PropertyTransactionTypes::model()->findByPk(Property::model()->findByPk($propertyId)->transaction_type_id)->transaction_type;
		}*/

	/**
	 * This method returns the location for the given property id
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $propertyId
	 * @return model || boolean
	 */

	// Return locality, city, state and country as asn hashed array
	public static function getLocation($propertyId) {
		$property = Property::model ()->findByPk ( $propertyId );
		$address [] = "";
		if ($property) {
			$locality = GeoLocality::model ()->findByPk ( $property->locality_id );
			$address ['locality'] = $locality ? $locality->locality : "";
			$city = GeoCity::model ()->findByPk ( $property->city_id );
			$address ['city'] = $city->city;
			$state = GeoState::model ()->findByPk ( $city->state_id );
			$address ['state'] = $state->state;
			$country = GeoCountry::model ()->findByPk ( $state->country_id );
			$address ['country'] = $country->country;
			return $address;
		} else
		return false;
	}
	public static function getLocationForSession($sessionProperty)
	{
			$locality = GeoLocality::model ()->findByPk ( $sessionProperty['locality_id'] );
			$address ['locality'] = $locality ? $locality->locality : "";
			$city = GeoCity::model ()->findByPk ( $sessionProperty['city_id'] );
			$address ['city'] = $city->city;
			$state = GeoState::model ()->findByPk ( $city->state_id );
			$address ['state'] = $state->state;
			$country = GeoCountry::model ()->findByPk ( $state->country_id );
			$address ['country'] = $country->country;
			return $address;
	}
	public static function searchProperty($data) {/*
		$dependency = new CDbCacheDependency ( 'SELECT MAX(updated_time) FROM property' );
		$criteria = new CDbCriteria ();
		$criteria->alias = 'p';
		$criteria->with = array ("locality", "propertyType" );
		$condition = null;
		$params = null;
		if (isset ( $data ['i_want_to'] ) && $data ['i_want_to'] != "") {
		$condition .= 'p.i_want_to=:i_want_to';
		$params [':i_want_to'] = $data ['i_want_to'];
		}
		if (isset ( $data ['property_type_id'] ) && $data ['property_type_id'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.property_type_id=:property_type_id';
		$params [':property_type_id'] = $data ['property_type_id'];
		}
		if (isset ( $data ['transaction_type_id'] ) && $data ['transaction_type_id'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.transaction_type_id=:transaction_type_id';
		$params [':transaction_type_id'] = $data ['transaction_type_id'];
		}
		if (isset ( $data ['locality_id'] ) && $data ['locality_id'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.locality_id=:locality_id';
		$params [':locality_id'] = $data ['locality_id'];
		}

		if (isset ( $data['city_id'] ) && $data['city_id'] != "") {
		var_dump($data['city_id']);die();
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.city_id=:city_id';
		$params [':city_id'] = $data ['city_id'];
		}
		if (isset ( $data ['state_id'] ) && $data ['state_id'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.state_id=:state_id';
		$params [':state_id'] = $data ['state_id'];
		}
		if (isset ( $data ['age_of_construction'] ) && $data ['age_of_construction'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.age_of_construction=:age_of_construction';
		$params [':age_of_construction'] = $data ['age_of_construction'];
		}
		if (isset ( $data ['ownership_type'] ) && $data ['ownership_type'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.ownership_type=:ownership_type';
		$params [':ownership_type'] = $data ['ownership_type'];
		}
		if (isset ( $data ['city_id'] ) && $data ['city_id'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= 'p.city_id=:city_id';
		$params [':city_id'] = $data ['city_id'];
		}

		if (isset ( $data ['budget_min'] ) && isset ( $data ['budget_max'] ) && $data ['budget_min'] != "" && $data ['budget_max'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= '(';
		$condition .= '(p.total_price>=:budget_min && p.total_price<=:budget_max)';
		$params [':budget_min'] = $data ['budget_min'];
		$params [':budget_max'] = $data ['budget_max'];

		if (isset ( $data [''] ) && $data ['without_budget'] != "") {
		$condition .= ' || p.total_price=:total_price';
		$params [':total_price'] = '';
		}
		$condition .= ')';
		}

		if (isset ( $data ['keyword'] ) && $data ['keyword'] != "") {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= '(p.property_name like :keyword || p.description like :keyword || p.features like :keyword || p.address like :keyword || p.furnished like :keyword || p.area_type like :keyword || p.landmarks like :keyword || p.facing like :keyword)';
		$params [':keyword'] = '%' . $data ['keyword'] . '%';
		}

		if (isset ( $data ['PropertyAmenities'] ) && $data ['PropertyAmenities'] != "") {
		$criteria->join = 'LEFT JOIN property_amenities pa on pa.property_id=p.id';
		if ($condition != '')
		$condition .= ' && ';
		$condition .= '(';
		$amenities = $data ['PropertyAmenities'];

		foreach ( $amenities as $i => $amenity ) {
		if ($i != 0)
		$condition .= ' || ';
		$condition .= 'pa.amenity_id=' . $amenity;
		}
		$condition .= ')';
		}
		if (! $data ['posted_by_all'] && isset ( $data ['posted_by'] )) {
		if ($condition != '')
		$condition .= ' && ';
		$condition .= ' ( ';
		$posted_by = $data ['posted_by'];
		foreach ( $posted_by as $i => $user ) {
		if ($i != 0)
		$condition .= ' || ';
		if ($user == "agent") {
		$condition .= 'p.user_id IN (SELECT user_id FROM user_agent_profile)';
		}
		if ($user == "builder") {
		$condition .= 'p.user_id IN (SELECT user_id FROM user_builder_profile)';
		}
		if ($user == "individuals") {
		$condition .= '(p.user_id NOT IN (SELECT user_id FROM user_agent_profile) && p.user_id NOT IN (SELECT user_id FROM user_builder_profile))';
		}
		}
		$condition .= ')';
		}
		if ($condition != null)
		$condition .= ' && ';
		$condition .= 'p.id NOT IN (SELECT property_id FROM project_properties)';
		$criteria->condition = $condition;
		$criteria->params = $params;
		//	$criteria->limit = '6';
		//	$properties = Property::model()->cache(1000, $dependency)->findAll($criteria);
		$properties = Property::model()->findAll($criteria);

		return $properties;
		/*$count=Property::model()->count($criteria);
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=1;
		$pages->applyLimit($criteria);

		$properties = Property::model()->findAll($criteria);

		$result['properties'] = $properties;
		$result['pages'] = $pages;


		return $result;*/
	}
	public static function getUnits($area){
		$units=array();
		if($area=='covered'){
			$units=array("Sq-ft"=>"Sq-ft","Sq-m"=>"Sq-m","Sq-yrd"=>"Sq-yrd");
		}
		elseif($area=='plot'){
			$units=array("Sq-ft"=>"Sq-ft","Sq-m"=>"Sq-m","Sq-yrd"=>"Sq-yrd","Acre"=>"Acre","Hectare"=>"Hectare","Ground"=>"Ground","Cent"=>"Cent");
		}
		return $units;
	}

	public static function searchPropertyWithCriteria($criteria=""){

		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM property');

		$properties = Property::model()->findAll($criteria);

		return $properties;
		/*$count=Property::model()->count($criteria);
		 $pages=new CPagination($count);

		 // results per page
		 $pages->pageSize=1;
		 $pages->applyLimit($criteria);

		 $properties = Property::model()->findAll($criteria);

		 $result['properties'] = $properties;
		 $result['pages'] = $pages;


		 return $result;*/
	}

	public static function getCriteriaObject($data){
		$criteria = new CDbCriteria;
		$criteria->alias = 'p';
		$criteria->with = array("locality","propertyType");
		$condition = null;
		$params = null;

		//	var_dump($data['i_want_to']);die();
		
		if(isset($data['i_want_to']) && $data['i_want_to']!=""){
			$condition.= 'LOWER(p.i_want_to)=:i_want_to';
			$params[':i_want_to'] = strtolower($data['i_want_to']);
		}
		if(isset($data['jackpot_investment']) && $data['jackpot_investment']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.jackpot_investment=:jackpot_investment';
			$params[':jackpot_investment'] = $data['jackpot_investment'];
		}
		if(isset($data['instant_home']) && $data['instant_home']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.instant_home=:instant_home';
			$params[':instant_home'] = $data['instant_home'];
		}
		if(isset($data['featured']) && $data['featured']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.featured=:featured';
			$params[':featured'] = $data['featured'];
		}
		if(isset($data['property_type_id']) && $data['property_type_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.property_type_id=:property_type_id';
			$params[':property_type_id'] = $data['property_type_id'];
		}
		if(isset($data['transaction_type_id']) && $data['transaction_type_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.transaction_type_id=:transaction_type_id';
			$params[':transaction_type_id'] = $data['transaction_type_id'];
		}
		if(isset($data['locality_id']) && !empty($data['locality_id']) && $data['locality_id']!='empty'){
			
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.locality_id=:locality_id';
			$params[':locality_id'] = $data['locality_id'];
		}
		if (isset ( $data['state_id'] ) && $data['state_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.state_id=:state_id';
			$params [':state_id'] = $data ['state_id'];
		}
		if (isset ( $data['city_id'] ) && $data['city_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
		}
		if(isset($data['age_of_construction']) && $data['age_of_construction']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.age_of_construction=:age_of_construction';
			$params[':age_of_construction'] = $data['age_of_construction'];
		}
		//var_dump($data['ownership_type']);die();
		if(isset($data['ownership_type_id']) && $data['ownership_type_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.ownership_type_id=:ownership_type_id';
			$params[':ownership_type_id'] = $data['ownership_type_id'];
		}

		$budget = true;
		if(isset($data['budget_min']) && isset($data['budget_max']) && $data['budget_min']!="" && $data['budget_max']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.='(';
			$condition.= '(p.total_price>=:budget_min && p.total_price<=:budget_max)';
			$params[':budget_min'] = (double)$data['budget_min'];
			$params[':budget_max'] = (double)$data['budget_max'];
		} elseif(isset($data['budget_min']) && $data['budget_min']!="") {
			if($condition!='')
			$condition.=' && ';
			$condition.='(';
			$condition.= '(p.total_price>=:budget_min)';
			$params[':budget_min'] = $data['budget_min'];
		} elseif(isset($data['budget_max']) && $data['budget_max']!="") {
			if($condition!='')
			$condition.=' && ';
			$condition.='(';
			$condition.= '(p.total_price<=:budget_max)';
			$params[':budget_max'] = $data['budget_max'];
		} else {
			$budget = false;
		}

		if($budget && isset($data['without_budget']) && $data['without_budget']=="1") {
			if($condition!='')
			$condition.= ' || (p.total_price=:total_price)';
			$params[':total_price'] = '0';
			$condition.=')';
		} elseif($budget){
			$condition.=')';
		} elseif(isset($data['without_budget']) && $data['without_budget']=="1"){
				
		}else{
			if($condition!='')
			$condition.= ' && (p.total_price!=:total_price)';
			else
			$condition.= '(p.total_price!=:total_price)';
			$params[':total_price'] = '0';
		}
		if(isset($data['keyword']) && $data['keyword']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= '(p.property_name like :keyword || p.description like :keyword || p.features like :keyword || p.address like :keyword || p.furnished like :keyword || p.area_type like :keyword || p.landmarks like :keyword || p.facing like :keyword)';
			$params[':keyword'] = '%'.$data['keyword'].'%';
		}
		if(isset($data['PropertyAmenities']) && $data['PropertyAmenities']!=""){
			$criteria->join = 'LEFT JOIN property_amenities pa on pa.property_id=p.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$amenities = $data['PropertyAmenities'];

			foreach($amenities as $i=>$amenity){
				if($i!=0)
				$condition.=' || ';
				$condition.='pa.amenity_id='.$amenity;
			}
			$condition.= ')';
				
			//	var_dump($condition);die();
		}
		if(!isset($data['posted_by_all']) && isset($data['posted_by'])){
			if($condition!='')
			$condition.=' && ';
			$condition.=' ( ';
			$posted_by = $data['posted_by'];
			foreach($posted_by as $i=>$user){
				if($i!=0)
				$condition.=' || ';
				if($user=="agent"){
					$condition.='p.user_id IN (SELECT user_id FROM user_agent_profile)';
				}
				if($user=="builder"){
					$condition.='p.user_id IN (SELECT user_id FROM user_builder_profile)';
				}
				if($user=="individuals"){
					$condition.='(p.user_id NOT IN (SELECT user_id FROM user_agent_profile) && p.user_id NOT IN (SELECT user_id FROM user_builder_profile))';
				}
			}
			$condition.= ')';
		}
		if(isset($data['agent_id']) && $data['agent_id']!=""){
			die();
			if($condition!='')
			$condition.=' && ';
			$condition.='p.user_id IN (SELECT user_id FROM user_agent_profile where id=:agent_id)';
			$params[':agent_id'] = $data['agent_id'];
		}
		if(isset($data['new_launches']) && $data['new_launches']=="1"){
			if($condition!='')
			$condition.=' && ';
			$newLaunch= date("Y-m-d",time()- (Yii::app()->params['newLaunchNoOfDays'] * 24 * 60 * 60));
			$condition.= '(p.created_time > :newLaunch)';
			$params[':newLaunch'] = $newLaunch;
		}
		if($condition!=null)
		$condition.=' && ';
		$condition.='p.id NOT IN (SELECT property_id FROM project_properties)';
		$criteria->condition = $condition;
		$criteria->params = $params;
	//		var_dump($params);
	//	 die();
		return $criteria;
	}
	
	public static function getCriteriaObjectForRequirement($data){
		$criteria = new CDbCriteria;
		$criteria->alias = 'p';
		$condition = null;
		$params = null;

		//	var_dump($data['i_want_to']);die();
		
		if(isset($data['i_want_to']) && $data['i_want_to']!=""){
			$condition.= 'LOWER(p.i_want_to)=:i_want_to';
			$params[':i_want_to'] = strtolower($data['i_want_to']);
		}
		if(isset($data['min_price']) && isset($data['max_price']) && $data['min_price']!="" && $data['max_price']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= '(p.total_price>=:min_price && p.total_price<=:max_price)';
			$params[':min_price'] = (double)$data['min_price'];
			$params[':max_price'] = (double)$data['max_price'];
		} elseif(isset($data['min_price']) && $data['min_price']!="") {
			if($condition!='')
			$condition.=' && ';
			$condition.= '(p.total_price>=:min_price)';
			$params[':min_price'] = $data['min_price'];
		} elseif(isset($data['max_price']) && $data['max_price']!="") {
			if($condition!='')
			$condition.=' && ';
			$condition.= '(p.total_price<=:max_price)';
			$params[':max_price'] = $data['max_price'];
		}
		if(isset($data['property_type_id']) && $data['property_type_id']!=""){
			if($condition!='')			
			$condition.=' && ';
			$condition.= '(';
			$propertytypes = $data['property_type_id'];
			foreach($propertytypes as $i=>$propertytype){
				if($i!=0)
				$condition.=' || ';
				$condition.='p.property_type_id='.$propertytype;
			}
			$condition.= ')';
			
		}
		if(isset($data['bedrooms']) && $data['bedrooms']!=""){
			if($condition!='')			
			$condition.=' && ';
			$condition.= '(';
			$bedrooms = $data['bedrooms'];
			foreach($bedrooms as $i=>$bedroom){
				if($i!=0)
				$condition.=' || ';
				$condition.='p.bedrooms='.strval($bedroom);
			}
			$condition.= ')';
			
		}
		if (isset ( $data['city_id'] ) && $data['city_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition.= '(';
			$cityids = $data['city_id'];
			foreach($cityids as $i=>$cityid){
				if($i!=0)
				$condition.=' || ';
				$condition.='p.city_id='.$cityid;
			}
			$condition.= ')';
		}
		
		if(isset($data['PropertyAmenities']) && $data['PropertyAmenities']!=""){
			$criteria->join = 'LEFT JOIN property_amenities pa on pa.property_id=p.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$amenities = $data['PropertyAmenities'];

			foreach($amenities as $i=>$amenity){
				if($i!=0)
				$condition.=' || ';
				$condition.='pa.amenity_id='.$amenity;
			}
			$condition.= ')';
				
			//	var_dump($condition);die();
		}
		
		if($condition!=null)
		$condition.=' && ';
		$condition.='p.id NOT IN (SELECT property_id FROM project_properties)';
		$criteria->condition = $condition;
		$criteria->params = $params;
	//		var_dump($params);
	//	 die();
		return $criteria;
	}
	
}