<?php
$this->breadcrumbs=array(
	'Global Settings',
);

$this->menu=array(
	array('label'=>'Create GlobalSettings', 'url'=>array('create')),
	array('label'=>'Manage GlobalSettings', 'url'=>array('admin')),
);
?>

<h1>Global Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
