<?php
class JukeboxSearch extends CWidget
{
	public $modelJukeboxQuestions;
	public $questions;
	public $pages;
	public $jukeboxCount;
    public function run()
    {
    	 
        $this->render('jukeboxSearch',array('modelJukeboxQuestions'=>$this->modelJukeboxQuestions,'questions'=>$this->questions,'pages'=>$this->pages,'jukeboxCount'=>$this->jukeboxCount));
    }
}
                                                      
?>