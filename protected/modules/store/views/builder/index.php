<?php
$this->breadcrumbs=array(
	'User Builder Profiles',
);

$this->menu=array(
	array('label'=>'Create UserBuilderProfile', 'url'=>array('create')),
	array('label'=>'Manage UserBuilderProfile', 'url'=>array('admin')),
);
?>

<h1>User Builder Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
