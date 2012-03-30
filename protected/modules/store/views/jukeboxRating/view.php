<?php
$this->breadcrumbs=array(
	'Jukebox Ratings'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List JukeboxRating', 'url'=>array('index')),
	array('label'=>'Create JukeboxRating', 'url'=>array('create')),
	array('label'=>'Update JukeboxRating', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JukeboxRating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JukeboxRating', 'url'=>array('admin')),
);
?>

<h1>View JukeboxRating</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'User Name',
		'type'=>'raw',
		'value'=>CHtml::link(CHtml::encode(UserApi::getNameByUserId($model->user_id)),
                                 array('/store/user/view','id'=>$model->user_id)),
		),
		'question.question',
		'rate',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
		
	),
)); ?>
