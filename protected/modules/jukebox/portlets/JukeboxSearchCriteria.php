<?php
class JukeboxSearchCriteria extends CWidget
{
	public $modelJukeboxQuestions;
    public function run()
    {
        $this->render('jukeboxSearchCriteria',array('modelJukeboxQuestions'=>$this->modelJukeboxQuestions));
    }
}

?>