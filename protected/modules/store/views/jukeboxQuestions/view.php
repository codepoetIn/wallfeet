<?php
$this->breadcrumbs=array(
	'Jukebox Questions'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List JukeboxQuestions', 'url'=>array('index')),
	array('label'=>'Create JukeboxQuestions', 'url'=>array('create')),
	array('label'=>'Update JukeboxQuestions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JukeboxQuestions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JukeboxQuestions', 'url'=>array('admin')),
);
?>

<h1>View JukeboxQuestions</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'User Name',
		'type'=>'raw',
		'value'=>CHtml::link(CHtml::encode(UserApi::getNameByUserId($model->user_id)),
                                 array('/store/user/view','id'=>$model->user_id)),
		),
		'question',
		'description',
		'category.category',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
