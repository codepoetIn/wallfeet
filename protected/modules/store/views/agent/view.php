<?php
$this->breadcrumbs=array(
	'User Agent Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAgentProfile', 'url'=>array('index')),
	array('label'=>'Create UserAgentProfile', 'url'=>array('create')),
	array('label'=>'Update UserAgentProfile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAgentProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAgentProfile', 'url'=>array('admin')),
);
?>

<h1>View UserAgentProfile #<?php echo $model->id; ?></h1>

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
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
