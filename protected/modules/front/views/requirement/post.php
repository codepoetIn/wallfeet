<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.css" />
<script type="text/javascript">
/*$(function(){
	$("#property-types-multi").multiselect();
	$("#bedrooms-multi").multiselect();
	$("#cities-multi").multiselect();
	$("#amenities-multi").multiselect();
});*/
</script>
<script type="text/javascript">
function fnChangeBedrooms(value){
	if(value>10){
		document.getElementById('bedrooms-input').innerHTML='<input type="text" id="requirement_bedrooms" name="bedrooms" class="txtbox sml">';
	}
}
</script>
<div id="property_search">
<h1 class="heading">Post Requirement</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	//'enableClientValidation'=>true,
	//'enableAjaxValidation'=>true,
    'id'=>'requirement-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<div class="property_details_wrap_post">
<fieldset><legend>Basic Details</legend>
<ul>
	<li>
		<span><?php echo $form->labelEx($model,'i_want_to'); ?></span> 
		<?php echo $form->radioButtonList($model,'i_want_to',array('Buy'=>'Buy','Rent'=>'Rent-In','Lease'=>'Lease'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline'),'OnClick'=>'javascript:budget(this);')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'i_want_to'); ?></li>
</ul>
<ul>
	<li>
		<span><?php echo $form->labelEx($requirementPropertyTypes,'property_type_id'); ?></span> 
		<?php //echo $form->dropDownList($requirementPropertyTypes,'property_type_id',CHtml::listData(PropertyTypes::model()->findAll(),'id','property_type'),array('size'=>'5','multiple'=>'multiple','id'=>'property-types-multi')); ?>
		<div class="multi_checkbox avg">
			<?php 
				$property_type_id = isset($_POST['property_type_id'])? $_POST['property_type_id'] : null;
				echo CHtml::checkBoxList('property_type_id',$property_type_id,CHtml::listData(PropertyTypes::model()->findAll(),'id','property_type'));
			?>
		</div>
	</li>
	<li class="error_message"><?php echo $form->error($requirementPropertyTypes,'property_type_id'); ?></li>
</ul>
</fieldset>

<fieldset><legend>Location</legend>
<?php // var_dump($_POST['city_id']); ?>
<?php if(isset($_POST['city_id']) && !empty($_POST['city_id']) && $_POST['city_id'][0]!='')
	{

		$i=0;
		$data='City <span class="required">*</span>';
		foreach ($_POST['city_id'] as $i=>$location){
			if($i>0)
			$data='&nbsp';
		echo '<ul><li><span>'.$data.'</span>';
		$cityid=$location;
		$cityList = CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state');	
		echo CHtml::dropdownList('city_id[]',$cityid,$cityList,array('empty'=>'Select','class'=>'slctbox med'));
		echo '</li>';
		}
		echo '<li>';
		echo CHtml::ajaxLink('Add More',array('Agent/addMoreCity'),array(
		'replace'=>'#city_content_more'));
		echo '</li></ul><div id="city_content_more"></div>';
	}elseif(isset($cities) && !empty($cities) && $cities!='')
	{

		$i=0;
		$data='City <span class="required">*</span>';
		foreach ($cities as $i=>$location){
			if($i>0)
			$data='&nbsp';
		echo '<ul><li><span>'.$data.'</span>';
		$cityid=$location;
		$cityList = CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state');	
		echo CHtml::dropdownList('city_id[]',$cityid,$cityList,array('empty'=>'Select','class'=>'slctbox med'));
		echo '</li>';
		}
		echo '<li>';
		echo CHtml::ajaxLink('Add More',array('Agent/addMoreCity'),array(
		'replace'=>'#city_content_more'));
		echo '</li></ul><div id="city_content_more"></div>';
	} else { ?>
<ul>
<li>
	<span>City<span class="required">*</span></span> 		
			<?php
			$cityid='';
				$cityList = CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state');	
				// echo $form->dropdownList($locationCity,'city_id',$cityList,array('empty'=>'Select'));
				 echo CHtml::dropdownList('city_id[]',$cityid,$cityList,array('empty'=>'Select','class'=>'slctbox med'))
			?>
			
		
		</li>
	<li>&nbsp<?php 
	echo CHtml::ajaxLink('Add More',array('Agent/addMoreCity'),array(
		'replace'=>'#city_content_more'));
?></li>
</ul>
<div id="city_content_more"></div>
<?php }?>
	<ul><li class="error_message"><?php echo $form->error($requirementCities,'city_id'); ?></li></ul>
</fieldset>
<fieldset><legend>Property Features</legend>
<ul>
	<li class="error_message"><?php echo $form->error($requirementBedrooms,'bedrooms'); ?></li>
</ul>



<ul>
	<li><span><label for="Property_description" class="required">House Amenities</label></span>
		<?php //echo $form->dropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
		<div class="multi_checkbox avg">
			<?php 
				$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
				echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'0')),'id','amenity'));
			?>
		</div>
	</li>
	<li class="error_message"><?php echo $form->error($requirementAmenities,'amenity_id'); ?></li>
