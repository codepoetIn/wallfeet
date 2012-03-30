<?php
$this->breadcrumbs=array(
	'Project Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectTypes', 'url'=>array('index')),
	array('label'=>'Manage ProjectTypes', 'url'=>array('admin')),
);
?>

<h1>Create ProjectTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>