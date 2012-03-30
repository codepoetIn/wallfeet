<?php
$this->breadcrumbs=array(
	'Geo States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GeoState', 'url'=>array('index')),
	array('label'=>'Manage GeoState', 'url'=>array('admin')),
);
?>

<h1>Create GeoState</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>