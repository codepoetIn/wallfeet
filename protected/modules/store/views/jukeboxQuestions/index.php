<?php
$this->breadcrumbs=array(
	'Jukebox Questions',
);

$this->menu=array(
	array('label'=>'Create JukeboxQuestions', 'url'=>array('create')),
	array('label'=>'Manage JukeboxQuestions', 'url'=>array('admin')),
);
?>

<h1>Jukebox Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
