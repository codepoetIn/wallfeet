<?php
$this->breadcrumbs=array(
	'Requirements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Requirement', 'url'=>array('index')),
	array('label'=>'Create Requirement', 'url'=>array('create')),
	array('label'=>'View Requirement', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Requirement', 'url'=>array('admin')),
);
?>

<h1>Update Requirement <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>