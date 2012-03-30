<?php
$this->breadcrumbs=array(
	'Property Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PropertyTypes', 'url'=>array('index')),
	array('label'=>'Create PropertyTypes', 'url'=>array('create')),
	array('label'=>'View PropertyTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PropertyTypes', 'url'=>array('admin')),
);
?>

<h1>Update PropertyTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>