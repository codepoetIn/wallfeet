<?php
$this->breadcrumbs=array(
	'Jukebox Answers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JukeboxAnswers', 'url'=>array('index')),
	array('label'=>'Manage JukeboxAnswers', 'url'=>array('admin')),
);
?>

<h1>Create JukeboxAnswers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>