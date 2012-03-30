<?php
$this->breadcrumbs=array(
	'Property Images',
);

$this->menu=array(
	array('label'=>'Create PropertyImages', 'url'=>array('create')),
	array('label'=>'Manage PropertyImages', 'url'=>array('admin')),
);
?>

<h1>Property Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
