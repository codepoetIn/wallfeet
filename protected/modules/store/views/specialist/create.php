<?php
$this->breadcrumbs=array(
	'User Specialist Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProfile', 'url'=>array('index')),
	array('label'=>'Manage UserSpecialistProfile', 'url'=>array('admin')),
);
?>

<h1>Create UserSpecialistProfile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>