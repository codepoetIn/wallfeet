<?php
$this->breadcrumbs=array(
	'Category Ownership Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryOwnershipTypes', 'url'=>array('index')),
	array('label'=>'Manage CategoryOwnershipTypes', 'url'=>array('admin')),
);
?>

<h1>Create CategoryOwnershipTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>