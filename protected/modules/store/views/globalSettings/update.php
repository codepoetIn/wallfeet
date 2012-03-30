<?php
$this->breadcrumbs=array(
	'Global Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GlobalSettings', 'url'=>array('index')),
	array('label'=>'Create GlobalSettings', 'url'=>array('create')),
	array('label'=>'View GlobalSettings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GlobalSettings', 'url'=>array('admin')),
);
?>

<h1>Update GlobalSettings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>