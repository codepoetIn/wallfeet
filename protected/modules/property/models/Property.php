<?php

/**
 * This is the model class for table "property".
 *
 * The followings are the available columns in table 'property':
 * @property integer $id
 * @property integer $user_id
 * @property string $i_want_to
 * @property string $property_name
 * @property string $description
 * @property string $features
 * @property integer $featured
 * @property integer $jackpot_investment
 * @property integer $instant_home
 * @property integer $property_type_id
 * @property integer $transaction_type_id
 * @property integer $state_id
 * @property integer $city_id
 * @property integer $locality_id
 * @property string $video_url
 * @property double $latitude
 * @property double $longitude
 * @property string $address
 * @property integer $pincode
 * @property string $bathrooms
 * @property string $bedrooms
 * @property string $hospital
 * @property string $school
 * @property string $railway
 * @property string $airport
 * @property string $city_centre
 * @property string $furnished
 * @property integer $age_of_construction
 * @property integer $ownership_type_id
 * @property double $covered_area
 * @property string $c_area_units
 * @property double $land_area
 * @property string $l_area_units
 * @property double $total_price
 * @property double $per_unit_price
 * @property string $area_type
 * @property integer $display_price
 * @property integer $price_negotiable
 * @property string $available_from
 * @property string $available_units
 * @property string $facing
 * @property string $floor_number
 * @property string $total_floors
 * @property string $landmarks
 * @property string $tax_fees
 * @property string $terms_and_conditions
 * @property integer $views
 * @property double $booking_amount
 * @property double $annual_dues
 * @property double $maintanence_charge
 * @property integer $recently_viewed
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property ProjectProperties[] $projectProperties
 * @property UserCredentials $user
 * @property GeoState $state
 * @property PropertyTypes $propertyType
 * @property PropertyTransactionTypes $transactionType
 * @property PropertyAgeOfConstruction $ageOfConstruction
 * @property CategoryOwnershipTypes $ownershipType
 * @property GeoCity $city
 * @property GeoLocality $locality
 * @property PropertyAmenities[] $propertyAmenities
 * @property PropertyImages[] $propertyImages
 * @property PropertyRating[] $propertyRatings
 * @property PropertyWishlist[] $propertyWishlists
 */
class Property extends ActiveRecord
{
	
