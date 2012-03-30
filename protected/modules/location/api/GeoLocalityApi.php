<?php

class GeoLocalityApi {

	public static function getList($city_id='',$locality_id=''){
		$model=GeoLocality::model()->findAll('city_id=:city_id',array(':city_id'=>$city_id));
		$localityList = null;
		foreach($model as $locality){
			$localityList[$locality->id] = $locality->locality;
		}
		return $localityList;
	}

	public static function getAllNameList($key=false){
		$model=GeoLocality::model()->findAll();
		$localityList = null;
		foreach($model as $locality){
			if($key)
			$localityList[$locality->id] = $locality->locality;
			else
			$localityList[$locality->locality] = $locality->locality;
		}
		return $localityList;
	}
	
	public static function getAllNameListByCity($city_id=''){
		$model=GeoLocality::model()->findAll('city_id=:city_id',array(':city_id'=>$city_id));
		$localityList = null;
		foreach($model as $locality){
			$localityList[$locality->locality] = $locality->locality;
		}
		return $localityList;
	}
}