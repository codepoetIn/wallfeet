<?php
$this->breadcrumbs=array(
	'Loans',
);

$this->menu=array(
	array('label'=>'Create Loan', 'url'=>array('create')),
	array('label'=>'Manage Loan', 'url'=>array('admin')),
);
?>

<h1>Loans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
