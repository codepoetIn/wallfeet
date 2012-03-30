<?php
$this->breadcrumbs=array(
	'Property Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PropertyTypes', 'url'=>array('index')),
	array('label'=>'Manage PropertyTypes', 'url'=>array('admin')),
);
?>

<h1>Create PropertyTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>