<?php
$this->breadcrumbs=array(
	'User Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserSettings', 'url'=>array('index')),
	array('label'=>'Create UserSettings', 'url'=>array('create')),
	array('label'=>'Update UserSettings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserSettings', 'url'=>array('admin')),
);
?>

<h1>View UserSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'User Name',
		'type'=>'raw',
		'value'=>CHtml::link(CHtml::encode(UserApi::getNameByUserId($model->user_id)),
                                 array('/store/user/view','id'=>$model->user_id)),
		),
		'label',
		'value',
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
