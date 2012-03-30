<?php

class UserAgentPropertyTypeApi {
	public static function createPropertyTypes($agentId, $propertyTypeIds) {
		
		$result = true;
		foreach ( $propertyTypeIds as $propertyTypeId ) {
			$userPropertyType = new UserAgentPropertyType ();
			$userPropertyType->agent_id = $agentId;
			$userPropertyType->property_type_id  = $propertyTypeId;
			$result = $result && $userPropertyType->save ();
		}
		
		return $result;
	}
	public static function deletePropertyTypes($agentId){
		return UserAgentPropertyType::model()->deleteAll('agent_id=:agentId',array(':agentId'=>$agentId));
	}
	
	public static function getPropertyTypes($agentId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'agent_id=:agentId';
		$criteria->params = array(':agentId' => $agentId);
		$result = UserAgentPropertyType::model()->findAll($criteria);
		if($result)
		return $result;
		else
		false;
	}
}
?>