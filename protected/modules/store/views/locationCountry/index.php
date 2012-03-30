<?php
$this->breadcrumbs=array(
	'Geo Countries',
);

$this->menu=array(
	array('label'=>'Create GeoCountry', 'url'=>array('create')),
	array('label'=>'Manage GeoCountry', 'url'=>array('admin')),
);
?>

<h1>Geo Countries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
