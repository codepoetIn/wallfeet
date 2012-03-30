<?php
class DbUtils
{

	public static function getDbValues($model,$attribute,$attributevalues,$select) {

		$criteria = new CDbCriteria;
		$criteria->select = array($select,$attribute);
		$criteria->addInCondition($attribute,$attributevalues);
		$models = $model->findAll($criteria);
		$result = false;
		if(!empty($models)){
			foreach($models as $obj)
			$result[$obj->$attribute]= $obj->$select;
		}
		return $result;
	}

	public static function getAddress($city_id){
		$city = GeoCity::model()->findByPk($city_id);
		$address = null;
		if($city){
			$address['city']=$city->city;
			$state=GeoState::model()->findByPk($city->state_id);
			$address['state']=$state->state;
			$country=GeoCountry::model()->findByPk($state->country_id);
			$address['country']=$country->country;
		}
		return $address;
	}


	public static function getAddressByLocalityId($localityId) {
		$address [] = "";
		$locality = GeoLocality::model ()->findByPk ( $localityId );
		if ($locality) {
			$address ['locality'] = $locality->locality;
			$city = GeoCity::model ()->findByPk ( $locality->city_id );
			$address ['city'] = $city->city;
			$state = GeoState::model ()->findByPk ( $city->state_id );
			$address ['state'] = $state->state;
			$country = GeoCountry::model ()->findByPk ( $state->country_id );
			$address ['country'] = $country->country;
			return $address;
		} else
		return false;
	}

}