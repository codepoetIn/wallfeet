<?php

/**
 * This is the model class for table "pmb_messages".
 *
 * The followings are the available columns in table 'pmb_messages':
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $subject
 * @property string $content
 * @property integer $inbox_active
 * @property integer $sent_active
 * @property string $inbox_unread
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $updated_time
 * @property string $created_time
 *
 * The followings are the available model relations:
 * @property UserCredentials $fromUser
 * @property UserCredentials $toUser
 */
class PmbMessages extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PmbMessages the static model class
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
		return 'pmb_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_user_id, to_user_id, subject, content', 'required'),
			array('from_user_id, to_user_id, inbox_active, sent_active, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>100),
			array('content', 'length', 'max'=>400),
			array('inbox_unread', 'length', 'max'=>1),
			array('updated_time, created_time,from_user_id,to_user_id, subject, content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, from_user_id, to_user_id, subject, content, inbox_active, sent_active, inbox_unread, created_by, updated_by, updated_time, created_time', 'safe', 'on'=>'search'),
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
			'fromUser' => array(self::BELONGS_TO, 'UserCredentials', 'from_user_id'),
			'toUser' => array(self::BELONGS_TO, 'UserCredentials', 'to_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'from_user_id' => 'From User',
			'to_user_id' => 'To User',
			'subject' => 'Subject',
			'content' => 'Content',
			'inbox_active' => 'Inbox Active',
			'sent_active' => 'Sent Active',
			'inbox_unread' => 'Inbox Unread',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
			'updated_time' => 'Updated Time',
			'created_time' => 'Created Time',
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
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('inbox_active',$this->inbox_active);
		$criteria->compare('sent_active',$this->sent_active);
		$criteria->compare('inbox_unread',$this->inbox_unread,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}