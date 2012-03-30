<?php

/**
 * This is the model class for table "geo_city".
 *
 * The followings are the available columns in table 'geo_city':
 * @property integer $id
 * @property string $city
 * @property integer $metro
 * @property integer $priority
 * @property integer $state_id
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property GeoState $state
 * @property GeoLocality[] $geoLocalities
 * @property RequirementCities[] $requirementCities
 * @property UserAgentProfile[] $userAgentProfiles
 * @property UserBuilderProfile[] $userBuilderProfiles
 * @property UserProfiles[] $userProfiles
 * @property UserSpecialistProfile[] $userSpecialistProfiles
 */
class GeoCity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GeoCity the static model class
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
		return 'geo_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('city, state_id', 'required'),
		array('metro, priority, state_id', 'numerical', 'integerOnly'=>true),
		array('updated_by, created_by', 'length', 'max'=>10),
		array('updated_time, created_time', 'safe'),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, city, metro, priority, state_id, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'state' => array(self::BELONGS_TO, 'GeoState', 'state_id'),
			'geoLocalities' => array(self::HAS_MANY, 'GeoLocality', 'city_id'),
			'requirementCities' => array(self::HAS_MANY, 'RequirementCities', 'city_id'),
			'userAgentProfiles' => array(self::HAS_MANY, 'UserAgentProfile', 'city_id'),
			'userBuilderProfiles' => array(self::HAS_MANY, 'UserBuilderProfile', 'city_id'),
			'userProfiles' => array(self::HAS_MANY, 'UserProfiles', 'city_id'),
			'userSpecialistProfiles' => array(self::HAS_MANY, 'UserSpecialistProfile', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'city' => 'City',
			'metro' => 'Metro',
			'priority' => 'Priority',
			'state_id' => 'State',
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
		$criteria->compare('city',$this->city,true);
		$criteria->compare('metro',$this->metro);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->order = 'priority ASC';

		return new CActiveDataProvider($this, array(
		    'pagination'=>array(
		        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['adminPageSize']),
			),
			'criteria'=>$criteria,
		));
	}

	public function searchTop($domestic=true)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('metro',$this->metro);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->order = 'priority ASC';

		$india = GeoCountryApi::getCountryByName('india');

		if($domestic){
			if($india){
				$criteria->with = 'state';
				$criteria->alias = 't';
				$criteria->addCondition("state.country_id=$india->id");
			}
		} else {
			if($india){
				$criteria->with = 'state';
				$criteria->alias = 't';
				$criteria->addCondition("state.country_id!=$india->id");
			}
		}

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
		      'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['adminPageSize']),
		      //'pageSize'=> 150,
			),
			'criteria'=>$criteria,
		));
	}

	public function searchInternational()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('metro',$this->metro);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->order = 'priority ASC';

		$criteria->with = 'state';
		$criteria->alias = 't';

		$india = GeoCountryApi::getCountryByName('india');
		$criteria->addCondition("state.country_id!=$india->id");


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}