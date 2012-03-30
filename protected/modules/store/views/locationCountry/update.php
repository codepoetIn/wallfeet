<?php
$this->breadcrumbs=array(
	'Geo Countries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GeoCountry', 'url'=>array('index')),
	array('label'=>'Create GeoCountry', 'url'=>array('create')),
	array('label'=>'View GeoCountry', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GeoCountry', 'url'=>array('admin')),
);
?>

<h1>Update GeoCountry <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>