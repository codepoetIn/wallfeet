<?php

class ChangePasswordForm extends CFormModel {

	public $id;
	public $currentPassword;
	public $newPassword;
	public $confirmPassword;


	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('confirmPassword, newPassword, currentPassword', 'required'),
		array('currentPassword','exists'),
		array('newPassword', 'length', 'min'=>6),
		array('confirmPassword', 'compare', 'compareAttribute' => 'newPassword'),
		);
	}

	public function exists($attribute,$params)
	{
		if($this->id) {
			$user = UserCredentials::model()->findByPk($this->id);
			if($user){
				$password = SecurityUtils::encryptPassword($this->currentPassword,$user->salt);
				$criteria = new CDbCriteria;
				$criteria->condition = 'password=:password';
				$criteria->params = array(':password'=>$password);
				if(!UserCredentials::model()->find($criteria)){
					$this->addError('currentPassword','Please enter your current password !');
				}
			} else {
				$this->addError('currentPassword','Sorry, could not process your password modification request at this time !');
			}
		} else {
			$this->addError('currentPassword','Sorry, could not process your password modification request at this time !');
		}
	}


}

?>