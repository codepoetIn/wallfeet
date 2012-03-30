<?php
$this->breadcrumbs=array(
	'User Agent Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserAgentProfile', 'url'=>array('index')),
	array('label'=>'Manage UserAgentProfile', 'url'=>array('admin')),
);
?>

<h1>Create UserAgentProfile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>