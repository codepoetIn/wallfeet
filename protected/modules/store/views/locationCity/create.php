<?php
$this->breadcrumbs=array(
	'Geo Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GeoCity', 'url'=>array('index')),
	array('label'=>'Manage GeoCity', 'url'=>array('admin')),
);
?>

<h1>Create GeoCity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>