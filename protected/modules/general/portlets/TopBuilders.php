<?php
class TopBuilders extends Portlet
{
	
	public $location=null;
	protected function renderContent()
	{
	$topBuilders=BuilderProfileApi::getTopBuilder(15,$this->location);
	$this->render("topbuilders",array('topBuilders'=>$topBuilders));
	}
}
?>