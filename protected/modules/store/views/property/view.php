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
if($model->projectProperties)
	$this->menu[] = array('label'=>'Back to Project', 'url'=>Yii::app()->request->urlReferrer);
?>

<h1>View Property</h1> 

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'User Name',
		'type'=>'raw',
		'value'=>CHtml::link(CHtml::encode(UserApi::getNameByUserId($model->user_id)),
                                 array('/store/user/view','id'=>$model->user_id)),
		),
		'i_want_to',
		'property_name',
		'description',
		'features',
		'featured',
		'jackpot_investment',
		'instant_home',
		'propertyType.property_type',
		'transactionType.transaction_type',
		'locality.locality',
		'address',
		'bathrooms',
		'bedrooms',
		'furnished',
		'age_of_construction',
		'ownershipType.ownership_type',
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
));
$images=PropertyImagesApi::getAllImages($model->id);
$propertyAmenities = $model->propertyAmenities;
$amenities = null;
foreach($propertyAmenities as $i=>$propertyAmenity){
	if($i!=0)
		$amenities.= ", ";
	$amenities.=$propertyAmenity->amenity->amenity;
}
?>
<table id="yw0" class="detail-view">
	<tbody>
		<tr class="even">
			<th>Average Rating</th>
			<td><?php echo PropertyRatingApi::getRating($model->id); ?></td>
		</tr>
	</tbody>
</table>


<table id="yw0" class="detail-view">
	<tbody>
		<tr class="even">
			<th>Amenities</th>
			<td><?php echo $amenities; ?></td>
		</tr>
	</tbody>
</table>

<?php 
	Yii::import('ext.jqPrettyPhoto');
	$options = array(
	   'slideshow'=>5000,
	   'autoplay_slideshow'=>false, 
	   'show_title'=>false
	);
	jqPrettyPhoto::addPretty('.gallery_prettyphoto a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);
	
	jqPrettyPhoto::addPretty('.details_prettyphoto a',jqPrettyPhoto::PRETTY_SINGLE,jqPrettyPhoto::THEME_FACEBOOK, $options);
?>
<div class="gallery_prettyphoto">
<?php 
	if($images){
		echo '<h2>Images</h2>';
		echo '<table border="0" style="width:300px;">';
		echo '<tr>';
		foreach($images as $i=>$image){
			if($i%5==0)
				echo '<tr>';
			echo '<td><a href="'.$image.'" rel="prettyPhoto[gallery]"><img src="'.$image.'" width="100" alt="" /></a></td>';
			if($i%5==4)
				echo '</tr>';
		}
		if($i%5!=4){
			while($i%5==4){
				echo'<td></td>';
				
				$i++;
				if($i%5==4)
					echo '</tr>';
			}
		}
		echo '</table>';
	}

?>
</div>