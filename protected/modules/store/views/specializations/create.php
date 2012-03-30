<?php
$this->breadcrumbs=array(
	'Specializations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Specializations', 'url'=>array('index')),
	array('label'=>'Manage Specializations', 'url'=>array('admin')),
);
?>

<h1>Create Specializations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>