<?php
$this->breadcrumbs=array(
	'Loans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Delete Loan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Loan', 'url'=>array('admin')),
);
?>

<h1>View Loan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'income',
		'lamount',
		'mobile',
		'city0.city',
		'dob',
		'email',
	),
)); ?>
