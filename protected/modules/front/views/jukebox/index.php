<div id="property_search">
<h1 class="heading" id="heading">My Jukebox</h1>
<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'jukebox'))?>
<?php $this->widget('JukeboxSearchResults',array('questions'=>$questions,'pages'=>$pages,'jukeboxCount'=>$total)); ?>
<br clear="all" />
</div>
</div>