<?php
$this->breadcrumbs=array(
	'Geo Cities',
);

$this->menu=array(
	array('label'=>'Create GeoCity', 'url'=>array('create')),
	array('label'=>'Manage GeoCity', 'url'=>array('admin')),
);
?>

<h1>Geo Cities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
