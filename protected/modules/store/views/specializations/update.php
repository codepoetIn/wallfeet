<?php
$this->breadcrumbs=array(
	'Specializations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Specializations', 'url'=>array('index')),
	array('label'=>'Create Specializations', 'url'=>array('create')),
	array('label'=>'View Specializations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Specializations', 'url'=>array('admin')),
);
?>

<h1>Update Specializations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>