<?php
$this->breadcrumbs=array(
	'Requirements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Requirement', 'url'=>array('index')),
	array('label'=>'Manage Requirement', 'url'=>array('admin')),
);
?>

<h1>Create Requirement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>