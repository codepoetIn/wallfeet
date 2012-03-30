<?php
$this->breadcrumbs=array(
	'Project Images'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProjectImages', 'url'=>array('index')),
	array('label'=>'Create ProjectImages', 'url'=>array('create')),
	array('label'=>'Update ProjectImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProjectImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProjectImages', 'url'=>array('admin')),
);

?>

<h1>View ProjectImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project.project_name',
		//'image',
		array('name'=>'image','value'=>'<img src="'.ImageUtils::getImageUrl('projects',$model->project_id,$model->image).'" width="100" />','type'=>'raw'),
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
	),
)); ?>
