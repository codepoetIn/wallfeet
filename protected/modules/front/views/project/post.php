<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.css" />
<script type="text/javascript">
$(function(){
	$("#amenities-multi").multiselect();
});
</script>
<div id="property_search">
<h1 class="heading">Post Project</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'property-form',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<?php //echo $form->errorSummary($model); ?>
<div class="property_details_wrap_post">
<fieldset><legend>Basic Details</legend>
<ul>
	<li>
		<span><?php echo $form->labelEx($model,'project_name'); ?></span> 
		<?php echo $form->textField($model,'project_name',array('class'=>'txtbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'project_name'); ?></li>
</ul>
<ul>
	<li>
		<span><?php echo $form->labelEx($model,'project_type_id'); ?></span> 
		<?php echo $form->dropDownList($model,'project_type_id',CHtml::listData(ProjectTypesApi::getAll(),'id','project_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'project_type_id'); ?></li>
</ul>
</fieldset>

<fieldset><legend>Location</legend>

<ul>
	<li><span><?php echo $form->labelEx($model,'state_id'); ?></span> 
	<?php echo $form->dropdownList($model,'state_id',CHtml::listData(GeoState::model()->findAll(),'id','state'),array('empty'=>'All','class'=>'slctbox',
		                        'ajax' => array(
		                                'type'=>'POST',
		                                'url'=>CController::createUrl('/location/city/getList/page/project'),  
		                                'update'=>'#city_content',
										'data'=>'js:jQuery(this).serialize()',
	))
	);
	?></li>
	<li class="error_message"><?php echo $form->error($model,'state_id'); ?></li>
</ul>



<div id="city_content">
<ul>
	<li><span><?php echo $form->labelEx($model,'city_id'); ?></span>
		<?php
		 
		echo $form->dropdownList($model,'city_id',CHtml::listData(GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$model->state_id)),'id','city'),array('empty'=>'All','class'=>'slctbox',
	                        'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('/location/locality/getList/page/project'),  
	                                'update'=>'#locality_content',
									'data'=>'js:jQuery(this).serialize()',
	            ))
	            );
	           
        ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'city_id'); ?></li>
</ul>

<div id="locality_content">




<ul>
	<li><span><?php echo $form->labelEx($model,'locality_id'); ?></span> 
				<?php 
				echo $form->dropdownList($model,'locality_id',CHtml::listData(GeoLocality::model()->findAll('city_id=:city_id',array(':city_id'=>$model->city_id)),'id','locality'),array('empty'=>'All','id'=>'geo_locality','class'=>'slctbox'));
				$locality = isset($_POST['GeoLocality']['locality_id'])? $_POST['GeoLocality']['locality_id'] : '';
				?>
			
	</li>
	<li class="error_message"><?php echo $form->error($model,'locality_id'); ?></li>
</ul>
</div>

</div>
<ul>
	<li><span><?php echo $form->labelEx($model,'address'); ?></span>
		<?php echo $form->textArea($model,'address',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'address'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Project Features</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'ownership_type_id'); ?></span>
		<?php echo $form->dropDownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'ownership_type_id'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'features'); ?></span> 
		<?php echo $form->textArea($model,'features',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'features'); ?></li>
</ul>
<ul>
	<li><span><label for="Property_description" class="required">House Amenities <span class="required">*</span></label></span>
		<?php //echo $form->dropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
		<div class="multi_checkbox avg">
			<?php 
				$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
				echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
			?>
		</div>
	</li>
	<li class="error_message"><?php echo $form->error($modelAmenities,'amenity_id'); ?></li>
</ul>

<ul>
	<li><span><label for="Property_description" class="required">External Amenities <span class="required">*</span></label></span>
		<?php //echo $form->dropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
		<div class="multi_checkbox avg">
			<?php 
				$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
				echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
			?>
		</div>
	</li>
	<li class="error_message"><?php echo $form->error($modelAmenities,'amenity_id'); ?></li>
</ul>







</fieldset>

<fieldset><legend>About Area &amp; Price</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'covered_area'); ?></span>
		<?php echo $form->textField($model,'covered_area',array('class'=>'txtbox med')); ?>Sq-ft
	</li>
	<li class="error_message"><?php echo $form->error($model,'covered_area'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'land_area'); ?></span>
		<?php echo $form->textField($model,'land_area',array('class'=>'txtbox med')); ?>Sq-ft
	</li>
	<li class="error_message"><?php echo $form->error($model,'land_area'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'total_price'); ?></span>
		<?php echo $form->textField($model,'total_price',array('class'=>'txtbox med')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'total_price'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'price_starting_from'); ?></span>
		<?php echo $form->textField($model,'price_starting_from',array('class'=>'txtbox sml')); ?>Sq-ft
	</li>
	<li class="error_message"><?php echo $form->error($model,'price_starting_from'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'per_unit_price'); ?></span>
		<?php echo $form->textField($model,'per_unit_price',array('class'=>'txtbox sml')); ?>Sq-ft
	</li>
	<li class="error_message"><?php echo $form->error($model,'per_unit_price'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'area_type'); ?></span>
		<?php echo $form->dropDownList($model,'area_type',array('Covered Area'=>'Covered Area','Plot Area'=>'Plot Area'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'area_type'); ?></li>
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
</fieldset>

<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'description'); ?></span>
		<?php echo $form->textArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Project Snapshot</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'landmarks'); ?></span>
		<?php echo $form->textArea($model,'landmarks',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'landmarks'); ?></li>
</ul>
<ul>
	<li><span>Annual Tax</span>
		<?php echo $form->textArea($model,'tax_fees',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'tax_fees'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($model,'terms_and_conditions'); ?></span>
		<?php echo $form->textArea($model,'terms_and_conditions',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'terms_and_conditions'); ?></li>
</ul>
<ul>
	<li><span><?php echo $form->labelEx($modelImages,'image'); ?></span>
		<?php echo $form->fileField($modelImages,'image'); ?>
	</li>
	<li class="error_message"><?php echo $form->error($modelImages,'image'); ?></li>
</ul>
</fieldset>
<div align="center"><input type="submit" name="submit" value="" class="btn-submit" border="0" /></div>
</div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
	fnMultiSelect('amenities-multi',"<?php echo $amenities; ?>");
</script>
