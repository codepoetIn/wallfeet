<?php
$this->breadcrumbs=array(
	'Jukebox Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JukeboxQuestions', 'url'=>array('index')),
	array('label'=>'Create JukeboxQuestions', 'url'=>array('create')),
	array('label'=>'View JukeboxQuestions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JukeboxQuestions', 'url'=>array('admin')),
);
?>

<h1>Update JukeboxQuestions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>