<?php
$this->breadcrumbs=array(
	'Geo States'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GeoState', 'url'=>array('index')),
	array('label'=>'Create GeoState', 'url'=>array('create')),
	array('label'=>'View GeoState', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GeoState', 'url'=>array('admin')),
);
?>

<h1>Update GeoState <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>