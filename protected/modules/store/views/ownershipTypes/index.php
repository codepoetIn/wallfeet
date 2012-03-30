<?php
$this->breadcrumbs=array(
	'Category Ownership Types',
);

$this->menu=array(
	array('label'=>'Create CategoryOwnershipTypes', 'url'=>array('create')),
	array('label'=>'Manage CategoryOwnershipTypes', 'url'=>array('admin')),
);
?>

<h1>Category Ownership Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
