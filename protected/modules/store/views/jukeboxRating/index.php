<?php
$this->breadcrumbs=array(
	'Jukebox Ratings',
);

$this->menu=array(
	array('label'=>'Create JukeboxRating', 'url'=>array('create')),
	array('label'=>'Manage JukeboxRating', 'url'=>array('admin')),
);
?>

<h1>Jukebox Ratings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
