<?php
$this->breadcrumbs=array(
	'Property Types'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List PropertyTypes', 'url'=>array('index')),
	array('label'=>'Create PropertyTypes', 'url'=>array('create')),
	array('label'=>'Update PropertyTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropertyTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertyTypes', 'url'=>array('admin')),
);
?>

<h1>View PropertyTypes</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'property_type',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
