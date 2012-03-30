<?php

class UserApi {

	public static function activateCode($code,$email){
		$criteria = new CDbCriteria;
		$criteria->condition = 'email_id=:emailId AND activation_code=:activationCode';
		$criteria->params = array(':emailId'=>$email,':activationCode'=>$code);
		$model = UserCredentials::model()->find($criteria);
		if($model){
			if($model->status!='ACTIVE'){
				$model->status = 'ACTIVE';
				return $model->save();
			}else 
			return $model;			
		}
		else
		return false;
	}

	public static function getUserByEmail($email){
		$criteria = new CDbCriteria;
		$criteria->condition = 'email_id=:emailId';
		$criteria->params = array(':emailId'=>$email);
		$model = UserCredentials::model()->find($criteria);
		if($model){
			return $model;
		}
		else
		return false;
	}

	public static function getProfilesUserIds($model,$attribute)
	{
		foreach ($model as $read)
		{
			$readInboxID[]=$read->$attribute;

		}
		$criteria = new CDbCriteria;
		$criteria->addInCondition('user_id',$readInboxID);
		$users = UserProfiles::model()->findAll($criteria);
		$user_data = '';
		foreach($users  as $user){
			$userdata[$user->user_id] = $user->first_name;
		}
		return $userdata;
	}
	public static function populateCredentialsModel($data=null,$scenario=null){
		$model = new UserCredentials($scenario);
		$model->attributes = $data;
		return $model;
	}

	public static function populateProfilesModel($data=null,$scenario=null){
		$model = new UserProfiles($scenario);
		$model->attributes = $data;
		return $model;
	}

	public static function getUserProfileDetails($userId){
		$userProfile = UserProfiles::model()->find('user_id=:userId',array(':userId'=>$userId));
		return $userProfile;
	}
	public static function getUserCredentials($userId){
		$userCredentials = UserCredentials::model()->find('id=:Id',array(':Id'=>$userId));
		return $userCredentials;
	}
	public static function getUser($userId){
		$userModel = UserCredentials::model()->findByPk($userId);
		$result = false;
		if($userModel){
			$userProfile = UserProfiles::model()->find("user_id=:userId",array(":userId"=>$userId));
			if($userProfile){
				$result = ArrayUtils::mergeArray($userModel->getAttributes(),$userProfile->getAttributes());
			}else {
				$result = $userModel->getAttributes();
			}
		}

		return $result;
	}
	public static function updateUser($profilesModel,$userId)
	{
		if($profilesModel)
		{
			$model=new UserProfiles();
			$model->attributes=$profilesModel;
			UserProfiles::model()->delete('user_id=:userId',array(':userId'=>$userId));
			$model->save();
			return true;
			
		}
	}
	public static function createUser($credential,$profile,$role="Member"){
		$password = $credential->password;
		$credential->salt = SecurityUtils::generateSalt($credential->email_id);
		$credential->activation_code = SecurityUtils::generateRandomString(10);
		$credential->registered_ip = SecurityUtils::getRealIp();
		$credential->password = SecurityUtils::encryptPassword($credential->password,$credential->salt);
		$credential->password_confirm = $credential->password;
		if($credential->save()) {
			$profile->user_id = $credential->id;
			if($profile->save()){
				$assignment = new Assignments;
				$assignment->itemname = $role;
				$assignment->userid = $credential->id;
				$assignment->data = 's:0:"";';
				$assignment->save();
				return array('credential'=>$credential,'profile'=>$profile);
			}else {
				$credential->delete();
				$credential->setIsNewRecord(true);
				return false;
			}
		} else {
			$credential->password = $password;
			$credential->password_confirm = $password;
			return false;
		}

	}

	public static function verifyUser($id){
		$model = UserCredentials::model()->findByPk($id);
		if($model){
			$model->status = "ACTIVE";
			$model->save();
		}else {
			return false;
		}
	}

	public static function getRoles(){

	}

	public static function canPostProperty(){

	}

	public static function canPostProject(){

	}

