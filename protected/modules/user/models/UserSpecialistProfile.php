<?php

/**
 * This is the model class for table "user_specialist_profile".
 *
 * The followings are the available columns in table 'user_specialist_profile':
 * @property integer $id
 * @property integer $user_id
 * @property integer $specialist_type_id
 * @property string $company_name
 * @property string $contact_person_name
 * @property string $company_description
 * @property string $address_line1
 * @property string $address_line2
 * @property integer $city_id
 * @property string $mobile
 * @property string $telephone
 * @property string $email
 * @property string $image
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property SpecialistTypes $specialistType
 * @property GeoCity $city
 * @property UserCredentials $user
 */
class UserSpecialistProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserSpecialistProfile the static model class
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
		return 'user_specialist_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, specialist_type_id, company_name, contact_person_name, company_description, address_line1, address_line2, city_id, mobile, telephone, email, image', 'required'),
			array('user_id, specialist_type_id, city_id', 'numerical', 'integerOnly'=>true),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, specialist_type_id, company_name, contact_person_name, company_description, address_line1, address_line2, city_id, mobile, telephone, email, image, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'specialistType' => array(self::BELONGS_TO, 'SpecialistTypes', 'specialist_type_id'),
			'city' => array(self::BELONGS_TO, 'GeoCity', 'city_id'),
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
			'specialist_type_id' => 'Specialist Type',
			'company_name' => 'Company Name',
			'contact_person_name' => 'Contact Person Name',
			'company_description' => 'Company Description',
			'address_line1' => 'Address Line1',
			'address_line2' => 'Address Line2',
			'city_id' => 'City',
			'mobile' => 'Mobile',
			'telephone' => 'Telephone',
			'email' => 'Email',
			'image' => 'Image',
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
		$criteria->compare('specialist_type_id',$this->specialist_type_id);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('contact_person_name',$this->contact_person_name,true);
		$criteria->compare('company_description',$this->company_description,true);
		$criteria->compare('address_line1',$this->address_line1,true);
		$criteria->compare('address_line2',$this->address_line2,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}