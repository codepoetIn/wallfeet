<?php
$this->breadcrumbs=array(
	'Property Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PropertyImages', 'url'=>array('index')),
	array('label'=>'Create PropertyImages', 'url'=>array('create')),
	array('label'=>'Update PropertyImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PropertyImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PropertyImages', 'url'=>array('admin')),
);
?>

<h1>View PropertyImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name'=>'property_id','value'=>PropertyApi::getNameByPropertyId($model->property_id)),
		array('name'=>'image','type'=>'raw','value'=>'<img src="'.PropertyImagesApi::getImageByUrl($model->property_id,$model->image).'" />'),
		
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
