<?php
$this->breadcrumbs=array(
	'Property Age Of Constructions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PropertyAgeOfConstruction', 'url'=>array('index')),
	array('label'=>'Manage PropertyAgeOfConstruction', 'url'=>array('admin')),
);
?>

<h1>Create PropertyAgeOfConstruction</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>