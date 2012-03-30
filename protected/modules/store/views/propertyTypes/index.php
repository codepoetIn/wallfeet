<?php
$this->breadcrumbs=array(
	'Property Types',
);

$this->menu=array(
	array('label'=>'Create PropertyTypes', 'url'=>array('create')),
	array('label'=>'Manage PropertyTypes', 'url'=>array('admin')),
);
?>

<h1>Property Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
