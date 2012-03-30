<?php
$this->breadcrumbs=array(
	'Geo States',
);

$this->menu=array(
	array('label'=>'Create GeoState', 'url'=>array('create')),
	array('label'=>'Manage GeoState', 'url'=>array('admin')),
);
?>

<h1>Geo States</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
