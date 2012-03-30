<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/detailView.css" />
<?php
$this->breadcrumbs=array(
	'Properties'=>array('index'),
	'View',
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index')),
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'Update Property', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Property', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Property', 'url'=>array('admin')),
);
?>

<h1>View Property</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name'=>'user_id','value'=>UserApi::getNameByUserId($model->user_id)),
		'i_want_to',
		'property_name',
		'description',
		'features',
		'featured',
		'jackpot_investment',
		'instant_home',
		'property_type_id',
		'transaction_type_id',
		'locality_id',
		'address',
		'bathrooms',
		'bedrooms',
		'furnished',
		'age_of_construction',
		'ownership_type_id',
		'covered_area',
		'land_area',
		'total_price',
		'per_unit_price',
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
		/*'views',
		'recently_viewed',
		'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
)); ?>
