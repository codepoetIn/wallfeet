<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	private $_username;

	const ERROR_USERNAME_INACTIVE=3;

	public function authenticate()
	{
		$user=UserCredentials::model()->findByAttributes(array('email_id'=>$this->username));

		if($user===null)
		$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($user->status != 'ACTIVE')
		$this->errorCode=self::ERROR_USERNAME_INACTIVE;
		else if(!SecurityUtils::comparePasswords($this->password,$user->salt,$user->password))
		$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_username = $user->email_id;
			$this->setState('id', $user->id);
			$this->setState('emailId', $user->email_id);
			$this->setState('last_login_time', $user->last_login_time);
			$this->errorCode=self::ERROR_NONE;
		}

		return !$this->errorCode;
	}

	public function getUsername()
	{
		return $this->_username;
	}
}