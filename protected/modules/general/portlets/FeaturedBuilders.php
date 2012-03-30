<?php
class FeaturedBuilders extends Portlet
{
	public $location=null;
	public function renderContent()
	{
		$featuredBuilders=BuilderProfileApi::getFeaturedBuilder(15,$this->location);
		$this->render('featuredbuilders',array('featuredBuilders'=>$featuredBuilders));
	}
}