	public $country;
	public $state;
	public $city;
	public $zip;
	public $address2;
	public $locality;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Property the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, locality_id,description, land_area,l_area_units,total_price,available_from, address, i_want_to, property_type_id, city_id', 'required'),
			array('property_type_id', 'customValidate', 'on'=>'custom-validate'),
			array('user_id, featured, jackpot_investment, instant_home, property_type_id, transaction_type_id, state_id, city_id, locality_id, pincode, age_of_construction, ownership_type_id, display_price, price_negotiable, views, recently_viewed', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude,total_floors, covered_area, land_area, total_price, per_unit_price, booking_amount, annual_dues, maintanence_charge, hospital, school, railway, airport, city_centre,', 'numerical'),
			array('i_want_to, bathrooms, bedrooms, facing, floor_number, total_floors', 'length', 'max'=>20),
			array('hospital, school, railway, airport, city_centre', 'length', 'max'=>3),
			array('furnished, area_type', 'length', 'max'=>50),
			array('c_area_units, l_area_units,updated_by, created_by', 'length', 'max'=>10),
			array('property_name,description,video_url, features, address, available_from, available_units, landmarks, tax_fees, terms_and_conditions, updated_time, created_time', 'safe'),
			array('id, user_id, i_want_to, property_name, description, features, featured, jackpot_investment, instant_home, property_type_id, transaction_type_id, state_id, city_id, locality_id, latitude, longitude, address, pincode, bathrooms, bedrooms, hospital, school, railway, airport, city_centre, furnished, age_of_construction, ownership_type_id, covered_area, c_area_units, land_area, l_area_units, total_price, per_unit_price, area_type, display_price, price_negotiable, available_from, available_units, facing, floor_number, total_floors, landmarks, tax_fees, terms_and_conditions, views, booking_amount, annual_dues, maintanence_charge, recently_viewed, updated_time, updated_by, created_time, created_by, locality', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, i_want_to, property_name, description, features, featured, jackpot_investment, instant_home, property_type_id, transaction_type_id, state_id, city_id, locality_id, latitude, longitude, address, pincode, bathrooms, bedrooms, hospital, school, railway, airport, city_centre, furnished, age_of_construction, ownership_type_id, covered_area, c_area_units, land_area, l_area_units, total_price, per_unit_price, area_type, display_price, price_negotiable, available_from, available_units, facing, floor_number, total_floors, landmarks, tax_fees, terms_and_conditions, views, booking_amount, annual_dues, maintanence_charge, recently_viewed, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
			
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'projectProperties' => array(self::HAS_MANY, 'ProjectProperties', 'property_id'),
			'user' => array(self::BELONGS_TO, 'UserCredentials', 'user_id'),
			'state' => array(self::BELONGS_TO, 'GeoState', 'state_id'),
			'propertyType' => array(self::BELONGS_TO, 'PropertyTypes', 'property_type_id'),
			'transactionType' => array(self::BELONGS_TO, 'PropertyTransactionTypes', 'transaction_type_id'),
			'ageOfConstruction' => array(self::BELONGS_TO, 'PropertyAgeOfConstruction', 'age_of_construction'),
			'ownershipType' => array(self::BELONGS_TO, 'CategoryOwnershipTypes', 'ownership_type_id'),
			'city' => array(self::BELONGS_TO, 'GeoCity', 'city_id'),
			'locality' => array(self::BELONGS_TO, 'GeoLocality', 'locality_id'),
			'propertyAmenities' => array(self::HAS_MANY, 'PropertyAmenities', 'property_id'),
			'propertyImages' => array(self::HAS_MANY, 'PropertyImages', 'property_id'),
			'propertyRatings' => array(self::HAS_MANY, 'PropertyRating', 'property_id'),
			'propertyWishlists' => array(self::HAS_MANY, 'PropertyWishlist', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'i_want_to' => 'I Want To',
			'property_name' => 'Property Name',
			'description' => 'Description',
			'features' => 'Features',
			'featured' => 'Featured',
			'jackpot_investment' => 'Jackpot Investment',
			'instant_home' => 'Instant Home',
			'property_type_id' => 'Property Type',
			'transaction_type_id' => 'Transaction Type',
			'state_id' => 'State',
			'city_id' => 'City',
			'locality_id' => 'Locality',
			'video_url' => 'Youtube Video Url',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'address' => 'Address',
			'pincode' => 'Pincode',
			'bathrooms' => 'Bathrooms',
			'bedrooms' => 'Bedrooms',
			'hospital' => 'Hospital',
			'school' => 'School',
			'railway' => 'Railway',
			'airport' => 'Airport',
			'city_centre' => 'City Centre',
			'furnished' => 'Furnished',
			'age_of_construction' => 'Age Of Construction',
			'ownership_type_id' => 'Ownership Type',
			'covered_area' => 'Covered Area',
			'c_area_units' => 'Covered Area Units',
			'land_area' => 'Land Area',
			'l_area_units' => 'Land Area Units',
			'total_price' => 'Total Price(Rs)',
			'per_unit_price' => 'Per Unit Price(Rs)',
			'area_type' => 'Area Type',
			'display_price' => 'Display Price',
			'price_negotiable' => 'Price Negotiable',
			'available_from' => 'Available From',
			'available_units' => 'Available Units',
			'facing' => 'Facing',
			'floor_number' => 'Floor Number',
			'total_floors' => 'Total Floors',
			'landmarks' => 'Landmarks',
			'tax_fees' => 'Tax Fees',
			'terms_and_conditions' => 'Terms And Conditions',
			'views' => 'Views',
			'booking_amount' => 'Booking Amount(Rs)',
			'annual_dues' => 'Annual Dues(Rs)',
			'maintanence_charge' => 'Maintanence Charge(Rs)',
			'recently_viewed' => 'Recently Viewed',
			'updated_time' => 'Updated Time',
			'updated_by' => 'Updated By',
			'created_time' => 'Created Time',
			'created_by' => 'Created By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($page="")
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('i_want_to',$this->i_want_to,true);
		$criteria->compare('property_name',$this->property_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('features',$this->features,true);
		if($page=="premium"){
			$criteria->condition='featured!=:featured';
			$criteria->params=array(':featured'=>0);
			$criteria->order = "featured DESC";
		}
		else
			$criteria->compare('featured',$this->featured);
		if($page=="jackpot"){
			$criteria->condition='jackpot_investment!=:jackpot_investment';
			$criteria->params=array(':jackpot_investment'=>0);
			$criteria->order = "jackpot_investment DESC";
		}
		else
			$criteria->compare('jackpot_investment',$this->jackpot_investment);
		if($page=="instant"){
			$criteria->condition='instant_home!=:instant_home';
			$criteria->params=array(':instant_home'=>0);
			$criteria->order = "instant_home DESC";
		}
		else
			$criteria->compare('instant_home',$this->instant_home);		
		$criteria->compare('property_type_id',$this->property_type_id);
		$criteria->compare('transaction_type_id',$this->transaction_type_id);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('locality_id',$this->locality_id);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('pincode',$this->pincode);
		$criteria->compare('bathrooms',$this->bathrooms,true);
		$criteria->compare('bedrooms',$this->bedrooms,true);
		$criteria->compare('hospital',$this->hospital,true);
		$criteria->compare('school',$this->school,true);
		$criteria->compare('railway',$this->railway,true);
		$criteria->compare('airport',$this->airport,true);
		$criteria->compare('city_centre',$this->city_centre,true);
		$criteria->compare('furnished',$this->furnished,true);
		$criteria->compare('age_of_construction',$this->age_of_construction);
		$criteria->compare('ownership_type_id',$this->ownership_type_id);
		$criteria->compare('covered_area',$this->covered_area);
		$criteria->compare('c_area_units',$this->c_area_units,true);
		$criteria->compare('land_area',$this->land_area);
		$criteria->compare('l_area_units',$this->l_area_units,true);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('per_unit_price',$this->per_unit_price);
		$criteria->compare('area_type',$this->area_type,true);
		$criteria->compare('display_price',$this->display_price);
		$criteria->compare('price_negotiable',$this->price_negotiable);
		$criteria->compare('available_from',$this->available_from,true);
		$criteria->compare('available_units',$this->available_units,true);
		$criteria->compare('facing',$this->facing,true);
		$criteria->compare('floor_number',$this->floor_number,true);
		$criteria->compare('total_floors',$this->total_floors,true);
		$criteria->compare('landmarks',$this->landmarks,true);
		$criteria->compare('tax_fees',$this->tax_fees,true);
		$criteria->compare('terms_and_conditions',$this->terms_and_conditions,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('booking_amount',$this->booking_amount);
		$criteria->compare('annual_dues',$this->annual_dues);
		$criteria->compare('maintanence_charge',$this->maintanence_charge);
		$criteria->compare('recently_viewed',$this->recently_viewed);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		
	}
	
	
	public function customValidate(){
		
			if($this->property_type_id>=22&&$this->property_type_id<=26){			
					$r_validate = CValidator::createValidator( 'required', $this, array('ownership_type_id') );
					$r_validate->validate( $this );			
			}
			elseif($this->property_type_id==6||$this->property_type_id==10||$this->property_type_id>=17&&$this->property_type_id<=19){
					$r_validate = CValidator::createValidator( 'required', $this, array('covered_area','c_area_units','transaction_type_id','age_of_construction','ownership_type_id') );
					$r_validate->validate( $this );				
			}
			elseif($this->property_type_id==11||$this->property_type_id==12||$this->property_type_id==15||$this->property_type_id==16||$this->property_type_id==20||$this->property_type_id==21){
					$r_validate = CValidator::createValidator( 'required', $this, array('covered_area','c_area_units','transaction_type_id','bathrooms','age_of_construction','ownership_type_id') );
					$r_validate->validate( $this );				
			}
			else{
					$r_validate = CValidator::createValidator( 'required', $this, array('covered_area','c_area_units','transaction_type_id','bedrooms','bathrooms','age_of_construction','ownership_type_id') );
					$r_validate->validate( $this );
			}	

			
		
		}
}