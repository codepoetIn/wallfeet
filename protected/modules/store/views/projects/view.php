<?php
$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'View',
);
$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Create Projects', 'url'=>array('create')),
	array('label'=>'Update Projects', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Projects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Projects', 'url'=>array('admin')),
);
?>
<h1>View Projects</h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'User Name',
		'type'=>'raw',
		'value'=>CHtml::link(CHtml::encode(UserApi::getNameByUserId($model->user_id)),
                                 array('/store/user/view','id'=>$model->user_id)),
		),
		'project_name',
		'description',
		'projectType.project_type',
		'ownershipType.ownership_type',
		'locality.locality',
		'address',
		'features',
		'covered_area',
		'land_area',
		'total_price',
		'price_starting_from',
		'per_unit_price',
		'area_type',
		'display_price',
		'price_negotiable',
		'landmarks',
		'tax_fees',
		'terms_and_conditions',
		'views',
		'recently_viewed',
		
		/*'updated_time',
		'updated_by',
		'created_time',
		'created_by',*/
	),
	
	
)); 
$images=ProjectImagesApi::getAllImages($model->id);
$projectImages=ProjectImagesApi::getAll($model->id);
$projectAmenities = $model->projectAmenities;
$amenities = null;
foreach($projectAmenities as $i=>$projectAmenity){
	if($i!=0)
		$amenities.= ", ";
	$amenities.=$projectAmenity->amenity->amenity;
}

?>
<table id="yw0" class="detail-view">
	<tbody>
		<tr class="even">
			<th>Amenities</th>
			<td><?php echo $amenities; ?></td>
		</tr>
	</tbody>
</table>

<table id="yw0" class="detail-view">
	<tbody>
		<tr class="odd">
			<th>Average Rating</th>
			<td><?php echo ProjectRatingApi::getRating($model->id); ?></td>
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
<?php
$projectProperties = $model->projectProperties;
$properties = null;
if ($projectProperties) {
	echo '<h2>Properties</h2>';
	echo '<ul>';
	foreach ( $projectProperties as $projectProperty ) {
		echo '<li>';
		echo '<a href="http://wallfeet/store/property/view/id/'. $projectProperty->property_id .'?iframe=true &width=1000&height=500"  title="">' . $projectProperty->property->property_name . '</a><br></br>';
		echo '</li>';
		}
    echo '</ul>';
}
?>
