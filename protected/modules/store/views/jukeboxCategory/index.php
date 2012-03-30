<?php
$this->breadcrumbs=array(
	'Jukebox Categories',
);

$this->menu=array(
	array('label'=>'Create JukeboxCategory', 'url'=>array('create')),
	array('label'=>'Manage JukeboxCategory', 'url'=>array('admin')),
);
?>

<h1>Jukebox Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
