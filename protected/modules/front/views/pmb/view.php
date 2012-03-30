<?php 
	$inbox = "";
	if($unread)
		$inbox = " (".count($unread).")";
?>
<div id="property_search">
<div class="right">
<?php if($message->from_user_id==Yii::app()->user->id) :?>
<a href="/messages" class="blu_bg_lnk">Inbox<?php echo $inbox; ?></a>
<?php else:?>
<a href="/messages/sent" class="blu_bg_lnk">Sent Items</a>
<?php endif;?>
</div>
<h1 class="heading" id="heading">My Message</h1>

<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'messages'))?>
<?php
	$name = "";
	if($message->from_user_id==Yii::app()->user->id){
		$name = "<a href='/profile/".$message->from_user_id."'>You</a> To <a href='/profile/".$message->to_user_id."'>".ucwords(UserApi::getNameByUserId($message->to_user_id))."</a> ";	
	}
	elseif($message->to_user_id==Yii::app()->user->id){
		$name = "<a href='/profile/".$message->from_user_id."'>".ucwords(UserApi::getNameByUserId($message->from_user_id))."</a> To <a href='/profile/".$message->to_user_id."'>You</a> ";
	}
	echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">'.$name.'<span class="right new">'.date("d M,Y H:i:s",strtotime($message->created_time)).'</span> </h1>';
	echo '<div class="message_view">';
	echo '<h3><span>Subject :: </span>'.$message->subject.'</h3>';
	echo '<p>'.$message->content.'</p>';
	echo '</div>';
	echo '<div class="pad10">';
	echo '<div class="left"><a href="#" class="red_bg_lnk">Delete</a></div>';
	if($message->from_user_id==Yii::app()->user->id){
		echo '<div class="right">'.CHtml::link('Compose','/message/reply/'.$message->to_user_id.'',array('class'=>'gry_bg_lnk')).'</div>';	
	}
	elseif($message->to_user_id==Yii::app()->user->id){
		echo '<div class="right">'.CHtml::link('Reply','/message/reply/'.$message->from_user_id.'',array('class'=>'gry_bg_lnk')).'</div>';
	}
	echo '</div>';
	echo '<br clear="all" />';
	echo '</div></div>';
?>
<br clear="all" />
</div>
</div>