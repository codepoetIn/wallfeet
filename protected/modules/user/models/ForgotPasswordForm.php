<?php

class ForgotPasswordForm extends CFormModel {

	public $email;

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('email', 'required'),
		array('email','email'),
		array('email', 'exists'),	
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


}

?>