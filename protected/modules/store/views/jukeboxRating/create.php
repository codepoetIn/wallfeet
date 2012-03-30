<?php
$this->breadcrumbs=array(
	'Jukebox Ratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JukeboxRating', 'url'=>array('index')),
	array('label'=>'Manage JukeboxRating', 'url'=>array('admin')),
);
?>

<h1>Create JukeboxRating</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>