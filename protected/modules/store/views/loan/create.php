<?php
$this->breadcrumbs=array(
	'Loans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Loan', 'url'=>array('index')),
	array('label'=>'Manage Loan', 'url'=>array('admin')),
);
?>

<h1>Create Loan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>