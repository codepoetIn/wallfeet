<?php
class Portlet extends CWidget
{
    public $title; // the portlet title
    public $visible=true; // whether the portlet is visible
   
 
    public function init()
    {
        if($this->visible)
        {
          
        }
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
          
        }
    }
 
    protected function renderContent()
    {
        
    }
}
?>