<?php
$this->breadcrumbs=array(
	'Geo Cities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GeoCity', 'url'=>array('index')),
	array('label'=>'Create GeoCity', 'url'=>array('create')),
	array('label'=>'Update GeoCity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GeoCity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GeoCity', 'url'=>array('admin')),
);
?>

<h1>View GeoCity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'city',
		'metro',
		'priority',
		'state_id',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
