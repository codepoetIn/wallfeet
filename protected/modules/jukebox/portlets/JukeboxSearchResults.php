<?php
class JukeboxSearchResults extends CWidget
{
	public $questions;
	public $pages;
	public $jukeboxCount;
    public function run()
    {
        $this->render('jukeboxSearchResults',array('questions'=>$this->questions,'pages'=>$this->pages,'jukeboxCount'=>$this->jukeboxCount));
    }
}
?>