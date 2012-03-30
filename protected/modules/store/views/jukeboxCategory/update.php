<?php
$this->breadcrumbs=array(
	'Jukebox Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JukeboxCategory', 'url'=>array('index')),
	array('label'=>'Create JukeboxCategory', 'url'=>array('create')),
	array('label'=>'View JukeboxCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JukeboxCategory', 'url'=>array('admin')),
);
?>

<h1>Update JukeboxCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>