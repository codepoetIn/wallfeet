<?php
$this->breadcrumbs=array(
	'User Specialist Profiles',
);

$this->menu=array(
	array('label'=>'Create UserSpecialistProfile', 'url'=>array('create')),
	array('label'=>'Manage UserSpecialistProfile', 'url'=>array('admin')),
);
?>

<h1>User Specialist Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
