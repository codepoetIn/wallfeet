<?php
$this->breadcrumbs=array(
	'Feedbacks',
);

$this->menu=array(
	
	array('label'=>'Manage Feedback', 'url'=>array('admin')),
);
?>

<h1>Feedbacks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
