<div id="property_search">
<h1 class="heading" id="heading">My Projects</h1>
<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'projects'))?>
<?php $this->widget('ProjectSearchResults',array('projects'=>$projects,'pagesProject'=>$pages)); ?>
<br clear="all" />
</div>
</div>