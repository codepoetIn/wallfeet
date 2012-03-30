<?php
class PropertySpotlight extends Portlet
{
	public $location=null;
	protected function renderContent()
    {
    	$propertySpotlight=PropertyApi::getFeaturedProperties(10,$this->location);
    	$propertyImages='';
    	if($propertySpotlight)
    	{
			foreach ($propertySpotlight as $property)
			{
				$propertyIds[]=$property->id;
			}
			$propertyImages=PropertyImagesApi::getPrimaryImageForProperties($propertyIds);
    	}
    	$this->render('propertyspotlight',array('propertySpotlight'=>$propertySpotlight,'propertyImages'=>$propertyImages));
    }	
}