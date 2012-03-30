<?php
class StarRating extends Portlet
{
	/*
	 * controller action should created for this portlet
	 * url should be controller path , id,userid 
	 * ex:'front/jukebox/starRatingAjax/userid/'.Yii::app()->user->id.'/question_id/'.$jukeboxQuestion->id
	  
  	*/
    public $rating;
    public $url;
 	public $ratingReadOnly;
    protected function renderContent()
    {
  
        $this->render('starRating',array('rating'=>$this->rating,'url'=>$this->url,'ratingReadOnly'=>$this->ratingReadOnly));
         
    }
}
?>