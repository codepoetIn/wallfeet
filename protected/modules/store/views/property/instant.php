<?php
$this->breadcrumbs=array(
	'Properties'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index')),
	array('label'=>'Create Property', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('property-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Instant Properties</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'property-grid',
	'dataProvider'=>$model->search("instant"),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'user_id','value'=>'UserApi::getNameByUserId($data->user_id)'),
		array('name'=>'i_want_to','header'=>'Type'),
		//'property_name',
		/*'description',
		'features',
		'featured',
		'jackpot_investment',
		'instant_home',
		'propertyType.property_type',
		'transactionType.transaction_type',*/
		array('name'=>'city_id','value'=>'isset($data->city()->city) ? $data->city()->city : null'),
		array('name'=>'state_id','value'=>'isset($data->state()->state) ? $data->state()->state : null'),
		array('name'=>'locality_id','value'=>'isset($data->locality()->locality) ? $data->locality()->locality : null'),
		'address',
		/*'bathrooms',
		'bedrooms',
		'furnished',
		'age_of_construction',
		'ownershipType.ownership_type',
		'covered_area',
		'land_area',*/
		'total_price',
		/*'per_unit_price',
		'area_type',
		'display_price',
		'price_negotiable',
		'available_from',
		'available_units',
		'facing',
		'floor_number',
		'total_floors',
		'landmarks',
		'tax_fees',
		'terms_and_conditions',
		'views',
		'recently_viewed',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
		
		array(
			'class'=>'CButtonColumn',
			
			'template'=>'{view} {update} {delete} {approve}',
    		'buttons'=>array(
    					'approve' => array(
           						'imageUrl'=>Yii::app()->theme->baseUrl.'/images/icon-success.png',
								'click'=>'function(){return confirm("Are You want to Approve ?");}',
            					'url'=>'Yii::app()->createUrl("store/property/instant/id/$data->id")',
		 						'visible'=>'$data->instant_home==2',
        				),
			),
    		'htmlOptions'=>array('width'=>'75px','align'=>'left'),
		),
	),
)); ?>
