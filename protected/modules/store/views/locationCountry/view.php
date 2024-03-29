<?php
$this->breadcrumbs=array(
	'Geo Countries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
	array('label'=>'Update Country', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Country', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Country', 'url'=>array('admin')),
);
?>

<h1>View GeoCountry #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country',
		'currency',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