</ul>

<ul>
	<li><span><label for="Property_description" class="required">External Amenities </label></span>
		<?php //echo $form->dropdownList($propertyAmenities,'amenity_id[]',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi')) ?>
		<div class="multi_checkbox avg">
			<?php 
				$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
				echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll('amenity_type=:amenityType',array(':amenityType'=>'1')),'id','amenity'));
			?>
		</div>
	</li>
	<li class="error_message"><?php echo $form->error($requirementAmenities,'amenity_id'); ?></li>
</ul>

</fieldset>
<script language="javascript">

function budget(text)
{
	if(text.value=='Rent')
	{
		document.getElementById("rent").style.display="block";
		document.getElementById("buy_lease").style.display="none";
	}
	else if((text.value=='Buy')||(text.value=='Lease'))
	{
		document.getElementById("rent").style.display="none";
		document.getElementById("buy_lease").style.display="block";
	}
	
}

</script>
<fieldset><legend>About Area &amp; Price</legend>
<ul>
	<li><span><label for="Property_description" class="required">Covered Area </label></span>
		<?php echo $form->textField($model,'covered_area_from',array('class'=>'txtbox sml')); ?>To
		<?php echo $form->textField($model,'covered_area_to',array('class'=>'txtbox sml')); ?>
		<?php echo $form->dropDownList($model,'covered_area_units',PropertyApi::getUnits('plot'),array('class'=>'slctbox sml')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'covered_area_from'); ?></li>
