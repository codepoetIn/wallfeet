<?php

/**
 * This is the model class for table "advertisement_plan".
 *
 * The followings are the available columns in table 'advertisement_plan':
 * @property integer $id
 * @property string $plan_name
 * @property integer $validity_days
 * @property double $price
 * @property string $description
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property AdvertisementPages[] $advertisementPages
 */
class AdvertisementPlan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdvertisementPlan the static model class
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
		return 'advertisement_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plan_name, validity_days, price, description', 'required'),
			array('validity_days', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, plan_name, validity_days, price, description, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'advertisements' => array(self::HAS_MANY, 'Advertisement', 'advertisement_plan_id'),
			'advertisementPages' => array(self::HAS_MANY, 'AdvertisementPages', 'advertisement_plan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'plan_name' => 'Plan Name',
			'validity_days' => 'Validity Days',
			'price' => 'Price',
			'description' => 'Description',
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
		$criteria->compare('plan_name',$this->plan_name,true);
		$criteria->compare('validity_days',$this->validity_days);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}