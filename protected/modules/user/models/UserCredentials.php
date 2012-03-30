<?php

/**
 * This is the model class for table "user_credentials".
 *
 * The followings are the available columns in table 'user_credentials':
 * @property integer $id
 * @property string $email_id
 * @property string $password
 * @property string $salt
 * @property string $activation_code
 * @property string $status
 * @property string $verified_by
 * @property integer $warnings
 * @property string $registered_ip
 * @property string $last_login_ip
 * @property string $updated_time
 * @property integer $updated_by
 * @property string $created_time
 * @property integer $created_by
 * @property string $last_login_time
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property JukeboxAnswers[] $jukeboxAnswers
 * @property JukeboxQuestions[] $jukeboxQuestions
 * @property Messages[] $messages
 * @property Messages[] $messages1
 * @property PaymentHistory[] $paymentHistories
 * @property Projects[] $projects
 * @property Property[] $properties
 * @property PropertyRequirement[] $propertyRequirements
 * @property PropertyWishlist[] $propertyWishlists
 * @property UserAgentProfile[] $userAgentProfiles
 * @property UserBuilderProfile[] $userBuilderProfiles
 * @property UserPhotos[] $userPhotoses
 * @property UserProfiles[] $userProfiles
 * @property UserSettings[] $userSettings
 * @property UserSpecialistProfile[] $userSpecialistProfiles
 * @property UserSpecialistProjects[] $userSpecialistProjects
 * @property UserSpecialistType[] $userSpecialistTypes
 */
class UserCredentials extends CActiveRecord
{
	
	public $password_confirm;
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserCredentials the static model class
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
		return 'user_credentials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_id, password, salt, activation_code, registered_ip', 'required'),
			array('warnings, updated_by, created_by', 'numerical', 'integerOnly'=>true),
			array('email_id', 'length', 'max'=>255),
			array('email_id','email'),
			array('email_id', 'unique','on'=>'register'),
			array('password', 'length', 'min'=>6),
			array('salt', 'length', 'max'=>100),
			array('status', 'length', 'max'=>21),
			array('verified_by', 'length', 'max'=>150),
			array('last_login_ip, updated_time, created_time, last_login_time', 'safe'),
			array('password_confirm', 'compare', 'compareAttribute' => 'password', 'on'=>'register'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('password_confirm', 'safe', 'on'=>'register'),
			array('id, email_id, password, password_confirm, salt, activation_code, status, verified_by, warnings, registered_ip, last_login_ip, updated_time, updated_by, created_time, created_by, last_login_time', 'safe', 'on'=>'search'),
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
			'advertisements' => array(self::HAS_MANY, 'Advertisement', 'user_id'),
			'jukeboxAnswers' => array(self::HAS_MANY, 'JukeboxAnswers', 'user_id'),
			'jukeboxQuestions' => array(self::HAS_MANY, 'JukeboxQuestions', 'user_id'),
			'messagesFrom' => array(self::HAS_MANY, 'Messages', 'from_user_id'),
			'messagesTo' => array(self::HAS_MANY, 'Messages', 'to_user_id'),
			'paymentHistories' => array(self::HAS_MANY, 'PaymentHistory', 'user_id'),
			'projects' => array(self::HAS_MANY, 'Projects', 'user_id'),
			'properties' => array(self::HAS_MANY, 'Property', 'user_id'),
			'propertyRequirements' => array(self::HAS_MANY, 'PropertyRequirement', 'user_id'),
			'propertyWishlists' => array(self::HAS_MANY, 'PropertyWishlist', 'user_id'),
			'userAgentProfiles' => array(self::HAS_ONE, 'UserAgentProfile', 'id'),
			'userBuilderProfiles' => array(self::HAS_ONE, 'UserBuilderProfile', 'id'),
			'userPhotoses' => array(self::HAS_MANY, 'UserPhotos', 'user_id'),
			'userProfiles' => array(self::HAS_ONE, 'UserProfiles', 'user_id'),
			'userSettings' => array(self::HAS_MANY, 'UserSettings', 'user_id'),
			'userSpecialistProfiles' => array(self::HAS_ONE, 'UserSpecialistProfile', 'id'),
			'userSpecialistProjects' => array(self::HAS_MANY, 'UserSpecialistProjects', 'user_id'),
			'userSpecialistTypes' => array(self::HAS_MANY, 'UserSpecialistType', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email_id' => 'Email',
			'password' => 'Password',
			'password_confirm' => 'Confirm your Password',
			'salt' => 'Salt',
			'activation_code' => 'Activation Code',
			'status' => 'Status',
			'verified_by' => 'Verified By',
			'warnings' => 'Warnings',
			'registered_ip' => 'Registered Ip',
			'last_login_ip' => 'Last Login Ip',
			'updated_time' => 'Updated Time',
			'updated_by' => 'Updated By',
			'created_time' => 'Created Time',
			'created_by' => 'Created By',
			'last_login_time' => 'Last Login Time',
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
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('activation_code',$this->activation_code,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('verified_by',$this->verified_by,true);
		$criteria->compare('warnings',$this->warnings);
		$criteria->compare('registered_ip',$this->registered_ip,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('last_login_time',$this->last_login_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getName(){
		if(isset($this->userProfiles) && is_object($this->userProfiles))
		return $this->userProfiles->last_name . ',' . $this->userProfiles->first_name;
		else
		return null; 
	}
}