</ul>
<ul>
	<li>
		<span>
		<label for="Requirement[min_price]" class="required">Budget</label>
		</span>
		<span id="buy_lease" style="width:200px; padding:0px;">
		<select name="Requirement[min_price]" id="min_price" class="slctbox sml" onchange="javascript:validateMin('min_price','max_price');">
				<option value="0">Min</option>
			<option class="" value="1">Below 5 Lacs</option>
			<option class="" value="500000">5 Lacs</option>
			<option class="" value="1000000">10 Lacs</option>
			<option class="" value="1500000">15 Lacs</option>
			<option class="" value="2000000">20 Lacs</option>
			<option class="" value="2500000">25 Lacs</option>
			<option class="" value="3000000">30 Lacs</option>
			<option class="" value="4000000">40 Lacs</option>
			<option class="" value="5000000">50 Lacs</option>
			<option class="" value="6000000">60 Lacs</option>
			<option class="" value="7500000">75 Lacs</option>
			<option class="" value="9000000">90 Lacs</option>
			<option class="" value="10000000">1 Crore</option>
			<option class="" value="15000000">1.5 Crores</option>
			<option class="" value="20000000">2 Crores</option>
			<option class="" value="30000000">3 Crores</option>
			<option class="" value="50000000">5 Crores</option>
			<option class="" value="100000000">10 Crores</option>
			<option class="" value="200000000">20 Crores</option>
			<option class="" value="300000000">30 Crores</option>
			<option class="" value="400000000">40 Crores</option>
			<option class="" value="500000000">50 Crores</option>
			<option class="" value="600000000">60 Crores</option>
			<option class="" value="700000000">70 Crores</option>
			<option class="" value="800000000">80 Crores</option>
			<option class="" value="900000000">90 Crores</option>
			<option class="" value="1000000000">100 Crores</option>
			<option class="" value="1000000001">100+ Crores</option>
			</select> To 
			<select name="Requirement[max_price]" id="max_price" class="slctbox sml" onchange="javascript:validateMinMax('min_price','max_price');">
				<option value="0">Max</option>
				<option class="" value="1000000">10 Lacs</option>
				<option class="" value="1500000">15 Lacs</option>
				<option class="" value="2000000">20 Lacs</option>
				<option class="" value="2500000">25 Lacs</option>
				<option class="" value="3000000">30 Lacs</option>
				<option class="" value="4000000">40 Lacs</option>
				<option class="" value="5000000">50 Lacs</option>
				<option class="" value="6000000">60 Lacs</option>
				<option class="" value="7500000">75 Lacs</option>
				<option class="" value="9000000">90 Lacs</option>
				<option class="" value="10000000">1 Crore</option>
				<option class="" value="15000000">1.5 Crores</option>
				<option class="" value="20000000">2 Crores</option>
				<option class="" value="30000000">3 Crores</option>
				<option class="" value="50000000">5 Crores</option>
				<option class="" value="100000000">10 Crores</option>
				<option class="" value="200000000">20 Crores</option>
				<option class="" value="300000000">30 Crores</option>
				<option class="" value="400000000">40 Crores</option>
				<option class="" value="500000000">50 Crores</option>
				<option class="" value="600000000">60 Crores</option>
				<option class="" value="700000000">70 Crores</option>
				<option class="" value="800000000">80 Crores</option>
				<option class="" value="900000000">90 Crores</option>
				<option class="" value="1000000000">100 Crores</option>
				<option class="" value="1000000001">100+ Crores</option>
			</select>
			</span>
		
		<span id="rent" style="display:none; width:200px; padding:0px;">
		<select name="Requirement[min_price]" id="min_price_rent" class="slctbox sml" onchange="javascript:validateMin('min_price_rent','max_price_rent');">
				<option value="0">Min</option>
			<option value="1" class="">Below 5000</option>
			<option value="5000" class="">5000</option>
			<option value="10000" class="">10000</option>
			<option value="15000" class="">15000</option>
			<option value="20000" class="">20000</option>
			<option value="25000" class="">25000</option>
			<option value="30000" class="">30000</option>
			<option value="40000" class="">40000</option>
			<option value="50000" class="">50000</option>
			<option value="60000" class="">60000</option>
			<option value="75000" class="">75000</option>
			<option value="90000" class="">90000</option>
			<option value="100000" class="">1 Lacs</option>
			<option value="150000" class="">1.5 Lacs</option>
			<option value="200000" class="">2 Lacs</option>
			<option value="300000" class="">3 Lacs</option>
			<option value="500000" class="">5 Lacs</option>
			<option value="1000000" class="">10 Lacs</option>
			<option value="2000000" class="">20 Lacs</option>
			<option value="3000000" class="">30 Lacs</option>
			<option value="4000000" class="">40 Lacs</option>
			<option value="5000000" class="">50 Lacs</option>
			<option value="6000000" class="">60 Lacs</option>
			<option value="7000000" class="">70 Lacs</option>
			<option value="8000000" class="">80 Lacs</option>
			<option value="9000000" class="">90 Lacs</option>
			<option value="10000000" class="">100 Lacs</option>
			<option value="10000000" class="">100+ Lacs</option>			
			</select> To 
			<select name="Requirement[max_price]" id="max_price_rent" class="slctbox sml" onchange="javascript:validateMinMax('min_price_rent','max_price_rent');">
				<option value="0">Max</option>
			<option value="10000" class="">10000</option>
			<option value="15000" class="">15000</option>
			<option value="20000" class="">20000</option>
			<option value="25000" class="">25000</option>
			<option value="30000" class="">30000</option>
			<option value="40000" class="">40000</option>
			<option value="50000" class="">50000</option>
			<option value="60000" class="">60000</option>
			<option value="75000" class="">75000</option>
			<option value="90000" class="">90000</option>
			<option value="100000" class="">1 Lacs</option>
			<option value="150000" class="">1.5 Lacs</option>
			<option value="200000" class="">2 Lacs</option>
			<option value="300000" class="">3 Lacs</option>
			<option value="500000" class="">5 Lacs</option>
			<option value="1000000" class="">10 Lacs</option>
			<option value="2000000" class="">20 Lacs</option>
			<option value="3000000" class="">30 Lacs</option>
			<option value="4000000" class="">40 Lacs</option>
			<option value="5000000" class="">50 Lacs</option>
			<option value="6000000" class="">60 Lacs</option>
			<option value="7000000" class="">70 Lacs</option>
			<option value="8000000" class="">80 Lacs</option>
			<option value="9000000" class="">90 Lacs</option>
			<option value="10000000" class="">100 Lacs</option>
			<option value="10000000" class="">100+ Lacs</option>
			
			</select>
			</span>
	</li>
	<li class="error_message"><?php echo $form->error($model,'min_price'); ?>
	<li class="error_message"><?php echo $form->error($model,'max_price'); ?>
	</li>
</ul>
</fieldset>

<fieldset><legend>Additional Details</legend>
<ul>
	<li><span><?php echo $form->labelEx($model,'requirement_urgency'); ?></span>
		<?php echo $form->dropDownList($model,'requirement_urgency',array('immediately'=>'immediately','till find the right one'=>'till find the right one','within 3 months'=>'within 3 months','within 6 months'=>'within 6 months'),array('empty'=>'Select','class'=>'slctbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'requirement_urgency'); ?></li>
</ul>

<ul>
	<li><span><?php echo $form->labelEx($model,'description'); ?></span>
		<?php echo $form->textArea($model,'description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'description'); ?></li>
</ul>

</fieldset>
<div align="center"><input type="submit" name="submit" value="" class="btn-submit" border="0" /></div>
</div>
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
	/*fnMultiSelect('property-types-multi',"<?php echo $propertyTypes; ?>");
	fnMultiSelect('bedrooms-multi',"<?php echo $bedrooms; ?>");
	fnMultiSelect('cities-multi',"<?php echo $cities; ?>");
	fnMultiSelect('amenities-multi',"<?php echo $amenities; ?>");*/
</script>
