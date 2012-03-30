<?php
class MiniRegister extends Portlet
{
	public $registerUrl='/';
	public function init()
	    {
	        
	    }
 
    protected function renderContent()
    { 
    	$credentialsModel = UserApi::populateCredentialsModel();
        $this->render('miniRegister',array('credentialsModel'=>$credentialsModel));
         
    }
}
