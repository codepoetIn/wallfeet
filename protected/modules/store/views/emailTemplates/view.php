<?php
$this->breadcrumbs=array(
	'Email Templates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Templates', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'Update Template', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Template', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Templates', 'url'=>array('admin')),
);
?>

<h1>View EmailTemplates #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'from_email',
		'from_name',
		'subject',
		'body_html',
		'body_plain',
		/*'created_by',
		'updated_time',
		'created_time',
		'updated_by',*/
	),
)); ?>
