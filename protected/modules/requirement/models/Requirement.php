<?php

/**
 * This is the model class for table "requirement".
 *
 * The followings are the available columns in table 'requirement':
 * @property integer $id
 * @property integer $user_id
 * @property string $i_want_to
 * @property string $description
 * @property double $covered_area_from
 * @property double $covered_area_to
 * @property string $covered_area_units
 * @property double $plot_area_from
 * @property double $plot_area_to
 * @property double $min_price
 * @property double $max_price
 * @property string $requirement_urgency
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property UserCredentials $user
 * @property RequirementAmenities[] $requirementAmenities
 * @property RequirementBedrooms[] $requirementBedrooms
 * @property RequirementCities[] $requirementCities
 * @property RequirementPropertyTypes[] $requirementPropertyTypes
 */
class Requirement extends ResourceActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Requirement the static model class
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
		return 'requirement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, i_want_to, description, min_price, max_price', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('covered_area_from, covered_area_to, plot_area_from, plot_area_to, min_price, max_price', 'numerical'),
			array('i_want_to', 'length', 'max'=>20),
			array('covered_area_from', 'compare','operator'=>'<=', 'compareAttribute' => 'covered_area_to', 'message'=>'Enter Correct Covered Area'),
			array('plot_area_from', 'compare','operator'=>'<=', 'compareAttribute' => 'plot_area_to', 'message'=>'Enter Correct Plot Area'),
			array('min_price', 'compare','operator'=>'<=', 'compareAttribute' => 'max_price', 'message'=>'Select Correct Budget'),
			array('covered_area_units', 'length', 'max'=>100),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('requirement_urgency, updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, i_want_to, description, covered_area_from, covered_area_to, covered_area_units, plot_area_from, plot_area_to, min_price, max_price, requirement_urgency, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'UserCredentials', 'user_id'),
			'requirementAmenities' => array(self::HAS_MANY, 'RequirementAmenities', 'requirement_id'),
			'requirementBedrooms' => array(self::HAS_MANY, 'RequirementBedrooms', 'requirement_id'),
			'requirementCities' => array(self::HAS_MANY, 'RequirementCities', 'requirement_id'),
			'requirementPropertyTypes' => array(self::HAS_MANY, 'RequirementPropertyTypes', 'requirement_id'),
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
			'description' => 'Description',
			'covered_area_from' => 'Covered Area From',
			'covered_area_to' => 'Covered Area To',
			'covered_area_units' => 'Covered Area Units',
			'plot_area_from' => 'Plot Area From',
			'plot_area_to' => 'Plot Area To',
			'min_price' => 'Min Price',
			'max_price' => 'Max Price',
			'requirement_urgency' => 'Requirement Urgency',
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
		$criteria->compare('i_want_to',$this->i_want_to,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('covered_area_from',$this->covered_area_from);
		$criteria->compare('covered_area_to',$this->covered_area_to);
		$criteria->compare('covered_area_units',$this->covered_area_units,true);
		$criteria->compare('plot_area_from',$this->plot_area_from);
		$criteria->compare('plot_area_to',$this->plot_area_to);
		$criteria->compare('min_price',$this->min_price);
		$criteria->compare('max_price',$this->max_price);
		$criteria->compare('requirement_urgency',$this->requirement_urgency,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}