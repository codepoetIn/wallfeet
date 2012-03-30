
<?php 

switch($type)
{ 
	
	case 4:
		
		?>
		<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'bedrooms'); ?><span class="required">*</span></span> <span
		id="bedrooms-input"> <?php if($model->bedrooms<=10):?> <?php echo CHtml::activeDropdownList($model,'bedrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBedrooms(this.value)')); ?>
		<?php else:?> <?php echo CHtml::activeTextField($model,'bedrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?> </span></li>
	<li class="error_message"><?php echo CHtml::error($model,'bedrooms'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'bathrooms'); ?><span class="required">*</span></span> <span
		id="bathrooms-input"> <?php if($model->bathrooms<=10):?> <?php echo CHtml::activeDropdownList($model,'bathrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBathrooms(this.value)')); ?>
		<?php else:?> <?php echo CHtml::activeTextField($model,'bathrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?></li>
	<li class="error_message"><?php echo CHtml::error($model,'bathrooms'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>

<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'facing'); ?></span> <?php echo CHtml::activeDropdownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'facing'); ?></li>
</ul>
<ul>
	<li><span><?php  
$total_floors = null;
	for($i=0;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	echo CHtml::activeLabelEx($model,'total_floors'); ?></span> <?php echo CHtml::activeDropdownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelExEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset>
	<?php 	
		break;
		
		
		
		
		
case 6:
	
	?>
	<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>


<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'facing'); ?></span> <?php echo CHtml::activeDropdownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'facing'); ?></li>
</ul>
<ul>
	<li><span><?php 
$total_floors = null;
	for($i=0;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	echo CHtml::activeLabelEx($model,'total_floors'); ?></span> <?php echo CHtml::activeDropdownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset>
<?php break; 
case 10:

	?>
<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'facing'); ?></span> <?php echo CHtml::activeDropdownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'facing'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'floor_number'); ?></span> <?php 
	$total_floors = null;
	for($i=0;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	$floor_numbers = array_merge(array('-1'=>'-1'),$total_floors);
	echo CHtml::activeDropdownList($model,'floor_number',$floor_numbers,array('empty'=>'Select','class'=>'slctbox'));
	?></li>
	<li class="error_message"><?php echo CHtml::error($model,'floor_number'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'total_floors'); ?></span> <?php echo CHtml::activeDropdownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset><?php break;
case 11:
case 12:
case 15:
case 16:
case 20:
case 21:

	?>
<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'bathrooms'); ?><span class="required">*</span></span> <span
		id="bathrooms-input"> <?php if($model->bathrooms<=10):?> <?php echo CHtml::activeDropdownList($model,'bathrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBathrooms(this.value)')); ?>
		<?php else:?> <?php echo CHtml::activeTextField($model,'bathrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?></li>
	<li class="error_message"><?php echo CHtml::error($model,'bathrooms'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'facing'); ?></span> <?php echo CHtml::activeDropdownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'facing'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'floor_number'); ?></span> <?php 
	$total_floors = null;
	for($i=0;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	$floor_numbers = array_merge(array('-1'=>'-1'),$total_floors);
	echo CHtml::activeDropdownList($model,'floor_number',$floor_numbers,array('empty'=>'Select','class'=>'slctbox'));
	?></li>
	<li class="error_message"><?php echo CHtml::error($model,'floor_number'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'total_floors'); ?></span> <?php echo CHtml::activeDropdownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset>
<?php break;




case 17:

	?>
<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>


<ul>
	<li><span><?php
$total_floors = null;
	for($i=0;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	echo CHtml::activeLabelEx($model,'total_floors'); ?></span> <?php echo CHtml::activeDropdownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset>
<?php break;
case 18:

	
	?>

<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>


<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<?php break;
case 19:

	?>
<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset>
<?php break;

case 22:

?>

<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'facing'); ?></span> <?php echo CHtml::activeDropdownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'facing'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<?php break;

case 23:
case 24:
case 25:
case 26:
	
?>

<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<?php break;
?>







<?php 
break;
default:
	?>
	<fieldset><legend>Property Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'transaction_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'transaction_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'bedrooms'); ?><span class="required">*</span></span> <span
		id="bedrooms-input"> <?php if($model->bedrooms<=10):?> <?php echo CHtml::activeDropdownList($model,'bedrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBedrooms(this.value)')); ?>
		<?php else:?> <?php echo CHtml::activeTextField($model,'bedrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?> </span></li>
	<li class="error_message"><?php echo CHtml::error($model,'bedrooms'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'bathrooms'); ?><span class="required">*</span></span> <span
		id="bathrooms-input"> <?php if($model->bathrooms<=10):?> <?php echo CHtml::activeDropdownList($model,'bathrooms',
		array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'> 10'),
		array('empty'=>'Select','class'=>'slctbox sml','onChange'=>'fnChangeBathrooms(this.value)')); ?>
		<?php else:?> <?php echo CHtml::activeTextField($model,'bathrooms',array('class'=>'txtbox sml')); ?>
		<?php endif;?></li>
	<li class="error_message"><?php echo CHtml::error($model,'bathrooms'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'age_of_construction'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'age_of_construction'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'ownership_type_id'); ?><span class="required">*</span></span>
	<?php echo CHtml::activeDropdownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'ownership_type_id'); ?></li>
</ul>
</fieldset>


<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'facing'); ?></span> <?php echo CHtml::activeDropdownList($model,'facing',array('East'=>'East','North'=>'North','North - East'=>'North - East','North - West'=>'North - West','South'=>'South','South - East'=>'South - East','South -West'=>'South -West','West'=>'West'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'facing'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'floor_number'); ?></span> <?php 
	$total_floors = null;
	for($i=0;$i<=200;$i++){
		$total_floors[$i] = $i;
	}
	$floor_numbers = array_merge(array('-1'=>'-1'),$total_floors);
	echo CHtml::activeDropdownList($model,'floor_number',$floor_numbers,array('empty'=>'Select','class'=>'slctbox'));
	?></li>
	<li class="error_message"><?php echo CHtml::error($model,'floor_number'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'total_floors'); ?></span> <?php echo CHtml::activeDropdownList($model,'total_floors',$total_floors,array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'total_floors'); ?></li>
</ul>
<ul>
	<li><span><?php echo CHtml::activeLabelEx($model,'description'); ?></span> <?php echo CHtml::activeTextArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo CHtml::error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Amenities</legend>
<ul>
	<li><span><label for="Property_description" class="required">House
	Amenities <span class="required"></span></label></span> 
	<div class="multi_checkbox avg">
	<?php 
	
	echo CHtml::activeCheckBoxList($propertyAmenities,'houseAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'houseAmenities'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">External
	Amenities <span class="required"></span></label></span> <?php //echo CHtml::activeDropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
	<div class="multi_checkbox avg"><?php 

	echo CHtml::activeCheckBoxList($propertyAmenities,'externalAmenities',CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
	?></div>
	</li>
	<li class="error_message"><?php echo CHtml::error($propertyAmenities,'externalAmenities'); ?></li>
</ul>
</fieldset>
<?php break;
}?>







