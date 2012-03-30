<?php

/**
 * This is the model class for table "geo_locality".
 *
 * The followings are the available columns in table 'geo_locality':
 * @property integer $id
 * @property string $locality
 * @property integer $city_id
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property GeoCity $city
 * @property Projects[] $projects
 * @property Property[] $properties
 * @property PropertyRequirement[] $propertyRequirements
 * @property UserAgentProfile[] $userAgentProfiles
 * @property UserBuilderProfile[] $userBuilderProfiles
 */
class GeoLocality extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GeoLocality the static model class
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
		return 'geo_locality';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('locality, city_id', 'required'),
			array('city_id', 'numerical', 'integerOnly'=>true),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, locality, city_id, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'city' => array(self::BELONGS_TO, 'GeoCity', 'city_id'),
			'projects' => array(self::HAS_MANY, 'Projects', 'locality_id'),
			'properties' => array(self::HAS_MANY, 'Property', 'locality_id'),
			'propertyRequirements' => array(self::HAS_MANY, 'PropertyRequirement', 'locality_id'),
			'userAgentProfiles' => array(self::HAS_MANY, 'UserAgentProfile', 'locality_id'),
			'userBuilderProfiles' => array(self::HAS_MANY, 'UserBuilderProfile', 'locality_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'locality' => 'Locality',
			'city_id' => 'City',
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
		$criteria->compare('locality',$this->locality,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}