<?php
$this->breadcrumbs=array(
	'User Specialist Projects',
);

$this->menu=array(
	array('label'=>'Create UserSpecialistProjects', 'url'=>array('create')),
	array('label'=>'Manage UserSpecialistProjects', 'url'=>array('admin')),
);
?>

<h1>User Specialist Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
