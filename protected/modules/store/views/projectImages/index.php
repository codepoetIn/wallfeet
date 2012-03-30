<?php
$this->breadcrumbs=array(
	'Project Images',
);

$this->menu=array(
	array('label'=>'Create ProjectImages', 'url'=>array('create')),
	array('label'=>'Manage ProjectImages', 'url'=>array('admin')),
);
?>

<h1>Project Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
