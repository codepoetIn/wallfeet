<?php
$this->breadcrumbs=array(
	'Category Ownership Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryOwnershipTypes', 'url'=>array('index')),
	array('label'=>'Create CategoryOwnershipTypes', 'url'=>array('create')),
	array('label'=>'View CategoryOwnershipTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryOwnershipTypes', 'url'=>array('admin')),
);
?>

<h1>Update CategoryOwnershipTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>