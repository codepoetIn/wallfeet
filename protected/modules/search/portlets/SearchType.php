<?php
class SearchType extends Portlet
{
	public $type = 'property';
	public $propertySearchUrl = '';
	public $projectSearchUrl = '';
	public $peopleSearchUrl = '';


	protected function renderContent()
	{
		 
		if(!$this->propertySearchUrl){
			$this->propertySearchUrl = Yii::app()->createAbsoluteUrl('/search/property');
		}
		 
		if(!$this->projectSearchUrl){
			$this->projectSearchUrl = Yii::app()->createAbsoluteUrl('/search/project');
		}
		 
		if(!$this->peopleSearchUrl){
			$this->peopleSearchUrl = Yii::app()->createAbsoluteUrl('/search/people');
		}
		 
		$this->render('searchType',array('type'=>$this->type,
										 'propertySearchUrl'=>$this->propertySearchUrl,
										 'projectSearchUrl'=>$this->projectSearchUrl,
										 'peopleSearchUrl'=>$this->peopleSearchUrl,		 
		));
		 
	}


	 

}