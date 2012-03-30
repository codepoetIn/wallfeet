<?php
$this->breadcrumbs=array(
	'Jukebox Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JukeboxCategory', 'url'=>array('index')),
	array('label'=>'Manage JukeboxCategory', 'url'=>array('admin')),
);
?>

<h1>Create JukeboxCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>