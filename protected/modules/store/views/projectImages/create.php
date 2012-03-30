<?php
$this->breadcrumbs=array(
	'Project Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProjectImages', 'url'=>array('index')),
	array('label'=>'Manage ProjectImages', 'url'=>array('admin')),
);
?>

<h1>Create ProjectImages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>