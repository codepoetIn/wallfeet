<?php
$this->breadcrumbs=array(
	'User Builder Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserBuilderProfile', 'url'=>array('index')),
	array('label'=>'Create UserBuilderProfile', 'url'=>array('create')),
	array('label'=>'View UserBuilderProfile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserBuilderProfile', 'url'=>array('admin')),
);
?>

<h1>Update UserBuilderProfile <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>