<?php
$this->breadcrumbs=array(
	'Jukebox Answers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JukeboxAnswers', 'url'=>array('index')),
	array('label'=>'Create JukeboxAnswers', 'url'=>array('create')),
	array('label'=>'View JukeboxAnswers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JukeboxAnswers', 'url'=>array('admin')),
);
?>

<h1>Update JukeboxAnswers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>