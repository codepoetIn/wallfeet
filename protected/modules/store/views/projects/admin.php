<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Create Projects', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('projects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Projects</h1>

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
	'id'=>'projects-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'user_id','value'=>'UserApi::getNameByUserId($data->user_id)'),
		/*array(
        'name'  => 'user_id',
        'value' => '<a href="/store/user/view/id/'.$data->user_id.'">UserApi::getNameByUserId($data->user_id)</a>',
        'type'  => 'raw',
    ),*/
    
    
    
		'project_name',
		//'description',
		'projectType.project_type',
		'ownershipType.ownership_type',
		array('header'=>'Location','type'=>'raw','value'=>'$data->locality->locality.",<br />".$data->locality->city->city.",<br />".$data->locality->city->state->state.",<br />".$data->locality->city->state->country->country'),
		
		'features',
		'covered_area',
		'land_area',
		'total_price',
		/*'price_starting_from',
		'per_unit_price',
		'area_type',
		'display_price',
		'price_negotiable',
		'landmarks',
		'tax_fees',
		'terms_and_conditions',
		'views',
		'recently_viewed',*/
		array('header'=>'Average Rating','value'=>'ProjectRatingApi::getRating($data->id)'),
		/*
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
