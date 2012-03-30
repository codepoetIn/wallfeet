<?php
$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Feedback', 'url'=>array('index')),
	array('label'=>'Delete Feedback', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Feedback', 'url'=>array('admin')),
);
?>

<h1>View Feedback #<?php echo $model->id; ?></h1>

<?php

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'feedbackTopic.topic',
		'email_id',
		'mobile',
		'description',
		'recommendation',
		'satisfaction',
	),
)); ?>
<table class="detail-view" id="yw0">
<tbody>
<tr class="even"><th>Image</th><td><a href="<?php echo $url;?>" target="_blank" >   <img src="<?php echo $url;?>" width="80" height="50"></img></a></td></tr>
</tbody></table>