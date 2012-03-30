<?php

/**
 * This is the model class for table "user_photos".
 *
 * The followings are the available columns in table 'user_photos':
 * @property integer $id
 * @property integer $user_id
 * @property string $image
 * @property string $type
 * @property integer $updated_time
 * @property string $created_time
 * @property integer $created_by
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property UserCredentials $user
 */
class UserPhotos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserPhotos the static model class
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
		return 'user_photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, image, updated_time', 'required'),
			array('user_id, updated_time, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>50),
			array('type', 'length', 'max'=>7),
			array('created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, image, type, updated_time, created_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'image' => 'Image',
			'type' => 'Type',
			'updated_time' => 'Updated Time',
			'created_time' => 'Created Time',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('updated_time',$this->updated_time);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}