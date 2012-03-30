<?php
$this->breadcrumbs=array(
	'User Specialist Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProjects', 'url'=>array('index')),
	array('label'=>'Manage UserSpecialistProjects', 'url'=>array('admin')),
);
?>

<h1>Create UserSpecialistProjects</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>