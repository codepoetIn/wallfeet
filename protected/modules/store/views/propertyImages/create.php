<?php
$this->breadcrumbs=array(
	'Property Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PropertyImages', 'url'=>array('index')),
	array('label'=>'Manage PropertyImages', 'url'=>array('admin')),
);
?>

<h1>Create PropertyImages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>