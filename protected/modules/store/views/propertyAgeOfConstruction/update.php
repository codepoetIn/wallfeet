<?php
$this->breadcrumbs=array(
	'Property Age Of Constructions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PropertyAgeOfConstruction', 'url'=>array('index')),
	array('label'=>'Create PropertyAgeOfConstruction', 'url'=>array('create')),
	array('label'=>'View PropertyAgeOfConstruction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PropertyAgeOfConstruction', 'url'=>array('admin')),
);
?>

<h1>Update PropertyAgeOfConstruction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>