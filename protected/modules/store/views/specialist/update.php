<?php
$this->breadcrumbs=array(
	'User Specialist Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProfile', 'url'=>array('index')),
	array('label'=>'Create UserSpecialistProfile', 'url'=>array('create')),
	array('label'=>'View UserSpecialistProfile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserSpecialistProfile', 'url'=>array('admin')),
);
?>

<h1>Update UserSpecialistProfile <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>