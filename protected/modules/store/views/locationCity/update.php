<?php
$this->breadcrumbs=array(
	'Geo Cities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GeoCity', 'url'=>array('index')),
	array('label'=>'Create GeoCity', 'url'=>array('create')),
	array('label'=>'View GeoCity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GeoCity', 'url'=>array('admin')),
);
?>

<h1>Update GeoCity <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>