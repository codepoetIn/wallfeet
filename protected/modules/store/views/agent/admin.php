<?php
$this->breadcrumbs=array(
	'User Agent Profiles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserAgentProfile', 'url'=>array('index')),
	array('label'=>'Create UserAgentProfile', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-agent-profile-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Agent Profiles</h1>

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
	'id'=>'user-agent-profile-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'user_id','value'=>'UserApi::getNameByUserId($data->user_id)'),
		'company_name',
		'company_description',
		'address_line1',
		'address_line2',
		/*
		'country_id',
		'state_id',
		'city_id',
		'mobile',
		'telephone',
		'email',
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