	public static function canBeSpecialist(){

	}

	public static function canBeBuilder(){

	}



	public static function canViewAgentContact(){

	}

	public static function canViewBuilderContact(){

	}

	public static function canViewSellerContact(){

	}

	public static function canViewBuyerContact(){

	}
	public static function searchUserWithCriteria($criteria)
	{
		$users = UserCredentials::model()->findAll($criteria);
		return $users;
	}
	public static function getCriteriaObject($data)
	{
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

		if(($data['user_type']=="agent" || $data['user_type']=="builder") && isset($data['property_type_id']) && $data['property_type_id']!=null){
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
		elseif($data['user_type']=="specialist" && isset($data['specialist_type_id']) && $data['specialist_type_id']!=null){

			$criteria->join.=' LEFT JOIN user_specialist_type ust on ust.user_id=uc.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$specialistTypes = $data['specialist_type_id'];
			foreach($specialistTypes as $i=>$specialistType){
				if($i!=0)
				$condition.=' || ';
				$condition.='ust.specialist_type_id='.$specialistType;
			}
			$condition.= ')';
		}
		if($condition!='')
		$condition.=' && ';
		if($data['user_type']=="agent"){
			$condition.='uc.id IN (SELECT user_id FROM user_agent_profile)';
		}
		if($data['user_type']=="builder"){
			$condition.='uc.id IN (SELECT user_id FROM user_builder_profile)';
		}
		if($data['user_type']=="specialist"){
			$condition.='uc.id IN (SELECT user_id FROM user_specialist_profile)';
		}

		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		return $criteria;
	}
	public static function searchUser($data){
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

		if(($data['user_type']=="agent" || $data['user_type']=="builder") && isset($data['property_type_id']) && $data['property_type_id']!=null){
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
		elseif($data['user_type']=="specialist" && isset($data['specialist_type_id']) && $data['specialist_type_id']!=null){

			$criteria->join.=' LEFT JOIN user_specialist_type ust on ust.user_id=uc.id';
			if($condition!='')
			$condition.=' && ';
			$condition.= '(';
			$specialistTypes = $data['specialist_type_id'];
			foreach($specialistTypes as $i=>$specialistType){
				if($i!=0)
				$condition.=' || ';
				$condition.='ust.specialist_type_id='.$specialistType;
			}
			$condition.= ')';
		}
		if($condition!='')
		$condition.=' && ';
		if($data['user_type']=="agent"){
			$condition.='uc.id IN (SELECT user_id FROM user_agent_profile)';
		}
		if($data['user_type']=="builder"){
			$condition.='uc.id IN (SELECT user_id FROM user_builder_profile)';
		}
		if($data['user_type']=="specialist"){
			$condition.='uc.id IN (SELECT user_id FROM user_specialist_profile)';
		}

		if($condition!=null){
			$criteria->condition = $condition;
			$criteria->params = $params;
		}
		$users = UserCredentials::model()->findAll($criteria);

		return $users;
	}
	public static function getNameByUserId($userId){
		$userProfile = self::getUserProfileDetails($userId);
		if($userProfile){
			return $userProfile->first_name." ".$userProfile->last_name;
		}
		return null;

	}


	public static function getUserList()
	{
		$userProfiles = UserProfiles::model()->findAll();
		$result = null;
		if($userProfiles) {
			foreach($userProfiles as $names){
				$result[$names->user_id] =	$names->first_name." ".$names->last_name;
			}
			return $result;
		}
		return false;


	}

	public static function getUserById($id){
		return UserCredentials::model()->findByPk($id);
	}
	
	public static function getAllStatus()
	{
		$result=null;
	$result=array('EMAIL_NOT_VERIFIED','IDENTITY_NOT_VERIFIED','ACTIVE','INVALID_IDENTITY','INACTIVE','DELETED');
	return $result;
	}
	
	public static function getAllgender()
	{
		$result=null;
	$result=array('male','female','transgender');
	return $result;
	}

}


?>