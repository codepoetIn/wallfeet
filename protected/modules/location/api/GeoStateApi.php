<?php

class GeoStateApi {

	public static function getList($country_id){
		$model=GeoState::model()->findAll('country_id=:country_id',array(':country_id'=>$country_id));
		$stateList = null;
		foreach($model as $state){
			$stateList[$state->id] = $state->state;
		}
		return $stateList;
	}

	public static function getStateListByCountry($country = 'india'){
		$country = GeoCountry::model()->find('LOWER(country)=:country',array('country'=>$country));
		if($country){
			$model=GeoState::model()->findAll('country_id=:country_id',array(':country_id'=>$country->id));
			$stateList = null;
			foreach($model as $state){
				$stateList[$state->id] = $state->state;
			}
			return $stateList;
		} else 
		return array();
	}
	
	public static function getState($stateName){
		$model=GeoState::model()->find('LOWER(state)=:stateName',array(':stateName'=>strtolower(trim($stateName))));
		if($model)
		return $model;
		
	}
public static function getStatesId($state){
		if($state){
			$model=GeoState::model()->findAll('SELECT id from GeoCity where id IN :b', array(':b'=>$state));
			return $model;
		}
		else
			return '';
		
	}
}