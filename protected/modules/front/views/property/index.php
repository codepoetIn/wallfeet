<div id="property_search">
<h1 class="heading" id="heading">My Properties</h1>
<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'properties'))?>
<?php $this->widget('PropertySearchResults',array('properties'=>$properties,'pages'=>$pages,'propertiesCount'=>$propertiesCount)); ?>
<br clear="all" />
</div>
</div>