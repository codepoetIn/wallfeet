<script type="text/javascript">
function fnChangeBedrooms(value){
	if(value>10){
		document.getElementById('bedrooms-input').innerHTML='<input type="text" id="Property_bedrooms" name="Property[bedrooms]" class="txtbox sml">';
	}
}
function fnChangeBathrooms(value){
	if(value>10){
		document.getElementById('bathrooms-input').innerHTML='<input type="text" id="Property_bathrooms" name="Property[bathrooms]" class="txtbox sml">';
	}
}
</script>



<div id="property_search">
<h1 class="heading">Post Property <?php 
/*if($modelProject){
	echo ' For <a href="#">'.$modelProject->project_name.'</a>';
}*/
?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'property-form',
    //'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?> <?php //echo $form->errorSummary($model); ?>
<div class="property_details_wrap_post">
<span id="property-hidden"> 
	<?php echo $form->hiddenField($model,'country');?>
	<?php echo $form->hiddenField($model,'city');?> <?php echo $form->hiddenField($model,'state');?>
	<?php echo $form->hiddenField($model,'zip');?> <?php echo $form->hiddenField($model,'address2');?>	
	</span> 
<span id="position-hidden"> <?php echo $form->hiddenField($model,'latitude');?>
<?php echo $form->hiddenField($model,'longitude');?> </span>

<fieldset><legend>Basic Details</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'i_want_to'); ?></span> 
	<?php echo $form->radioButtonList($model,'i_want_to',array('Sell'=>'Sell','Rent'=>'Rent Out','Lease'=>'Lease'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline'))); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'i_want_to'); ?></li>
</ul>

<ul>
	<li><span><?php echo $form->labelEx($model,'property_type_id'); ?></span>
	<?php echo $form->dropDownList($model,'property_type_id',CHtml::listData(PropertyTypes::model()->findAll(),'id','property_type','category.category'),array('empty'=>'Select','class'=>'slctbox','disabled'=>'true'));	?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'property_type_id'); ?></li>
</ul>


</fieldset>

<fieldset><legend>Property Address</legend>
<div id="city_content">
<ul>
	<li><span><?php echo $form->labelEx($model,'city_id'); ?></span> <?php echo $form->dropdownList($model,'city_id',
	CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state'),
	array('empty'=>'Select','id'=>'geo_city','class'=>'select-box-signup',
		 'ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('/location/map/render/name/Property/request/Property'),  
                        'update'=>'#property-hidden',
						'data'=>'js:jQuery(this).serialize()',
	)
	)); ?></li>
	<li class="error_message"><?php echo $form->error($model,'city_id'); ?></li>
</ul>
</div>
<ul>
	<li><span><?php echo $form->labelEx($model,'locality_id'); ?></span>
	<div id="locality_content" class="dis_inline">	
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
 			'name'=>'Property[locality]',
			'value'=>$locality,
			'source' => array_values($localityList),
			'htmlOptions'=>array('class'=>'txtbox med')
		));
	?></div>
	</li>
	<li class="error_message"><?php echo $form->error($model,'locality_id'); ?></li>
</ul>

<ul>
	<li><span><?php echo $form->labelEx($model,'address'); ?></span> <?php echo $form->textArea($model,'address',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'address'); ?></li>
</ul>

