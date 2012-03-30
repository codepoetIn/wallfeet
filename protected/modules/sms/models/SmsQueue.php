<?php

/**
 * This is the model class for table "sms_queue".
 *
 * The followings are the available columns in table 'sms_queue':
 * @property integer $id
 * @property string $sender_id
 * @property string $to
 * @property string $body
 * @property integer $attempts
 * @property integer $sent
 * @property string $message
 * @property integer $created_by
 * @property string $updated_time
 * @property string $created_time
 * @property integer $updated_by
 */
class SmsQueue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SmsQueue the static model class
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
		return 'sms_queue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('to, body', 'required'),
			array('attempts, sent, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('sender_id', 'length', 'max'=>150),
			array('message, updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender_id, to, body, attempts, sent, message, created_by, updated_time, created_time, updated_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender_id' => 'Sender',
			'to' => 'To',
			'body' => 'Body',
			'attempts' => 'Attempts',
			'sent' => 'Sent',
			'message' => 'Message',
			'created_by' => 'Created By',
			'updated_time' => 'Updated Time',
			'created_time' => 'Created Time',
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
		$criteria->compare('sender_id',$this->sender_id,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('attempts',$this->attempts);
		$criteria->compare('sent',$this->sent);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}