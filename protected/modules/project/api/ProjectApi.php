<?php

class ProjectApi {
	/**
	 * This method is used to get all projects.
	 * Returns model if successfully found.
	 * Returns false if not found.
	 *
	 * @return model || false
	 */

	public static function getAllProjects() {
		$projects = Projects::model ()->findAll ();
		if ($projects)
		return $projects;
		else
		return false;
	}

	/**
	 * This method returns the project based on project id.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $projectId
	 * @return model || null
	 */

	public static function getProjectById($projectId) {
		return Projects::model ()->findByPk ( $projectId );
	}

	/**
	 * This method returns the projects of a particular user.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $userId
	 * @return model || false
	 */
	public static function getCriteriaObjectForUser($userId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		return $criteria;
	}
	public static function searchMyPropertyWithCriteria($criteria)
	{
		$projects = Projects::model ()->findAll ( $criteria );
		if ($projects)
		return $projects;
		else
		return false;
	}
	public static function getProjectsOfUser($userId,$count='') {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		if($count)
		$criteria->limit = $count;
		$projects = Projects::model ()->findAll ( $criteria );
		if ($projects)
		return $projects;
		else
		return false;
	}
	public static function getProjectsofUserCount($userid) {
		$count = self::getProjectsOfUser ( $userid );
		if ($count)
		return count ( $count );
		else
		return 0;
	}



	public static function getProjectTypesByUserId($userId) {
		$criteria = new CDbCriteria ();
		$criteria->select = 'project_type_id';
		$criteria->distinct = true;
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$projects = Projects::model ()->findAll ( $criteria );
		if ($projects)
		return $projects;
		else
		return false;
	}


