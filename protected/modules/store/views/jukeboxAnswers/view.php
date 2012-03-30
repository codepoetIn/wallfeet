<?php
$this->breadcrumbs=array(
	'Jukebox Answers'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List JukeboxAnswers', 'url'=>array('index')),
	array('label'=>'Create JukeboxAnswers', 'url'=>array('create')),
	array('label'=>'Update JukeboxAnswers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JukeboxAnswers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JukeboxAnswers', 'url'=>array('admin')),
);
?>

<h1>View JukeboxAnswers</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'User Name',
		'type'=>'raw',
		'value'=>CHtml::link(CHtml::encode(UserApi::getNameByUserId($model->user_id)),
                                 array('/store/user/view','id'=>$model->user_id)),
		),
		'jukeboxQuestion.question',
		'answer',
		'reference_url',
		'status',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
