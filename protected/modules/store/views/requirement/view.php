<?php
$this->breadcrumbs=array(
	'Requirements'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List Requirement', 'url'=>array('index')),
	array('label'=>'Create Requirement', 'url'=>array('create')),
	array('label'=>'Update Requirement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Requirement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Requirement', 'url'=>array('admin')),
);
?>

<h1>View Requirement</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'user_id','value'=>UserApi::getNameByUserId($model->user_id)),
		'i_want_to',
		'description',
		'covered_area_from',
		'covered_area_to',
		'plot_area_from',
		'plot_area_to',
		'min_price',
		'max_price',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
