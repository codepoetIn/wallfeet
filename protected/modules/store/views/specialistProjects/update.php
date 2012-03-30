<?php
$this->breadcrumbs=array(
	'User Specialist Projects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProjects', 'url'=>array('index')),
	array('label'=>'Create UserSpecialistProjects', 'url'=>array('create')),
	array('label'=>'View UserSpecialistProjects', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserSpecialistProjects', 'url'=>array('admin')),
);
?>

<h1>Update UserSpecialistProjects <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>