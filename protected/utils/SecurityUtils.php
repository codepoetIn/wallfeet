<?php

/**
 * Short Description of the class here
 *
 * Long description here
 * @author Karthick Loganathan - Ones and Zeros Technologies
 * @copyright 2011
 * @link http://www.energizeyourit.com
 * 
 */
 /**
 * This class contains all security related utility methods.
 *
 * This class is used to perform securit and encryption related operatons for the application here.
 * 
 * @package utils 
 */ 
class SecurityUtils{

	/**
	 * @param string $pass
	 * @param string $salt
	 * @return string|false
	 * 
	 * This method is used to encrypt password. It uses MD5 to encrypt.
	 */
	public static function encryptPassword($pass=null,$salt=null){
		if(null==$pass || null==$salt){
			return false;
		}
		return crypt($pass,$salt);
	}

	/**
	 * @param string $pass
	 * @param string $salt
	 * @param string $encPass
	 * @return boolean
	 * 
	 * This method compares user entered value with the value stored in DB. It encrypts the user input before comparison
	 */
	public static function comparePasswords($pass=null,$salt=null,$encPass=null){
		if(null==$pass || null==$salt || null==$encPass){
			return false;
		}
		if(SecurityUtils::encryptPassword($pass,$salt) === $encPass){
			//if($pass === $encPass){
			return true;
		}

		return false;
	}

	/**
	 * @return string
	 * 
	 * Ths method returns the IP address of the client
	 */
	public static function getRealIp(){
		return (empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])?
		$_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP']);
	}

	/**
	 * @return string
	 * 
	 * This method generates a random string 
	 */
	public static function generateRandomString($len=8){
		return substr(MD5(time()),0,$len);
	}

	/**
	 * @param string $email
	 * @return string
	 * 
	 * This method generates a salt for the given emailId
	 */
	public static function generateSalt($email){
		if (isset(Yii::app()->params['globalSalt']))
			$globalSalt =  Yii::app()->params['globalSalt'];
		else
			$globalSalt =  'romeos@work';
		$salt = substr(MD5($email.$globalSalt.time()),0,4);
		return $salt;
	}
	
	public static function getVerificationLink($code,$email){
		return Yii::app()->createAbsoluteUrl('/account/activate',array('code'=>$code,'email'=>$email));
	}
	
}

?>