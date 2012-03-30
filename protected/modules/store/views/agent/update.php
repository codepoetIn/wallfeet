<?php
$this->breadcrumbs=array(
	'User Agent Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserAgentProfile', 'url'=>array('index')),
	array('label'=>'Create UserAgentProfile', 'url'=>array('create')),
	array('label'=>'View UserAgentProfile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserAgentProfile', 'url'=>array('admin')),
);
?>

<h1>Update UserAgentProfile <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>