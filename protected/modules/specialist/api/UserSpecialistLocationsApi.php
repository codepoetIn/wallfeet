<?php
class UserSpecialistLocationsApi {
	
public static function createLocations($specialistId, $cityIds) {
		
		$result = true;
		
		foreach ( $cityIds as $cityId ) {
			$userLocations = new UserSpecialistLocations ;
			$userLocations->specialist_id = $specialistId;
			$userLocations->city_id  = $cityId;
			$result = $result && $userLocations->save ();
			
		}
		
		return $result;
	}
	public static function deleteLocations($specialistId){
		return UserSpecialistLocations::model()->deleteAll('specialist_id=:specialist_id',array(':specialist_id'=>$specialistId));
	}
	
	public static function getLocations($specialistId)
	{
		$criteria = new CDbCriteria ();
		$criteria->condition = 'specialist_id=:specialist_id';
		$criteria->params = array(':specialist_id' => $specialistId);
		$result = UserSpecialistLocations::model()->findAll($criteria);
		if($result)
		return $result;
		else
		false;
	}
}