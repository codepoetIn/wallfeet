<?php
$this->breadcrumbs=array(
	'Geo States'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GeoState', 'url'=>array('index')),
	array('label'=>'Create GeoState', 'url'=>array('create')),
	array('label'=>'Update GeoState', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GeoState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GeoState', 'url'=>array('admin')),
);
?>

<h1>View GeoState #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'state',
		'country_id',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
