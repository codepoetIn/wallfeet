<?php
$this->breadcrumbs=array(
	'Category Ownership Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryOwnershipTypes', 'url'=>array('index')),
	array('label'=>'Create CategoryOwnershipTypes', 'url'=>array('create')),
	array('label'=>'Update CategoryOwnershipTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryOwnershipTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryOwnershipTypes', 'url'=>array('admin')),
);
?>

<h1>View CategoryOwnershipTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ownership_type',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
