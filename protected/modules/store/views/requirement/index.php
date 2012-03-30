<?php
$this->breadcrumbs=array(
	'Requirements'=>array('admin'),
	'List'
);

$this->menu=array(
	array('label'=>'Create Requirement', 'url'=>array('create')),
	array('label'=>'Manage Requirement', 'url'=>array('admin')),
);
?>

<h1>Requirements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
