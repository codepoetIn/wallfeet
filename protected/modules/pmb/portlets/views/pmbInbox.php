<?php 
	if($messages){
		$new = "";
		if($unread)
			$new = count($unread).' New';
		echo '<div class="right cols2">
    	<div id="property_search_results">
        	<h1 class="property_search_results_top">'.count($messages).' Message Found <span class="right new">'.$new.'</span> </h1>';
		echo '<div class="messages">';
		echo '<div class="mes_header">';
		echo '<span class="from">From</span>';
		echo '<span class="subject">Subject</span>';
		echo '<span class="message">Message</span>';
		echo '</div>';
		//foreach($messages as $message){
		foreach ($messages as $message){
			$unread="";
			if($message->inbox_unread)
				$unread="unread";
			$from = "";
			if(isset($first_name[$message->from_user_id]))
				$from = $first_name[$message->from_user_id]." ".$last_name[$message->from_user_id];
			$subject=$message->subject;
			if(strlen($message->subject)>35)
				$subject=substr($message->subject,0,35).'...';
			$content=$message->content;
			if(strlen($message->content)>40)
				$content=substr($message->content,0,40).'...';
			echo '<div class="post pmb '.$unread.'">';
			echo '<a href="/message/'.$message->id.'">';
			echo '<span class="from" title="'.$from.'">'.$from.'</span>';
            echo '<span class="subject" title="'.$message->subject.'">'.$subject.'</span>';
            echo '<span class="message" title="'.$message->content.'">'.$content.'</span>';
            echo '</a>';
            echo '</div>';
		}
		echo '</div>';
		echo '</div></div>';
	}
	else{
		//echo '<div class="right cols2"><div id="property_search_results"><b class="red">Result not found.</b></div></div>';
		echo '<div style="padding-top:20px" align="center"><b class="red">Result not found.</b></div>';
	}
	$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.messages',
    'itemSelector' => 'div.pmb',
    'loadingText' => 'Loading...',
    'donetext' => 'No more messages found.',
    'pages' => $pages,

));
?>
