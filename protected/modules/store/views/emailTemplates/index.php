<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create Email Template', 'url'=>array('create')),
	array('label'=>'Manage Email Templates', 'url'=>array('admin')),
);
?>

<h1>List Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
