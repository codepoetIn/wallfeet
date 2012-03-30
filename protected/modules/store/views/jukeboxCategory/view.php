<?php
$this->breadcrumbs=array(
	'Jukebox Categories'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List JukeboxCategory', 'url'=>array('index')),
	array('label'=>'Create JukeboxCategory', 'url'=>array('create')),
	array('label'=>'Update JukeboxCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JukeboxCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JukeboxCategory', 'url'=>array('admin')),
);
?>

<h1>View JukeboxCategory</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
