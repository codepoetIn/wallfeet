<?php
$this->breadcrumbs=array(
	'Jukebox Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JukeboxQuestions', 'url'=>array('index')),
	array('label'=>'Manage JukeboxQuestions', 'url'=>array('admin')),
);
?>

<h1>Create JukeboxQuestions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>