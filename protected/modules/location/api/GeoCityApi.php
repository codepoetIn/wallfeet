<?php

class GeoCityApi {
	public static function getLists($stateIds)
	{
		$cityLists='';
		foreach($stateIds as $stateid)
		{
			$cityLists=ArrayUtils::mergeArray($cityLists,self::getList($stateid));
				
		}
		return $cityLists;
	}
	public static function getList($state_id) {
		$model=GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$state_id));
		$cityList = null;
		foreach($model as $city){
			$cityList[$city->id] = $city->city;
		}
		return $cityList;
	}
	
	public static function getCityList() {
		$model=GeoCity::model()->findAll();
		$cityList = null;
		foreach($model as $city){
			$cityList[$city->id] = $city->city;
		}
		return $cityList;
	}


	public static function getCityNameByID($cityID)	{
		$model=GeoCity::model()->findByPk($cityID);
		return $model;
	}

	public static function getCityByName($cityName)	{
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_city');
		return GeoCity::model()->find('lower(city)=:city',array(':city'=>strtolower($cityName)));
	}

	public static function getTopPrioritiesByCountry($countryId,$excludeCityId='',$count='',$metroOnly=true){
		$dependencyState = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_state');
		$stateModels = GeoState::model()->cache(1000, $dependencyState)->findAll('country_id=:countryId',array(':countryId'=>$countryId));
		if(empty($stateModels))
		return false;
		foreach($stateModels as $state){
			$states[] = $state->id;
		}

		$criteria = new CDbCriteria();
		$criteria->addInCondition('state_id',$states);
		
		if($metroOnly)
		$criteria->addCondition('metro=1');
		
		if($count)
		$criteria->limit = $count;

		if($excludeCityId){
			//$criteria->addCondition('id=!id',array(':id'=>$excludeCityId));
			$criteria->addCondition("id!=$excludeCityId");
		}
		$criteria->order = 'priority';
		$dependencyCity = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_city');
		//$cities = GeoCity::model()->cache(1000, $dependencyCity)->findAll($criteria);
		$cities = GeoCity::model()->findAll($criteria);

		if(!empty($cities))
		return $cities;
		else
		return false;
	}

	public static function getTopPrioritiesInternational($excludeCityId='',$count='',$metroOnly=true){
		$dependencyState = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_state');
		$india = GeoCountryApi::getCountryByName('india');
		if($india){
			$stateModels = GeoState::model()->cache(1000, $dependencyState)->findAll('country_id!=:countryId',array(':countryId'=>$india->id));
			if(empty($stateModels))
			return false;
			foreach($stateModels as $state){
				$states[] = $state->id;
			}

			$criteria = new CDbCriteria();
			$criteria->addInCondition('state_id',$states);
			
			if($metroOnly)
			$criteria->addCondition('metro=1');
			
			if($count)
			$criteria->limit = $count;

			if($excludeCityId){
				//$criteria->addCondition('id=!id',array(':id'=>$excludeCityId));
				$criteria->addCondition("id!=$excludeCityId");
			}
			$criteria->order = 'priority ASC';
			$dependencyCity = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_city');
			$cities = GeoCity::model()->cache(1000, $dependencyCity)->findAll($criteria);

			if(!empty($cities))
			return $cities;
			else
			return false;
		}

	}

	public static function searchDomestic(){
		$criteria=new CDbCriteria;
		$model = new GeoCity();
		$criteria->compare('id',$model->id);
		$criteria->compare('city',$model->city,true);
		$criteria->compare('metro',$model->metro);
		$criteria->compare('priority',$model->priority);
		$criteria->compare('state_id',$model->state_id);
		/*		$criteria->compare('updated_time',$model->updated_time,true);
		 $criteria->compare('updated_by',$model->updated_by,true);
		 $criteria->compare('created_time',$model->created_time,true);
		 $criteria->compare('created_by',$model->created_by,true);*/
		$criteria->order = 'priority ASC';
		$criteria->with = 'state';
		$criteria->alias = 't';
		$criteria->addCondition('state.country_id=2');

		return new CActiveDataProvider($model, array(
			'criteria'=>$criteria,
		));
	}



}