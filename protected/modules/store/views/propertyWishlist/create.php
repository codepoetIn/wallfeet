<?php
$this->breadcrumbs=array(
	'Property Wishlists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PropertyWishlist', 'url'=>array('index')),
	array('label'=>'Manage PropertyWishlist', 'url'=>array('admin')),
);
?>

<h1>Create PropertyWishlist</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>