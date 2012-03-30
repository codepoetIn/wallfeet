<?php
$this->breadcrumbs=array(
	'User Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserSettings', 'url'=>array('index')),
	array('label'=>'Create UserSettings', 'url'=>array('create')),
	array('label'=>'View UserSettings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserSettings', 'url'=>array('admin')),
);
?>

<h1>Update UserSettings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>