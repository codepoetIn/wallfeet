<?php
$this->breadcrumbs=array(
	'Category Amenities',
);

$this->menu=array(
	array('label'=>'Create CategoryAmenities', 'url'=>array('create')),
	array('label'=>'Manage CategoryAmenities', 'url'=>array('admin')),
);
?>

<h1>Category Amenities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
