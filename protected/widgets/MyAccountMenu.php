<?php
class MyAccountMenu extends CWidget
{
	public $page;
 	public function run()
    {
    	$class = array(
    		'messages'=>'',
    		'properties'=>'',
    		'projects'=>'',
    		'requirements'=>'',
    		'jukebox'=>'',
    		'wishlists'=>'',
    	);
    	$class[$this->page] = 'active';
        $this->render('myAccountMenu',array('page'=>$this->page,'class'=>$class));
    }
}