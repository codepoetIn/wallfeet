<?php

class UserBuilderProjectTypeApi {
	public static function createProjectTypes($builderId, $projectTypeIds) {
		
		$result = true;
		foreach ( $projectTypeIds as $projectTypeId ) {
			$userProjectType = new UserBuilderProjectType ();
			$userProjectType->builder_id = $builderId;
			$userProjectType->project_type_id  = $projectTypeId;
			$result = $result && $userProjectType->save ();
		}
		
		return $result;
	}
	public static function deleteProjectTypes($builderId){
		return UserBuilderProjectType::model()->deleteAll('builder_id=:builderId',array(':builderId'=>$builderId));
	}
public static function getProjectTypes($builderId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'builder_id=:builderId';
		$criteria->params = array(':builderId' => $builderId);
		$result = UserBuilderProjectType::model()->findAll($criteria);
		if($result)
		return $result;
		else
		false;
	}
}
?>