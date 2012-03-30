<?php
$this->breadcrumbs=array(
	'User Specialist Projects'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProjects', 'url'=>array('index')),
	array('label'=>'Create UserSpecialistProjects', 'url'=>array('create')),
	array('label'=>'Update UserSpecialistProjects', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserSpecialistProjects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserSpecialistProjects', 'url'=>array('admin')),
);
?>

<h1>View UserSpecialistProjects</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name'=>'user_id','value'=>UserApi::getNameByUserId($model->user_id)),
		array('name'=>'specialist_type_id','value'=>SpecializationsApi::getSpecializationById($model->specialist_type_id)),
		'project_name',
		'description',
		'image',
		'duration',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
