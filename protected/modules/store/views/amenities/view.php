<?php
$this->breadcrumbs=array(
	'Category Amenities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryAmenities', 'url'=>array('index')),
	array('label'=>'Create CategoryAmenities', 'url'=>array('create')),
	array('label'=>'Update CategoryAmenities', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryAmenities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryAmenities', 'url'=>array('admin')),
);
?>

<h1>View CategoryAmenities #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'amenity',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
