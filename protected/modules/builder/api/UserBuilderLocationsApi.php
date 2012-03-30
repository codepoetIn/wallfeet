<?php

class UserBuilderLocationsApi {
	public static function createLocations($builderId, $cityIds) {
		
		$result = true;
		
		foreach ( $cityIds as $cityId ) {
			
			$userLocations = new UserBuilderLocations ();
			$userLocations->builder_id = $builderId;
			$userLocations->city_id  = $cityId;
			$result = $result && $userLocations->save ();
		}
		
		return $result;
	}
	public static function deleteLocations($builderId){
		return UserBuilderLocations::model()->deleteAll('builder_id=:builderId',array(':builderId'=>$builderId));
	}
	
	public static function getLocations($builderId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'builder_id=:builderId';
		$criteria->params = array(':builderId' => $builderId);
		$result = UserBuilderLocations::model()->findAll($criteria);
		if($result)
		return $result;
		else
		false;
	}
}
?>