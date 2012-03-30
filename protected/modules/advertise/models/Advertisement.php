<?php

/**
 * This is the model class for table "advertisement".
 *
 * The followings are the available columns in table 'advertisement':
 * @property integer $id
 * @property integer $user_id
 * @property integer $advertisement_plan_id
 * @property integer $status
 * @property string $banner_image
 * @property string $link
 * @property string $description
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property UserCredentials $user
 * @property AdvertisementPlan $advertisementPlan
 */
class Advertisement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advertisement the static model class
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
		return 'advertisement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, advertisement_plan_id, banner_image, link, description', 'required'),
			array('user_id, advertisement_plan_id, status', 'numerical', 'integerOnly'=>true),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, advertisement_plan_id, status, banner_image, link, description, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'advertisementPlan' => array(self::BELONGS_TO, 'AdvertisementPlan', 'advertisement_plan_id'),
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
			'advertisement_plan_id' => 'Advertisement Plan',
			'status' => 'Status',
			'banner_image' => 'Banner Image',
			'link' => 'Link',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('advertisement_plan_id',$this->advertisement_plan_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('banner_image',$this->banner_image,true);
		$criteria->compare('link',$this->link,true);
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