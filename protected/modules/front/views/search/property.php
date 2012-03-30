<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/script.js"></script>

<div id="property_search">

<?php $this->widget('SearchType',array('type'=>'property'));?>
<div class="inner-column" id="search_property_content" style="display:block">
<?php  $this->widget('PropertyCriteria',array('modelProperty'=>$modelProperty,
											  'modelCity'=>$modelCity,
											  'modelLocality'=>$modelLocality,
											  'propertyAmenities'=>$propertyAmenities,
											  'amenities'=>$propertyAmenities,
											  'modelState'=>$modelState)); ?>
												   
												   
<?php  $this->widget('PropertyResults',array('properties'=>$properties,
											 'pages'=>$pages,
											 'propertiesCount'=>$propertiesCount,

													)); ?>
<br class="clear" />
</div>

</div>
