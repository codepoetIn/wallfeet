<?php
$this->breadcrumbs=array(
	'Jukebox Ratings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JukeboxRating', 'url'=>array('index')),
	array('label'=>'Create JukeboxRating', 'url'=>array('create')),
	array('label'=>'View JukeboxRating', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JukeboxRating', 'url'=>array('admin')),
);
?>

<h1>Update JukeboxRating <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>