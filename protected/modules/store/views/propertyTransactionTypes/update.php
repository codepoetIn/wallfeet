<?php
$this->breadcrumbs=array(
	'Property Transaction Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PropertyTransactionTypes', 'url'=>array('index')),
	array('label'=>'Create PropertyTransactionTypes', 'url'=>array('create')),
	array('label'=>'View PropertyTransactionTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PropertyTransactionTypes', 'url'=>array('admin')),
);
?>

<h1>Update PropertyTransactionTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>