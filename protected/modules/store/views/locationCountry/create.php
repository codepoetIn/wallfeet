<?php
$this->breadcrumbs=array(
	'Geo Countries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GeoCountry', 'url'=>array('index')),
	array('label'=>'Manage GeoCountry', 'url'=>array('admin')),
);
?>

<h1>Create GeoCountry</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>