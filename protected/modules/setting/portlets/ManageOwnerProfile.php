<?php
class ManageOwnerProfile extends CWidget
{
	public function run()
    {
    $userId = Yii::app()->user->id;
    $isAgent=AgentProfileApi::isAgent($userId);
    $isBuilder=BuilderProfileApi::isBuilder($userId);
    $isSpecialist=SpecialistApi::isSpecialist($userId);
    
    $users=array('isAgent'=>$isAgent,'isBuilder'=>$isBuilder,'isSpecialist'=>$isSpecialist);
    $this->render('manageownerprofile',array('users'=>$users));
    }
}
?>