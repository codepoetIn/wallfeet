<?php

/**
 * This is the model class for table "loan".
 *
 * The followings are the available columns in table 'loan':
 * @property integer $id
 * @property string $name
 * @property string $income
 * @property double $lamount
 * @property integer $mobile
 * @property integer $city
 * @property string $dob
 * @property string $email * 
 * @property string $occupation
 * @property integer $property_identified
 *
 * The followings are the available model relations:
 * @property GeoCity $city0
 */
class Loan extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Loan the static model class
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
		return 'loan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, income, lamount, mobile, city, dob, email,occupation, property_identified', 'required'),
			array('mobile, city, property_identified', 'numerical', 'integerOnly'=>true),
			array('mobile', 'length', 'max'=>20,'min'=>10),
			array('mobile', 'match', 'pattern'=>'/^([+]?[0-9]+)([-]?[0-9]+)$/'),
			array('lamount', 'numerical'),
			array('email','email'),
			array('occupation', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, income, lamount, mobile, city, dob, email, occupation, property_identified', 'safe', 'on'=>'search'),
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
			'city0' => array(self::BELONGS_TO, 'GeoCity', 'city'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'income' => 'Monthly Income',
			'lamount' => 'Loan amount',
			'mobile' => 'Mobile No',
			'city' => 'City',
			'dob' => 'Date of Birth',
			'email' => 'Email-ID',		
			'occupation' => 'Occupation',
			'property_identified' => 'Property Identified',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('income',$this->income,true);
		$criteria->compare('lamount',$this->lamount);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('city',$this->city);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('property_identified',$this->property_identified);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}