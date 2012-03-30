<?php
class MiniSearch extends Portlet
{
	public $buyurl='/search/property'; 
	public $renturl='/search/property'; 
	public $sellurl='/property/post'; 
	public $specialisturl='/search/people'; 
	public $properties;
	public $modelCity;
	public $modelState;
	public $localityList;
    public function init()
    {
        
    }
 
    protected function renderContent()
    {
  		
        $this->render('miniSearch',
        array('properties'=>$this->properties,
        'modelCity'=>$this->modelCity,
        'modelState'=>$this->modelState,
        'localityList'=>$this->localityList));
         
    }
}
?>