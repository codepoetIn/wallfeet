<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property integer $feedback_topic_id
 * @property string $email_id
 * @property integer $mobile
 * @property string $description
 * @property string $image
 * @property string $recommendation
 * @property string $satisfaction
 *
 * The followings are the available model relations:
 * @property FeedbackTopic $feedbackTopic
 */
class Feedback extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Feedback the static model class
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
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('feedback_topic_id,description,email_id', 'required'),
			array('feedback_topic_id, mobile', 'numerical', 'integerOnly'=>true),
			array('email_id, image, recommendation, satisfaction', 'safe'),
			array('image', 'file', 'types'=>'JPG,JPEG, GIF, PNG, BMP, PDF, DOC, TXT, RTF, PPT,HTML','maxSize'=>1024 * 1024 * 1, // 1MB
                'tooLarge'=>'The file was larger than 1MB. Please upload a smaller file.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, feedback_topic_id, email_id, mobile, description, image, recommendation, satisfaction', 'safe', 'on'=>'search'),
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
			'feedbackTopic' => array(self::BELONGS_TO, 'FeedbackTopic', 'feedback_topic_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'feedback_topic_id' => 'Feedback Topic',
			'email_id' => 'Email',
			'mobile' => 'Mobile',
			'description' => 'Description',
			'image' => 'Image',
			'recommendation' => 'Recommendation',
			'satisfaction' => 'Satisfaction',
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
		$criteria->compare('feedback_topic_id',$this->feedback_topic_id);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('recommendation',$this->recommendation,true);
		$criteria->compare('satisfaction',$this->satisfaction,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}