<?php

class ResendEmailForm extends CFormModel {

	public $email;

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('email', 'required'),
		array('email','email'),
		array('email', 'exists'),
		array('email', 'alreadyActive'),
		);
	}

	public function exists($attribute,$params)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'email_id=:email';
		$criteria->params = array(':email'=>$this->email);
		if(!UserCredentials::model()->find($criteria)){
			$this->addError('email','An account by that email does not exist !');
		}

	}

	public function alreadyActive($attribute,$params)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'email_id=:email && status=:status';
		$criteria->params = array(':email'=>$this->email,':status'=>'EMAIL_NOT_VERIFIED');
		if(!UserCredentials::model()->find($criteria)){
			$this->addError('email','Your account is already active !');
		}

	}

}

?>