<?php
$this->breadcrumbs=array(
	'Property Wishlists',
);

$this->menu=array(
	array('label'=>'Create PropertyWishlist', 'url'=>array('create')),
	array('label'=>'Manage PropertyWishlist', 'url'=>array('admin')),
);
?>

<h1>Property Wishlists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
