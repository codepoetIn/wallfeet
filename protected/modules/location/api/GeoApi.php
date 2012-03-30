<?php 

class GeoApi {
	
	public static function getCityName($cityId);
	
	public static function getStateName($stateId);
	
	public static function getCountryName($countryId);
	
	public static function getlocalityName($localityId);
	
	
	public static function getCities($stateId);
	
	public static function getlocalities($cityId);
	
	public static function getStates($countryId);
	
	public static function getCountries();
	
	
	public static function addCities($stateId,$cities);
	
	public static function addlocalities($cityId,$localities);
	
	public static function addStates($countryId,$states);
	
	public static function addCountries($countries);
	
	
	public static function deleteCities($cityIds);
	
	public static function deletelocalities($localityIds);
	
	public static function deleteStates($stateIds);
	
	public static function deleteCountries($countryIds);
	
	
	public static function deleteAllCities($stateIds);
	
	public static function deleteAlllocalities($cityIds);
	
	public static function deleteAllStates($countryIds);
	
	public static function deleteAllCountries();
	
}

?>