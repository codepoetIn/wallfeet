<?php
$this->breadcrumbs=array(
	'Project Types',
);

$this->menu=array(
	array('label'=>'Create ProjectTypes', 'url'=>array('create')),
	array('label'=>'Manage ProjectTypes', 'url'=>array('admin')),
);
?>

<h1>Project Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
