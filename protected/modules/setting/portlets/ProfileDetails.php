<?php
class ProfileDetails extends CWidget
{
	
	public function run()
    {
    	$userId = Yii::app()->user->id;
		$model=UserApi::getUser($userId);
    $this->render('profiledetails',array('model'=>$model));
    }
}
?>