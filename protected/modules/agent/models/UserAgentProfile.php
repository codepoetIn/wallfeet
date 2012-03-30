<?php

/**
 * This is the model class for table "user_agent_profile".
 *
 * The followings are the available columns in table 'user_agent_profile':
 * @property integer $id
 * @property integer $user_id
 * @property string $company_name
 * @property string $company_description
 * @property string $address_line1
 * @property string $address_line2
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $city_id
 * @property string $mobile
 * @property string $telephone
 * @property string $email
 * @property string $website
 * @property string $image
 * @property string $updated_time
 * @property string $updated_by
 * @property string $created_time
 * @property string $created_by
 *
 * The followings are the available model relations:
 * @property UserCredentials $user
 * @property GeoCountry $country
 * @property GeoState $state
 * @property GeoCity $city
 */
class UserAgentProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserAgentProfile the static model class
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
		return 'user_agent_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, company_name, company_description, address_line1, country_id, state_id, city_id, mobile', 'required'),
			array('user_id, country_id, state_id, city_id', 'numerical', 'integerOnly'=>true),
			array('updated_by, created_by', 'length', 'max'=>10),
			array('address_line2,telephone,website,image,updated_time, created_time', 'safe'),
			array('email', 'email'),
			array('email', 'length', 'max'=>255),
			array('mobile', 'length', 'max'=>20,'min'=>10),
			array('mobile', 'match', 'pattern'=>'/^([+]?[0-9]+)([-]?[0-9]+)$/'),
			array('id, user_id, company_name, company_description, address_line1, address_line2, country_id, state_id, city_id, mobile, telephone, email, image, updated_time, updated_by, created_time, created_by', 'filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),	
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, company_name, company_description, address_line1, address_line2, country_id, state_id, city_id, mobile, telephone, email, image, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'GeoCountry', 'country_id'),
			'state' => array(self::BELONGS_TO, 'GeoState', 'state_id'),
			'city' => array(self::BELONGS_TO, 'GeoCity', 'city_id'),
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
			'company_name' => 'Company Name',
			'company_description' => 'Company Description',
			'address_line1' => 'Address Line1',
			'address_line2' => 'Address Line2',
			'country_id' => 'Country',
			'state_id' => 'State',
			'city_id' => 'City',
			'mobile' => 'Mobile',
			'telephone' => 'Telephone',
			'email' => 'Email',
		'website' => 'Website',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_description',$this->company_description,true);
		$criteria->compare('address_line1',$this->address_line1,true);
		$criteria->compare('address_line2',$this->address_line2,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
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