	public static function getSimilarProjects($projects, $limit) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'project_type_id=:project_type_id OR city_id=:city_id OR locality_id=:locality_id OR ownership_type_id=:ownership_type_id';
		$criteria->params = array (':project_type_id' => $projects->project_type_id,':city_id'=>$projects->city_id,':locality_id' => $projects->locality_id, ':ownership_type_id' => $projects->ownership_type_id );
		$criteria->order = 'created_time DESC';
		if($limit)
		$criteria->limit=$limit;
		$similarproject = Projects::model ()->findAll ( $criteria );
		if ($similarproject) {
			return $similarproject;
		} else
		return false;

	}
	/*public static function searchProjects($data);*/

	/**
	 * This method accepts a project id and an array of data and updates the model.
	 * Returns true if successfully updated.
	 * Returns the error validated model if validation fails.
	 * Returns false if the project id is not found.
	 *
	 * data array may have the following hash keys -
	 * 1. user_id
	 * 2. project_name
	 * 3. description
	 * 4. ownership_types_id
	 * 5. locality_id
	 * 6. jackpot_investment
	 * 7. bedrooms
	 * 8. features
	 * 9. cover_area
	 * 10.land_area
	 * 11. min_price
	 * 12. max_price
	 * 13. price_starting_from
	 * 14. per_unit_price
	 * 15. area_type
	 * 16. display_price
	 * 17. price_negotiable
	 * 18. landmarks
	 * 19. tax_fees
	 * 20. terms_and_conditions
	 * 21. views
	 * 22. recently_viewed
	 *
	 * @param string $projectId
	 * @param array $data
	 * @return model||model with errors|| false
	 */

	public static function updateProjectById($projectId, $data) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->attributes = $data;
			$project->save ();
			return $project;
		} else {
			return false;
		}

	}

	/**
	 * This method accepts project id and deletes the record.
	 * Returns true if successfully deleted.
	 * Returns false if deletion fails.
	 *
	 * @param string $projectId
	 * @return true || false
	 */

	public static function deleteProjectById($projectId) {
		return Projects::model ()->deleteByPk ( $projectId );
	}

	/**
	 * This method accepts user's id and an array of data and creates the model.
	 * Returns model if successfully created.
	 * Returns the error validated model if validation fails.
	 *
	 * data array may have the following hash keys -
	 * 1. user_id
	 * 2. project_name
	 * 3. description
	 * 4. ownership_types_id
	 * 5. locality_id
	 * 6. jackpot_investment
	 * 7. bedrooms
	 * 8. features
	 * 9. cover_area
	 * 10.land_area
	 * 11. min_price
	 * 12. max_price
	 * 13. price_starting_from
	 * 14. per_unit_price
	 * 15. area_type
	 * 16. display_price
	 * 17. price_negotiable
	 * 18. landmarks
	 * 19. tax_fees
	 * 20. terms_and_conditions
	 * 21. views
	 * 22. recently_viewed
	 *
	 * @param array $data,string $userId
	 * @return model || model with errors
	 */

	public static function createProject($userId, $data) {
		$project = new Projects ();
		$project->attributes = $data;
		$project->user_id = $userId;
		$project->save ();
		return $project;
	}

	/**
	 * This method finds whether the user has any project or not.
	 * Returns true if user has project.
	 * Returns the false if the user doesnot have any project.
	 *
	 * @param string $userId
	 * @return true || false
	 */
	public static function hasProject($userId) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'user_id=:userId';
		$criteria->params = array (':userId' => $userId );
		$projects = Projects::model ()->findAll ( $criteria );
		if ($projects)
		return true;
		else
		return false;
	}

	/**
	 * This method returns the owner of a particular project.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $projectId
	 * @return model || false
	 */
	public static function getOwner($projectId) {
		$criteria = new CDbCriteria ();
		$criteria->select = 'user_id';
		$criteria->condition = 'id=:projectId';
		$criteria->params = array (':projectId' => $projectId );
		$project = Projects::model ()->find ( $criteria );
		if ($userId) {
			$criteria = new CDbCriteria ();
			$criteria->condition = 'user_id=:userId';
			$criteria->params = array (':userId' => $project->user_id );
			$userprofile = UserProfiles::model ()->find ( $criteria );
			$usercredentials = UserApi::getUserDetails ( $project->user_id );
			$userdetails = ArrayUtils::mergeArray ( $usercredentials->getAttributes (), $userprofile->getAttributes () );
			return $userdetails;
		} else
		return false;
	}

	/**
	 * This method gets the count and returns the top projects
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param string $count
	 * @return model || boolean
	 */

	// Check Top Rated and use Random order
	public static function getTopProjects($count) {

		if ($count)
		$sql = 'SELECT * from projects JOIN
					(SELECT project_id from project_rating r 
						GROUP BY r.project_id 
						order by AVG(r.rate) DESC LIMIT ' . "$count" . ')
 					AS ratings ON (project.id=ratings.project_id) ORDER BY rand()';
		$sql = 'SELECT * from projects JOIN
					(SELECT project_id from project_rating r 
						GROUP BY r.project_id 
						order by AVG(r.rate) DESC)
 					AS ratings ON (project.id=ratings.project_id) ORDER BY rand()';
		$projects = Yii::app ()->db->createCommand ( $sql )->queryAll ();

		if ($projects)
		return $projects;
		else
		return false;

		/*$criteria=new CDbCriteria;
		 $criteria->limit=$count;
		 $criteria->order='rand()';
		 $criteria->with = 'projectRatings r';
		 $criteria->order='MAX(AVG(r.rate))';
		 $projects=Project::model()->findAll($criteria);
		 if($projects)
		 return $projects;
		 else
		 return false;*/

	}
	/**
	 * This method gets the count and returns the featured project
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param string $count
	 * @return model || boolean
	 */

	// Use Random order
	public static function getFeaturedProjects($count) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'featured=:featured';
		$criteria->params = array (':featured' => 1 );
		if ($count)
		$criteria->limit = $count;
		$criteria->order = 'rand()';
		$projects = Projects::model ()->findAll ( $criteria );
		if ($projects)
		return $projects;
		else
		return false;
	}
	/**
	 * This method gets the count and returns the jackpot project
	 * Returns the model if found.
	 * Returns false if not found.
	 *
	 * @param string $count
	 * @return model || boolean
	 */

	// Use Random order
	public static function getJackpotProjects($count) {
		$criteria = new CDbCriteria ();
		$criteria->condition = 'jackpot_investment=:jackpot_investment';
		$criteria->params = array (':jackpot_investment' => 1 );
		if ($count)
		$criteria->limit = $count;
		$citeria->order = 'rand()';
		$projects = Projects::model ()->findAll ( $criteria );
		if ($projects)
		return $projects;
		else
		return false;
	}

	/**
	 * This method gets the project id and creates a new jackpot
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return boolean
	 */
	public static function makeJackpot($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->jackpot_investment = 1;
			return $project->save ();
		} else
		return false;
	}

	/**
	 * This method gets the project id and removes the jackpot
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return boolean
	 */
	public static function removeJackpot($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->jackpot_investment = 0;
			return $project->save ();
		} else
		return false;
	}

	/**
	 * This method gets the project id and creates a new instant earning
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return model || boolean
	 */
	public static function makeInstantEarnings($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->instant_home = 1;
			return $project->save ();
		} else
		return false;
	}

	/**
	 * This method gets the project id and removes the instant earning
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return model || boolean
	 */
	public static function removeInstantEarnings($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->instant_home = 0;
			return $project->save ();
		} else
		return false;
	}

	/**
	 * This method gets the project id and creates a new featured
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return boolean
	 */
	public static function makeFeatured($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->featured = 1;
			return $project->save ();
		} else
		return false;

	}

	/**
	 * This method gets the project id and removes the featured
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return boolean
	 */
	public static function removeFeatured($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		if ($project) {
			$project->featured = 0;
			return $project->save ();
		} else
		return false;

	}

	/**
	 * This method returns the project type for a project id.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $projectId
	 * @return model || false
	 */
	/*public static function getProjectType($projectId){
		$project=Project::model()->findByPk($projectId);
		if($project){
		$typesModel=ProjectTypes::model()->findByPk($project->project_type_id);
		if($typesModel)
		return $typesModel->project_type;
		else
		return false;
		}
		else
		return false;
		}*/
	/**
	 * This method returns the transaction type for a project id.
	 * Returns model if successfully found.
	 * Returns the false if not found.
	 *
	 * @param string $projectId
	 * @return model || false
	 */

	/*public static function getTransactionType($projectId){
		$project=Project::model()->findByPk($projectId);
		if($project){
		$transactionTypes=ProjectTransactionTypes::model()->findByPk($project->transaction_type_id);
		if($transactionTypes)
		return $transactionTypes->transaction_type;
		else
		return false;
		}
		else
		return false;
		}*/

	/**
	 * This method returns the location for the given project id
	 * Returns true if sucessfull.
	 * Returns false if not successfull.
	 *
	 * @param string $projectId
	 * @return model || boolean
	 */

	// Return locality, city, state and country as asn hashed array
	public static function getLocation($projectId) {
		$project = Projects::model ()->findByPk ( $projectId );
		$address [] = "";
		if ($project) {
			$locality = isset($_POST['GeoLocality']['locality_id'])? $_POST['GeoLocality']['locality_id'] : '';
			if($locality)
			{
				$locality = GeoLocality::model ()->findByPk ( $project->locality_id );
				$address ['locality'] = $locality ? $locality->locality : "";
				$city = GeoCity::model ()->findByPk ( $locality->city_id );
				$address ['city'] = $city->city;
				$state = GeoState::model ()->findByPk ( $city->state_id );
				$address ['state'] = $state->state;
				$country = GeoCountry::model ()->findByPk ( $state->country_id );
				$address ['country'] = $country->country;
				return $address;
			}
		} else
		return false;
	}


	public static function getCriteriaObject($data)
	{
		$criteria = new CDbCriteria ();
		$criteria->alias = 'p';
		$criteria->with = 'locality';
		$condition = null;
		$params = null;

		if(isset($data['project_type_id']) && $data['project_type_id']!=""){
			if($condition!='')
			$condition.=' && ';
			$condition.= 'p.project_type_id=:project_type_id';
			$params[':project_type_id'] = $data['project_type_id'];
		}
		if (isset ( $data ['locality_id'] ) && $data ['locality_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.locality_id=:locality_id';
			$params [':locality_id'] = $data ['locality_id'];
		}

		if (isset ( $data ['city_id'] ) && $data ['city_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.city_id=:city_id';
			$params [':city_id'] = $data ['city_id'];
		}

		if (isset ( $data ['ownership_type_id'] ) && $data ['ownership_type_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.ownership_type_id=:ownership_type_id';
			$params [':ownership_type_id'] = $data ['ownership_type_id'];
		}
		if (isset ( $data ['state_id'] ) && $data ['state_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.state_id=:state_id';
			$params [':state_id'] = $data ['state_id'];
		}
		if(isset($data['new_launches']) && $data['new_launches']=="1"){
			if($condition!='')
			$condition.=' && ';
			$newLaunch= date("Y-m-d",time()- (Yii::app()->params['newLaunchNoOfDays'] * 24 * 60 * 60));
			$condition.= '(p.created_time > :newLaunch)';
			$params[':newLaunch'] = $newLaunch;
		}

		/*if (isset ( $data ['budget_min'] ) && isset ( $data ['budget_max'] ) && $data ['budget_min'] != "" && $data ['budget_max'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(';
			$condition .= '(p.total_price>=:budget_min && p.total_price<=:budget_max)';
			$params [':budget_min'] = $data ['budget_min'];
			$params [':budget_max'] = $data ['budget_max'];
			$condition .= ')';
			}*/

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
			$params[':total_price'] = '0';
		}

		if (isset ( $data ['keyword'] ) && $data ['keyword'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(p.project_name like :keyword || p.description like :keyword || p.features like :keyword)';
			$params [':keyword'] = '%' . $data ['keyword'] . '%';
		}

		if (isset ( $data ['ProjectAmenities'] ) && $data ['ProjectAmenities'] != "") {
			$criteria->join = 'LEFT JOIN project_amenities pa on pa.project_id=p.id';
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(';
			$amenities = $data ['ProjectAmenities'];

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
		if ($condition != null) {
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		return $criteria;
	}
	public static function searchProjectWithCriteria($criteria)
	{
		$projects = Projects::model ()->findAll ( $criteria );
		return $projects;
	}
	public static function searchProject($data) {

		$criteria = new CDbCriteria ();
		$criteria->alias = 'p';
		$criteria->with = 'locality';
		$condition = null;
		$params = null;

		if (isset ( $data ['locality_id'] ) && $data ['locality_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.locality_id=:locality_id';
			$params [':locality_id'] = $data ['locality_id'];
		}

		if (isset ( $data ['ownership_types_id'] ) && $data ['ownership_types_id'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= 'p.ownership_types_id=:ownership_types_id';
			$params [':ownership_types_id'] = $data ['ownership_types_id'];
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
			$condition .= ')';
		}

		if (isset ( $data ['keyword'] ) && $data ['keyword'] != "") {
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(p.project_name like :keyword || p.description like :keyword || p.features like :keyword)';
			$params [':keyword'] = '%' . $data ['keyword'] . '%';
		}

		if (isset ( $data ['ProjectAmenities'] ) && $data ['ProjectAmenities'] != "") {
			$criteria->join = 'LEFT JOIN project_amenities pa on pa.project_id=p.id';
			if ($condition != '')
			$condition .= ' && ';
			$condition .= '(';
			$amenities = $data ['ProjectAmenities'];

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
		if ($condition != null) {
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		$projects = Projects::model ()->findAll ( $criteria );
		return $projects;
	}
public static function getViews($Id)
	{
		$project = Projects::model ()->find ( 'id=:project_Id', array (':project_Id' => $Id ) );
		return $project;	
	}
	
	public static function setViews($Id)
	{
		$project = Projects::model ()->find ( 'id=:project_Id', array (':project_Id' => $Id ) );
		if ($project) {
			if($project->views== null)
			{
				$project->views=0;
				
			}
			else
			{
				$projectviews=$project->views+1;
				$project->views=$projectviews;
				$project->recently_viewed=Yii::app ()->user->id;
					
			}
			$project->save();
				
		}
		else
		return false;
	}

}