<ul>
	<li><span><?php echo $form->labelEx($model,'pincode'); ?></span> <?php echo $form->textField($model,'pincode',array('class'=>'txtbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'pincode'); ?></li>
</ul>
</fieldset>



<fieldset><legend>Property Location</legend>
<ul>
	<li><span><label>Selected Location</label></span> <span
		id="location-map"> <?php Yii::import('ext.jquery-gmap.*');?> <?php
		$gmap = new EGmap3Widget();
		$gmap->setSize('300','200');
		$gmap->setOptions(array(
	        'zoom' => 6,
	        'center' => $locationPosition,
			'draggable'=>false,
			'panControl'=>false,
			'minZoom'=>8,
			'width'=>'300px',
			'height'=>'200px',
		));
		// add a marker
		$marker = new EGmap3Marker(array(
	    'title' => 'Updateable marker',
		'draggable' => true,
		));
		$marker->latLng = $locationPosition;
		$marker->centerOnMap();
		//	$marker->address = '10 Downing St, Westminster, London SW1A 2, UK';

		$js = "function(marker, event, data){
        var map = $(this).gmap3('get'),
           		  infowindow = $(this).gmap3({action:'get', name:'infowindow'}); 
		          if (infowindow){
			            infowindow.open(map, marker);
			            infowindow.setContent(data);
		          } else {
			            $('#Property_latitude').val(marker.getPosition().lat());
	        		  	$('#Property_longitude').val(marker.getPosition().lng());
		          }
		}";	
		$marker->addEvent('click', $js);
		$marker->addEvent('drag', $js);
		$marker->addEvent('dragend', $js);
		$marker->addEvent('position_changed', $js);

		$gmap->add($marker);

		// tell the gmap to update the marker from the Address model fields.
		$gmap->updateMarkerAddressFromModel(
		// the model object
		$model,
		// the model attributes to capture, these MUST be present in the form
		// constructed above. Attributes must also be given in the correct
		// order for assembling the address string.
		array('address','address2','city','zip','state','country'),
		// you may pass these options :
		// 'first' - set to first marker added to map, default is last
		// 'nopan' - do not pan the map on marker update.
		array()
		);

		$gmap->renderMap();

		?> </span></li>
	<br class="clear" />

	<li class="error_message"></li>
</ul>
</fieldset>

<fieldset><legend>Area &amp; Price details</legend>

<ul style="display:block;" id="P_area">
	<li><span><?php echo $form->labelEx($model,'covered_area'); ?><span class="required">*</span></span> 
	<?php echo $form->textField($model,'covered_area',array('class'=>'txtbox sml')); echo $form->dropDownList($model,'c_area_units',PropertyApi::getUnits('covered'),array('empty'=>'Select','class'=>'slctbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'c_area_units');?></li>
	<li class="error_message"><?php echo $form->error($model,'covered_area'); ?></li> 
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'land_area'); ?></span> 
	<?php echo $form->textField($model,'land_area',array('class'=>'txtbox sml'));  echo $form->dropDownList($model,'l_area_units',PropertyApi::getUnits('plot'),array('empty'=>'Select','class'=>'slctbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'l_area_units'); ?></li>
	<li class="error_message"><?php echo $form->error($model,'land_area');  ?></li> 
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'total_price');?></span> 
	<?php echo $form->textField($model,'total_price',array('class'=>'txtbox sml',
		'ajax' => array(
        		       'type'=>'POST',
                        'url'=>CController::createUrl('/general/ajaxNumber/convert'),  
                        'update'=>'#total_price_words',
						'data'=>'js:jQuery(this).serialize()',
						)
					)); ?>
	<span id="total_price_words" style="float:none"></span>
	</li>
	<li class="error_message"><?php echo $form->error($model,'total_price'); ?></li>
</ul>

<ul>
	<li><span><?php echo $form->labelEx($model,'display_price'); ?></span>
	<?php echo $form->radioButtonList($model,'display_price',array('1'=>'Yes','0'=>'No'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline'))); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'display_price'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'price_negotiable'); ?></span>
	<?php echo $form->radioButtonList($model,'price_negotiable',array('1'=>'Yes','0'=>'No'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline'))); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'price_negotiable'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'available_from'); ?></span>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$model,
			    	'attribute'=>'available_from',		
			    	'options'=>array(
						'dateFormat'=>'yy-mm-dd',
			        	'showAnim'=>'fold',
	),
			    	'htmlOptions'=>array(
			        	'class'=>'txtbox sml',
			        	'readonly'=>'readonly',
	),
	)
	);
	?></li>
	<li class="error_message"><?php echo $form->error($model,'available_from'); ?></li>
</ul>
</fieldset>
<div id="property_type_content">
<fieldset><legend>Property Details</legend>
<ul style="display:block;" id="P_transaction">
	<li><span><?php echo $form->labelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo $form->dropDownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'transaction_type_id'); ?></li>
</ul>
<ul style="display:block;" id="P_bedroom">
	<li><span><?php echo $form->labelEx($model,'bedrooms'); ?><span class="required">*</span></span> <span
		id="bedrooms-input"> <?php if($model->bedrooms<=10):?> <?php echo $form->dropDownList($model,'bedrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBedrooms(this.value)')); ?>
		<?php else:?> <?php echo $form->textField($model,'bedrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?> </span></li>
	<li class="error_message"><?php echo $form->error($model,'bedrooms'); ?></li>
</ul>
<ul style="display:block;" id="P_bathroom">
	<li><span><?php echo $form->labelEx($model,'bathrooms'); ?><span class="required">*</span></span> <span
		id="bathrooms-input"> <?php if($model->bathrooms<=10):?> <?php echo $form->dropDownList($model,'bathrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBathrooms(this.value)')); ?>
		<?php else:?> <?php echo $form->textField($model,'bathrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?></li>
	<li class="error_message"><?php echo $form->error($model,'bathrooms'); ?></li>
</ul>
<ul style="display:block;" id="P_age">
	<li><span><?php echo $form->labelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo $form->dropDownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo $form->dropDownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'ownership_type_id'); ?></li>
</ul>

</fieldset>


<fieldset><legend>Additional Details</legend>
<ul style="display:block;" id="P_facing">
	<li><span><?php echo $form->labelEx($model,'facing'); ?></span> <?php echo $form->dropDownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'facing'); ?></li>
</ul>
<ul style="display:block;" id="P_floor">
	<li><span><?php echo $form->labelEx($model,'floor_number'); ?></span> <?php 
	$total_floors = null;
	for($i=1;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	$floor_numbers = array_merge(array('-1'=>'-1','0'=>'0'),$total_floors);
	echo $form->dropDownList($model,'floor_number',$floor_numbers,array('empty'=>'Select','class'=>'slctbox','onChange'=>'validateFloor(\'Property_total_floors\')'));
	?></li>
	<li class="error_message"><?php echo $form->error($model,'floor_number'); ?></li>
</ul>
<ul style="display:block;" id="P_tfloor">
	<li><span><?php echo $form->labelEx($model,'total_floors'); ?></span> <?php echo $form->dropDownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox','onChange'=>'validateTFloor(\'Property_floor_number\',\'Property_total_floors\')')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'description'); ?></span> <?php echo $form->textArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'description'); ?></li>
</ul>
</fieldset>

<fieldset style="display:block;" id="P_amenity"><legend>Amenities</legend>

<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> <?php //echo $form->dropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg">
	
	
	<?php 
	echo CHtml::checkBoxList('PropertyAmenitiesHouse',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	//echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo $form->error($propertyAmenities,'amenity_id'); ?></li>
</ul>

<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo $form->dropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 
	echo CHtml::checkBoxList('PropertyAmenitiesExternal',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo $form->error($propertyAmenities,'amenity_id'); ?></li>
</ul>
</fieldset>
</div>

<div style="display:block">
<fieldset><legend>Distance from Key Facilities</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'hospital'); ?></span>
	<?php echo $form->textField($model,'hospital',array('class'=>'txtbox sml')); ?> Km(s)
	</li>
	<li class="error_message"><?php echo $form->error($model,'hospital'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'school'); ?></span>
	<?php echo $form->textField($model,'school',array('class'=>'txtbox sml')); ?> Km(s)
	</li>
	<li class="error_message"><?php echo $form->error($model,'school'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'railway'); ?></span>
	<?php echo $form->textField($model,'railway',array('class'=>'txtbox sml')); ?> Km(s)
	</li>
	<li class="error_message"><?php echo $form->error($model,'railway'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'airport'); ?></span>
	<?php echo $form->textField($model,'airport',array('class'=>'txtbox sml')); ?> Km(s)
	</li>
	<li class="error_message"><?php echo $form->error($model,'airport'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'city_centre'); ?></span>
	<?php echo $form->textField($model,'city_centre',array('class'=>'txtbox sml')); ?> Km(s)
	</li>
	<li class="error_message"><?php echo $form->error($model,'city_centre'); ?></li>
</ul>
</fieldset>

<fieldset><legend>LandMarks</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'landmarks'); ?></span> <?php echo $form->textArea($model,'landmarks',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'landmarks'); ?></li>
</ul>


</fieldset>

<fieldset><legend>Additional Price Details</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'per_unit_price'); ?></span>
	<?php echo $form->textField($model,'per_unit_price',array('class'=>'txtbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'per_unit_price'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'booking_amount'); ?></span>
	<?php echo $form->textField($model,'booking_amount',array('class'=>'txtbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'booking_amount'); ?></li>
</ul>

<ul>
	<li><span><?php echo $form->labelEx($model,'annual_dues'); ?></span> 
	<?php echo $form->textField($model,'annual_dues',array('class'=>'txtbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'annual_dues'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'maintanence_charge'); ?></span>
	<?php echo $form->textField($model,'maintanence_charge',array('class'=>'txtbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'maintanence_charge'); ?></li>
</ul>

</fieldset>
</div>


<fieldset><legend>Property Photographs</legend>
<ul>

	<li><span><?php echo $form->labelEx($propertyImages,'image'); ?></span>
	<?php $this->widget('ext.uploadify.MUploadify',array(
					  	'model'=>$propertyImages,
						'attribute'=>'image',
						'multi'=>true,
					  	'script'=>$this->createUrl('/front/property/imagesUpload'),
  						'fileDesc'    => 'Web Image Files (.JPG, .GIF, .PNG)',
						'fileExt'=>'*.jpg',
					  	'auto'=>true,
						'removeCompleted'=>false,
						'onError'=>'js:function (event,ID,fileObj,errorObj) {
    					 alert(" Error: Sorry could not upload images to the server.")}',						
	//'someOption'=>'someValue',
	));?> <?php //echo $form->fileField($propertyImages,'image'); ?></li>
	<?php if($currentImages):?><br clear="all" />
	<h4><b>Current Images</b></h4>
	<?php foreach($currentImages as $key=>$image):?>
	<li><img src="<?php echo $image?>" width="100px"/>&nbsp;
	<span style="float:none;" id="image_status_<?php echo $key;?>">
		<?php echo CHtml::ajaxLink('Delete',Yii::app()->createUrl("/property/update/$model->id/$key"),array(
		                                'type'=>'POST',  
		                                'update'=>"#image_status_$key",
										'data'=>"$key",
		            			  ),array('class'=>'red-txt'));?>
	</span>
	</li><br clear="all" />
	<?php endforeach;?>
	<?php endif;?>
	<li class="error_message"><?php echo $form->error($propertyImages,'image'); ?></li>
</ul>
<ul>
<li><span><?php echo $form->labelEx($model,'video_url')?></span></li>
<li><?php echo $form->textField($model,'video_url',array('class'=>'slctbox'))?></li>
<li class="error_message"><?php echo $form->error($model,'video_url'); ?></li>
</ul>
</fieldset>

<fieldset><legend>Promote your listing</legend>
<ul>
	<li><?php echo CHtml::activeCheckBox($model,'jackpot_investment'); ?> <img
		src="<?php echo Yii::app()->theme->baseUrl; ?>/images/jackpot.jpg"
		border="0" /> Promote your listing to our Jackpot Investments to
	ensure rapid quick response. Listing in Jackpot Investments is subject
	to our experts' verification of the property and documents.</li>
</ul>
<ul>
	<li><?php echo CHtml::activeCheckBox($model,'featured'); ?> <img
		src="<?php echo Yii::app()->theme->baseUrl; ?>/images/premium.jpg"
		border="0" /> Highlight your listing in our premium listings. We
	promote your listing to maximum wallfeet users. More people viewing
	your property = Better rate of conversion!</li>
</ul>
<ul>
	<li><?php echo CHtml::activeCheckBox($model,'instant_home'); ?> <img
		src="<?php echo Yii::app()->theme->baseUrl; ?>/images/instant.jpg"
		border="0" /> Need to sell this property immediately?? Our Instant
	earnings scheme is for you. Instant process is subject to our experts'
	verification of the property and documents.</li>
</ul>
</fieldset>
<div align="center"><input type="submit" name="submit" value=""
	class="btn-submit" border="0" /></div>
</div>

	<?php $this->endWidget(); ?></div>
<script type="text/javascript">
	//fnMultiSelect('amenities-multi',"<?php echo $amenities; ?>");
	function additionalDetails()
	{
		var text=document.getElementById("additional_details");
		if(text.checked)
		{
			document.getElementById("additional").style.display='block';
		}
		else
		{
			document.getElementById("additional").style.display='none';
		}
	}
</script>

<script type="text/javascript">
function fnPropertyTypes(val) {
	var ptype=val.value;
	if((ptype==1)||(ptype==2)||(ptype==3)||(ptype==5)||(ptype==7)||(ptype==8)||(ptype==9)||(ptype==13)||(ptype==14)){
					
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="block";
		document.getElementById('P_bathroom').style.display="block";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="block";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
	else if(ptype==4){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="block";
		document.getElementById('P_bathroom').style.display="block";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
	else if(ptype==6){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
	else if(ptype==10){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="block";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
	else if((ptype==11)||(ptype==12)||(ptype==15)||(ptype==16)||(ptype==20)||(ptype==21)){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="block";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="block";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
	else if(ptype==17){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="none";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
	else if(ptype==18){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="none";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="none";
		document.getElementById('P_amenity').style.display="none";	
	}
	else if(ptype==19){
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="none";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="none";	
		document.getElementById('P_amenity').style.display="block";	
	}
	else if(ptype==22){
		document.getElementById('P_area').style.display="none";
		document.getElementById('P_transaction').style.display="none";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="none";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="none";
		document.getElementById('P_amenity').style.display="none";	
	}
	else if((ptype==23)||(ptype==24)||(ptype==25)||(ptype==26)){
		document.getElementById('P_area').style.display="none";
		document.getElementById('P_transaction').style.display="none";
		document.getElementById('P_bedroom').style.display="none";
		document.getElementById('P_bathroom').style.display="none";
		document.getElementById('P_age').style.display="none";
		document.getElementById('P_facing').style.display="none";
		document.getElementById('P_floor').style.display="none";
		document.getElementById('P_tfloor').style.display="none";
		document.getElementById('P_amenity').style.display="none";		
	}
	else{
		document.getElementById('P_area').style.display="block";
		document.getElementById('P_transaction').style.display="block";
		document.getElementById('P_bedroom').style.display="block";
		document.getElementById('P_bathroom').style.display="block";
		document.getElementById('P_age').style.display="block";
		document.getElementById('P_facing').style.display="block";
		document.getElementById('P_floor').style.display="block";
		document.getElementById('P_tfloor').style.display="block";
		document.getElementById('P_amenity').style.display="block";	
	}
}
</script>

<script type="text/javascript">
 	 function validateFloor(tfloor)
	 {
	 	document.getElementById(tfloor).value="";
	 }		
 	function validateTFloor(floor,tfloor)
	 {
	 	var floor_val=(document.getElementById(floor).value)-1;
	 	var tfloor_val=document.getElementById(tfloor).value;
	 	if(floor_val>tfloor_val)
	 	{
	 		alert("Floor Number is less than Total Floors");
	 		document.getElementById(tfloor).value="";
	 	}
	 }			
</script>


