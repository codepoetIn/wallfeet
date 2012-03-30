<?php
$this->breadcrumbs=array(
	'User Specialist Projects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserSpecialistProjects', 'url'=>array('index')),
	array('label'=>'Create UserSpecialistProjects', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-specialist-projects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Specialist Projects</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-specialist-projects-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'user_id','value'=>'UserApi::getNameByUserId($data->user_id)'),
		array('name'=>'specialist_type_id','value'=>'$data->specialistType->specialist'),
		'project_name',
		'description',
		'image',
		/*
		'duration',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
