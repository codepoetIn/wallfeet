<?php
$this->breadcrumbs=array(
	'Project Images'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProjectImages', 'url'=>array('index')),
	array('label'=>'Create ProjectImages', 'url'=>array('create')),
	array('label'=>'View ProjectImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProjectImages', 'url'=>array('admin')),
);
?>

<h1>Update ProjectImages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>