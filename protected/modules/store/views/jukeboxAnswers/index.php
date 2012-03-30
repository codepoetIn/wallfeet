<?php
$this->breadcrumbs=array(
	'Jukebox Answers',
);

$this->menu=array(
	array('label'=>'Create JukeboxAnswers', 'url'=>array('create')),
	array('label'=>'Manage JukeboxAnswers', 'url'=>array('admin')),
);
?>

<h1>Jukebox Answers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
