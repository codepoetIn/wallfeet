<?php
$this->breadcrumbs=array(
	'Property Transaction Types',
);

$this->menu=array(
	array('label'=>'Create PropertyTransactionTypes', 'url'=>array('create')),
	array('label'=>'Manage PropertyTransactionTypes', 'url'=>array('admin')),
);
?>

<h1>Property Transaction Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
