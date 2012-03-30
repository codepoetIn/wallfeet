<?php
$this->breadcrumbs=array(
	'Property Images'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PropertyImages', 'url'=>array('index')),
	array('label'=>'Create PropertyImages', 'url'=>array('create')),
	array('label'=>'View PropertyImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PropertyImages', 'url'=>array('admin')),
);
?>

<h1>Update PropertyImages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>