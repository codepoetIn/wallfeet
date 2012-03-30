<?php 	
	 $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'requirement-form',
	    'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); 
	?>
	<div id="confirm-button">
	<input type="submit" name="confirm" value="confirm">
	</div>
	<?php
	$this->widget("RequirementView",
	
	  array('requirement'=>$requirement,
			'requirementPropertyAmenities'=>$requirementPropertyAmenities,
	  		'requirementPropertyType'=>$requirementPropertyType,
	  		'requirementCities'=>$requirementCities,
	  		'requirementBedrooms'=>$requirementBedrooms,
	  		'requirementState'=>$requirementState,
				));
				?>
	<div id="confirm-button">
	<input type="submit" name="confirm" value="confirm">
	</div>
<?php $this->endWidget(); ?>