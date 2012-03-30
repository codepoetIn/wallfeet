<?php
class SpecialistsType extends Portlet
{
	public function renderContent()
	{
		$results=SpecialistTypeApi::getSpecialistTypeByUserId();
		
		$this->render('specialistsType',array('results'=>$results));
	}
}