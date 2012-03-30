<?php
$this->breadcrumbs=array(
	'User Specialist Profiles'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProfile', 'url'=>array('index')),
	array('label'=>'Create UserSpecialistProfile', 'url'=>array('create')),
	array('label'=>'Update UserSpecialistProfile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserSpecialistProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserSpecialistProfile', 'url'=>array('admin')),
);
?>

<h1>View UserSpecialistProfile</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name'=>'user_id','value'=>UserApi::getNameByUserId($model->user_id)),
		'company_name',
		'contact_person_name',
		'company_description',
		'address_line1',
		'address_line2',
		'country.country',
		'state.state',
		'city.city',
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
