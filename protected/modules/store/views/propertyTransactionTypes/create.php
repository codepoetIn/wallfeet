<?php
$this->breadcrumbs=array(
	'Property Transaction Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PropertyTransactionTypes', 'url'=>array('index')),
	array('label'=>'Manage PropertyTransactionTypes', 'url'=>array('admin')),
);
?>

<h1>Create PropertyTransactionTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>