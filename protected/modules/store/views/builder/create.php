<?php
$this->breadcrumbs=array(
	'User Builder Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserBuilderProfile', 'url'=>array('index')),
	array('label'=>'Manage UserBuilderProfile', 'url'=>array('admin')),
);
?>

<h1>Create UserBuilderProfile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>