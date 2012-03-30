<?php 
	$inbox = "";
	if($unread)
		$inbox = " (".count($unread).")";
?>
<div id="property_search">
<div class="right">
<a href="/messages" class="blu_bg_lnk">Inbox<?php echo $inbox; ?></a>
</div>
<h1 class="heading" id="heading">Sent Items</h1>

<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'messages'))?>
<?php $this->widget('PmbSent',array('messages'=>$messages,'unread'=>$unread,'pages'=> $pages)); ?>
<br clear="all" />
</div>
</div>