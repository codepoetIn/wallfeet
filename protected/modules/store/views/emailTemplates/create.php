<?php
$this->breadcrumbs=array(
	'Email Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Templates', 'url'=>array('index')),
	array('label'=>'Manage Templates', 'url'=>array('admin')),
);
?>

<h1>Create EmailTemplates</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>