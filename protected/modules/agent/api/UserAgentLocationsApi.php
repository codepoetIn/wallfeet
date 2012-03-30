<?php

class UserAgentLocationsApi {
	public static function createLocations($agentId, $cityIds) {
		
		$result = true;
		foreach ( $cityIds as $cityId ) {
			$userLocations = new UserAgentLocations ();
			$userLocations->agent_id = $agentId;
			$userLocations->city_id  = $cityId;
			$result = $result && $userLocations->save ();
		}
		
		return $result;
	}
	public static function deleteLocations($agentId){
		return UserAgentLocations::model()->deleteAll('agent_id=:agentId',array(':agentId'=>$agentId));
	}
	
	public static function getLocations($agentId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'agent_id=:agentId';
		$criteria->params = array(':agentId' => $agentId);
		$result = UserAgentLocations::model()->findAll($criteria);
		if($result)
		return $result;
		else
		false;
	}
}
?>