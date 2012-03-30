<?php
class TopCities extends Portlet
{
	public $country='india';
protected function renderContent()
	{
		yii::beginProfile('top-cities');
		$country = GeoCountryApi::getCountryByName($this->country);
		$cities = GeoCityApi::getTopPrioritiesByCountry($country->id);
		$this->render('topCities',array('cities'=>$cities));
		yii::endProfile('top-cities');
	}
}