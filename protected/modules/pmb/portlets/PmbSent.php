<?php
class PmbSent extends CWidget
{
	public $messages;
	public $unread;
	public $pages=null;
    public function run()
    {
    	$userIds = null;
    	if($this->messages){
    		foreach($this->messages as $message)
    			$userIds[] = $message->to_user_id;
    	}
    	$first_name = DbUtils::getDbValues(new UserProfiles,'user_id',$userIds,'first_name');
    	$last_name = DbUtils::getDbValues(new UserProfiles,'user_id',$userIds,'last_name');
        $this->render('pmbSent',array('messages'=>$this->messages,'first_name'=>$first_name,'last_name'=>$last_name,'unread'=>$this->unread,'pages'=>$this->pages));
    }
}

?>