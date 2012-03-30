<?php
$this->breadcrumbs=array(
	'Property Age Of Constructions',
);

$this->menu=array(
	array('label'=>'Create PropertyAgeOfConstruction', 'url'=>array('create')),
	array('label'=>'Manage PropertyAgeOfConstruction', 'url'=>array('admin')),
);
?>

<h1>Property Age Of Constructions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
