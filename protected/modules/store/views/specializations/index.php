<?php
$this->breadcrumbs=array(
	'Specializations',
);

$this->menu=array(
	array('label'=>'Create Specializations', 'url'=>array('create')),
	array('label'=>'Manage Specializations', 'url'=>array('admin')),
);
?>

<h1>Specializations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
