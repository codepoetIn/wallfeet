<?php
$this->breadcrumbs=array(
	'Property Transaction Types'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List PropertyTransactionTypes', 'url'=>array('index')),
	array('label'=>'Create PropertyTransactionTypes', 'url'=>array('create')),
	array('label'=>'Update PropertyTransactionTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropertyTransactionTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertyTransactionTypes', 'url'=>array('admin')),
);
?>

<h1>View PropertyTransactionTypes</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transaction_type',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
