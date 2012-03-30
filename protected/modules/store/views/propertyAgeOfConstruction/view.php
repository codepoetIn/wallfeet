<?php
$this->breadcrumbs=array(
	'Property Age Of Constructions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PropertyAgeOfConstruction', 'url'=>array('index')),
	array('label'=>'Create PropertyAgeOfConstruction', 'url'=>array('create')),
	array('label'=>'Update PropertyAgeOfConstruction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropertyAgeOfConstruction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertyAgeOfConstruction', 'url'=>array('admin')),
);
?>

<h1>View PropertyAgeOfConstruction #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'age',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
