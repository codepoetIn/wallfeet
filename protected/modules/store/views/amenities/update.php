<?php
$this->breadcrumbs=array(
	'Category Amenities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryAmenities', 'url'=>array('index')),
	array('label'=>'Create CategoryAmenities', 'url'=>array('create')),
	array('label'=>'View CategoryAmenities', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryAmenities', 'url'=>array('admin')),
);
?>

<h1>Update CategoryAmenities <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>