<?php
$this->breadcrumbs=array(
	'Property Wishlists'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PropertyWishlist', 'url'=>array('index')),
	array('label'=>'Create PropertyWishlist', 'url'=>array('create')),
	array('label'=>'View PropertyWishlist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PropertyWishlist', 'url'=>array('admin')),
);
?>

<h1>Update PropertyWishlist <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>