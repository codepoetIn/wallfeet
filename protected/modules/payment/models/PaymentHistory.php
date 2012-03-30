<?php

/**
 * This is the model class for table "payment_history".
 *
 * The followings are the available columns in table 'payment_history':
 * @property integer $id
 * @property integer $user_id
 * @property string $transaction_id
 * @property double $amount
 * @property string $purpose
 * @property string $comments
 * @property string $payment_status
 * @property string $status
 * @property string $updated_time
 * @property integer $updated_by
 * @property string $created_time
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property UserCredentials $user
 */
class PaymentHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PaymentHistory the static model class
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
		return 'payment_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount', 'required'),
			array('user_id, updated_by, created_by', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('transaction_id, payment_status', 'length', 'max'=>300),
			array('purpose', 'length', 'max'=>12),
			array('status', 'length', 'max'=>9),
			array('comments, updated_time, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, transaction_id, amount, purpose, comments, payment_status, status, updated_time, updated_by, created_time, created_by', 'safe', 'on'=>'search'),
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
			'transaction_id' => 'Transaction',
			'amount' => 'Amount',
			'purpose' => 'Purpose',
			'comments' => 'Comments',
			'payment_status' => 'Payment Status',
			'status' => 'Status',
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
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}