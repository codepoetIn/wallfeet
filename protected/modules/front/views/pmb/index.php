<div id="property_search">
<div class="right">
<a href="/messages/sent" class="blu_bg_lnk">Sent Items</a>
</div>
<h1 class="heading" id="heading">Inbox</h1>

<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'messages'))?>
<?php $this->widget('PmbInbox',array('messages'=>$messages,'unread'=>$unread,'pages'=> $pages)); ?>
<br clear="all" />
</div>
</div>