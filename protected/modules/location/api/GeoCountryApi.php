<?php

class GeoCountryApi {

	public static function getCountryByName($countryName){
		$dependency = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_country');
		return GeoCountry::model()->find('lower(country)=:country',array(':country'=>strtolower($countryName)));
	}
}