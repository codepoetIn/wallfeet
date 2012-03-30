<?php
class TopLocation extends Portlet
{
	public $newCountry='';
	public $newCity='';
	public $defaultCity='Coimbatore';
	public $defaultCountry='india';
	public $current='city';

	public function init()
	{

	}

	protected function renderContent()
	{
		yii::beginProfile('loc');
		$session=new CHttpSession;
		$session->open();

		$newCountry = $this->newCountry ? $this->newCountry : ($session['top-country'] ? $session['top-country'] : $this->defaultCountry);
		$session['top-country'] = $newCountry;

		$newCity = $this->newCity ? $this->newCity : ($session['top-city'] ? $session['top-city'] : $this->defaultCity);
		$session['top-location'] = $newCity;

		if($newCountry=="international"){
			$country = 'international';
			$city = GeoCityApi::getCityByName($newCity);
			if($city)
			$cities = GeoCityApi::getTopPrioritiesInternational($city->id);
			else
			$cities = GeoCityApi::getTopPrioritiesInternational();
		}else {
			
			$country = GeoCountryApi::getCountryByName($newCountry);
			$city = GeoCityApi::getCityByName($newCity);
			if($country && $city) 
			$cities = GeoCityApi::getTopPrioritiesByCountry($country->id,$city->id);
			elseif($country)
			$cities = GeoCityApi::getTopPrioritiesByCountry($country->id);
				
		}
		if($country && $cities)
		$this->render('topLocation',array('city'=>$city,'country'=>$country,'current'=>$this->current,'cities'=>$cities));

		yii::endProfile('loc');
	}
}
