<div id="property_search">
<h1 class="heading" id="heading">My Requirements</h1>
<div class="inner-column">
<?php $this->widget('MyAccountMenu',array('page'=>'requirements'))?>
<?php $this->widget('RequirementResults',array('requirements'=>$requirements,'pages'=>$pages,'totalRequirements'=>$totalRequirements)); ?>
<br clear="all" />
</div>
</div>