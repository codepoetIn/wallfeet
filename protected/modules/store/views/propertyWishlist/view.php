<?php
$this->breadcrumbs=array(
	'Property Wishlists'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List PropertyWishlist', 'url'=>array('index')),
	array('label'=>'Create PropertyWishlist', 'url'=>array('create')),
	array('label'=>'Update PropertyWishlist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropertyWishlist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertyWishlist', 'url'=>array('admin')),
);
?>

<h1>View PropertyWishlist</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'property_id',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
