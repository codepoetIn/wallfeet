<?php
$this->breadcrumbs=array(
	'Project Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectTypes', 'url'=>array('index')),
	array('label'=>'Create ProjectTypes', 'url'=>array('create')),
	array('label'=>'View ProjectTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProjectTypes', 'url'=>array('admin')),
);
?>

<h1>Update ProjectTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>