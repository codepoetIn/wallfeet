<?php

/**
 * This is the model class for table "projects".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property integer $user_id
 * @property string $project_name
 * @property string $description
 * @property integer $project_type_id
 * @property integer $ownership_type_id
 * @property integer $state_id
 * @property integer $city_id
 * @property integer $locality_id
 * @property string $address
 * @property string $features
 * @property integer $covered_area
 * @property integer $land_area
 * @property double $total_price
 * @property integer $price_starting_from
 * @property integer $per_unit_price
 * @property string $area_type
 * @property integer $display_price
 * @property integer $price_negotiable
 * @property string $landmarks
 * @property string $tax_fees
 * @property string $terms_and_conditions
 * @property integer $views
 * @property integer $recently_viewed
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property ProjectAmenities[] $projectAmenities
 * @property ProjectImages[] $projectImages
 * @property ProjectProperties[] $projectProperties
 * @property ProjectRating[] $projectRatings
 * @property ProjectWishlist[] $projectWishlists
 * @property GeoState $state
 * @property UserCredentials $user
 * @property GeoLocality $locality
 * @property ProjectTypes $projectType
 * @property CategoryOwnershipTypes $ownershipType
 * @property GeoCity $city
 */
class Projects extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Projects the static model class
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
		return 'projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, project_name, description, project_type_id, ownership_type_id, state_id, city_id, features', 'required'),
			array('user_id, project_type_id, ownership_type_id, state_id, city_id, locality_id, covered_area, land_area, price_starting_from, per_unit_price, display_price, price_negotiable, views, recently_viewed', 'numerical', 'integerOnly'=>true),
			array('total_price', 'numerical'),
			array('tax_fees', 'numerical'),
			array('area_type', 'length', 'max'=>50),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('address, landmarks, tax_fees, terms_and_conditions, updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, project_name, description, project_type_id, ownership_type_id, state_id, city_id, locality_id, address, features, covered_area, land_area, total_price, price_starting_from, per_unit_price, area_type, display_price, price_negotiable, landmarks, tax_fees, terms_and_conditions, views, recently_viewed, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'projectAmenities' => array(self::HAS_MANY, 'ProjectAmenities', 'project_id'),
			'projectImages' => array(self::HAS_MANY, 'ProjectImages', 'project_id'),
			'projectProperties' => array(self::HAS_MANY, 'ProjectProperties', 'project_id'),
			'projectRatings' => array(self::HAS_MANY, 'ProjectRating', 'project_id'),
			'projectWishlists' => array(self::HAS_MANY, 'ProjectWishlist', 'project_id'),
			'state' => array(self::BELONGS_TO, 'GeoState', 'state_id'),
			'user' => array(self::BELONGS_TO, 'UserCredentials', 'user_id'),
			'locality' => array(self::BELONGS_TO, 'GeoLocality', 'locality_id'),
			'projectType' => array(self::BELONGS_TO, 'ProjectTypes', 'project_type_id'),
			'ownershipType' => array(self::BELONGS_TO, 'CategoryOwnershipTypes', 'ownership_type_id'),
			'city' => array(self::BELONGS_TO, 'GeoCity', 'city_id'),
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
			'project_name' => 'Project Name',
			'description' => 'Description',
			'project_type_id' => 'Project Type',
			'ownership_type_id' => 'Ownership Type',
			'state_id' => 'State',
			'city_id' => 'City',
			'locality_id' => 'Locality',
			'address' => 'Address',
			'features' => 'Features',
			'covered_area' => 'Covered Area',
			'land_area' => 'Land Area',
			'total_price' => 'Total Price',
			'price_starting_from' => 'Price Starting From',
			'per_unit_price' => 'Per Unit Price',
			'area_type' => 'Area Type',
			'display_price' => 'Display Price',
			'price_negotiable' => 'Price Negotiable',
			'landmarks' => 'Landmarks',
			'tax_fees' => 'Tax Fees',
			'terms_and_conditions' => 'Terms And Conditions',
			'views' => 'Views',
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('project_type_id',$this->project_type_id);
		$criteria->compare('ownership_type_id',$this->ownership_type_id);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('locality_id',$this->locality_id);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('features',$this->features,true);
		$criteria->compare('covered_area',$this->covered_area);
		$criteria->compare('land_area',$this->land_area);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('price_starting_from',$this->price_starting_from);
		$criteria->compare('per_unit_price',$this->per_unit_price);
		$criteria->compare('area_type',$this->area_type,true);
		$criteria->compare('display_price',$this->display_price);
		$criteria->compare('price_negotiable',$this->price_negotiable);
		$criteria->compare('landmarks',$this->landmarks,true);
		$criteria->compare('tax_fees',$this->tax_fees,true);
		$criteria->compare('terms_and_conditions',$this->terms_and_conditions,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('recently_viewed',$this->recently_viewed);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}