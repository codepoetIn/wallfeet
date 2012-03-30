<?php
$this->breadcrumbs=array(
	'Category Amenities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryAmenities', 'url'=>array('index')),
	array('label'=>'Manage CategoryAmenities', 'url'=>array('admin')),
);
?>

<h1>Create CategoryAmenities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>