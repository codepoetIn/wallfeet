<?php

/**
 * This is the model class for table "email_templates".
 *
 * The followings are the available columns in table 'email_templates':
 * @property integer $id
 * @property string $name
 * @property string $from_email
 * @property string $from_name
 * @property string $subject
 * @property string $body_html
 * @property string $body_plain
 * @property integer $created_by
 * @property string $updated_time
 * @property string $created_time
 * @property integer $updated_by
 */
class EmailTemplates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EmailTemplates the static model class
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
		return 'email_templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, from_email, from_name, subject, body_html, body_plain', 'required'),
			array('created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('from_email, from_name', 'length', 'max'=>150),
			array('subject', 'length', 'max'=>300),
			array('updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, from_email, from_name, subject, body_html, body_plain, created_by, updated_time, created_time, updated_by', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'from_email' => 'From Email',
			'from_name' => 'From Name',
			'subject' => 'Subject',
			'body_html' => 'Body Html',
			'body_plain' => 'Body Plain',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('from_email',$this->from_email,true);
		$criteria->compare('from_name',$this->from_name,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body_html',$this->body_html,true);
		$criteria->compare('body_plain',$this->body_plain,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}