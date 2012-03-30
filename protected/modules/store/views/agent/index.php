<?php
$this->breadcrumbs=array(
	'User Agent Profiles',
);

$this->menu=array(
	array('label'=>'Create UserAgentProfile', 'url'=>array('create')),
	array('label'=>'Manage UserAgentProfile', 'url'=>array('admin')),
);
?>

<h1>User Agent Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
