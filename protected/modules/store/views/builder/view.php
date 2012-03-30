<?php
$this->breadcrumbs=array(
	'User Builder Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserBuilderProfile', 'url'=>array('index')),
	array('label'=>'Create UserBuilderProfile', 'url'=>array('create')),
	array('label'=>'Update UserBuilderProfile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserBuilderProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserBuilderProfile', 'url'=>array('admin')),
);
?>

<h1>View UserBuilderProfile #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name'=>'user_id','value'=>UserApi::getNameByUserId($model->user_id)),
		'company_name',
		'company_description',
		'address_line1',
		'address_line2',
		'country_id',
		'state_id',
		'city_id',
		'mobile',
		'telephone',
		'email',
		'image',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
