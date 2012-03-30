<?php 	
	 $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'property-form',
	    'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); 
	?>
	<div id="confirm-button">
	<input type="submit" name="confirm" value="confirm">
	</div>
	<?php
	$propertyFeatures=array('transactionType'=>$transactionType,'ownershipType'=>$ownershipType,'propertyAge'=>$propertyAge);
	$this->widget("PropertyView",
	  array('property'=>$property,
			'propertyAddress'=>$propertyAddress,
	  		'propertyType'=>$propertyType,
	  		'propertyRating'=>$propertyRating,
	  		'propertyWishlist'=>$propertyWishlist,
	  		'propertyFeatures'=>$propertyFeatures,
	  		'propertyAmenities'=>$propertyAmenities,
	  		'propertyImages'=>$propertyImages,
				));
				?>
	<div id="confirm-button">
	<input type="submit" name="confirm" value="confirm">
	</div>
<?php $this->endWidget(); ?>