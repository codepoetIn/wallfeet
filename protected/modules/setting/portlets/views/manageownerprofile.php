<?php 
$agentText='Create';
$specialistText='Create';
$builderText='Create';
if($users['isAgent']){
	$agentText='Manage';
}
if($users['isBuilder']){
	$builderText='Manage';
}
if($users['isSpecialist']){
	$specialistText='Manage';
}
?>
<div style="margin-right:0;" class="dashboard-box left">
    	<h1><img alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-create.png">Manage Profiles</h1>
        <ul>
       	  <li><a href="/agent/create"><?php echo $agentText;?> Agent Profile</a></li>
          <li><a href="/builder/create"><?php echo $builderText;?> Builder Profile</a></li>
          <li><a href="/specialist/create"><?php echo $specialistText;?> Specialist Profile </a></li>
      </ul>
</div>
<br class="clear">