<?php
class WebUser extends CWebUser{

	public function init()
	{
		parent::init();
		$this->loginUrl = Yii::app()->request->baseUrl.'/login?message=1';
	}
	
	public function getId(){
		return Yii::app()->user->isGuest ? null : Yii::app()->user->id;
	}

	protected function afterLogin($fromCookie){

		if(!$fromCookie){
			$user = UserCredentials::model()->findByPK(Yii::app()->user->id);
			$user->last_login_time = new CDbExpression('NOW()');
			$user->last_login_ip = SecurityUtils::getRealIp();
			$user->save();
		}

	}

}

?>