<?php
$this->breadcrumbs=array(
	'Global Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GlobalSettings', 'url'=>array('index')),
	array('label'=>'Create GlobalSettings', 'url'=>array('create')),
	array('label'=>'Update GlobalSettings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GlobalSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GlobalSettings', 'url'=>array('admin')),
);
?>

<h1>View GlobalSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'label',
		'value',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
