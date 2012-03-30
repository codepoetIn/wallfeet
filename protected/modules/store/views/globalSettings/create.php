<?php
$this->breadcrumbs=array(
	'Global Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GlobalSettings', 'url'=>array('index')),
	array('label'=>'Manage GlobalSettings', 'url'=>array('admin')),
);
?>

<h1>Create GlobalSettings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>