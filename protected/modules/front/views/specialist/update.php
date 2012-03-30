<script	type="text/javascript"	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script	type="text/javascript"	src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/prettify.js"></script>
<script	type="text/javascript"	src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.js"></script>
<link	rel="stylesheet" type="text/css"	href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/redmond/jquery-ui.css" />
<link	rel="stylesheet" type="text/css"	href="<?php echo Yii::app()->theme->baseUrl; ?>/includes/jquery.multiselect.css" />
<div id="property_search">
<h1 class="heading">Update Specialist Profile</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'specialist-form',
    'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<div class="property_details_wrap_post">
<fieldset><legend>Company Details</legend>
<ul>
	<li><span><?php echo 'Contact Person Name'; ?><span class="required">*</span></span> <?php echo $form->textField($model,'contact_person_name',array('class'=>'txtbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'contact_person_name'); ?></li>
</ul>
<ul>
	<li><span><?php echo 'Company Name'; ?><span class="required">*</span></span> <?php echo $form->textField($model,'company_name',array('class'=>'txtbox')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'company_name'); ?></li>
</ul>
<ul>
	<li><span><?php echo 'Company Description'; ?><span class="required">*</span></span> <?php echo $form->textArea($model,'company_description',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'company_description'); ?></li>
</ul>
</fieldset>
<fieldset><legend>We Deals in</legend>
<ul>
	<li><span><label for="Property_description" class="required">Specialist <span class="required">*</span></label></span>
		<div class="multi_checkbox avg">
			<?php 
				//$specialists = isset($_POST['specialist_type_id'])? $_POST['specialist_type_id'] : null;
				echo CHtml::checkBoxList('specialist_type_id',$specialists,CHtml::listData(Specializations::model()->findAll(),'id','specialist')) 
			?>
		</div>
	</li>
	<li class="error_message"><?php echo $form->error($specialistType,'specialist_type_id'); ?></li>
</ul>
<?php if($locationCityIds)
	{
		$i=0;
		$data='City';
		foreach ($locationCityIds as $i=>$location){
			if($i>0)
			$data='&nbsp';
		echo '<ul><li><span>'.$data.'</span>';
		$cityid=$location->city_id;;
		$cityList = CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state');	
		echo CHtml::dropdownList('city_id[]',$cityid,$cityList,array('empty'=>'Select'));
		echo '</li>';
		}
		echo '<li>';
		echo CHtml::ajaxLink('Add More',array('Agent/addMoreCity'),array(
		'replace'=>'#city_content_more'));
		echo '</li></ul><div id="city_content_more"></div>';
	}else
	{?>
	<ul>
<li>
	<span>City</span> 
			
			<?php
			$cityid='';
				$cityList = CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state');	
				// echo $form->dropdownList($locationCity,'city_id',$cityList,array('empty'=>'Select'));
				 echo CHtml::dropdownList('city_id[]',$cityid,$cityList,array('empty'=>'Select'));
				 echo '</li>';
	
			?>
			
		
		
	<li>&nbsp<?php 
	echo CHtml::ajaxLink('Add More',array('Agent/addMoreCity'),array(
		'replace'=>'#city_content_more'));
?></li>
	<li class="error_message"><?php echo $form->error($modelCity,'city_id'); ?></li>
</ul>
<?php }?>
<div id="city_content_more"></div>
</fieldset>

<fieldset><legend>Location Details</legend>
<ul>
	<li><span>Country<span class="required">*</span></span>
		<?php echo $form->dropdownList($model,'country_id',CHtml::listData(GeoCountry::model()->findAll(),'id','country'),array('empty'=>'All','class'=>'slctbox',
	                        'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('/location/state/getList/page/specialist'),  
                         	        'update'=>'#state_content',
									'data'=>'js:jQuery(this).serialize()',
	            ))
	            );	           
        ?>       
	</li>
	<li class="error_message"><?php echo $form->error($model,'country_id'); ?></li>
</ul>
<div id="state_content">
<ul>
	<li>
			<span>State<span class="required">*</span></span>
			<?php echo $form->dropdownList($model,'state_id',CHtml::listData(GeoState::model()->findAll('country_id=:country_id',array(':country_id'=>$model->country_id)),'id','state'),array('empty'=>'All','class'=>'slctbox',
		                        'ajax' => array(
		                                'type'=>'POST',
		                                'url'=>CController::createUrl('/location/city/getList/page/specialist'),  
		                                'update'=>'#city_content',
										'data'=>'js:jQuery(this).serialize()',
		            ))
		            );		            
	        ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'state_id'); ?></li>
</ul>
<div id="city_content">
<ul>
	<li><span>City<span class="required">*</span></span>
		<?php echo $form->dropdownList($model,'city_id',CHtml::listData(GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$model->state_id)),'id','city'),array('empty'=>'All','class'=>'slctbox'));
	            $city = isset($_POST['GeoCity']['city_id'])? $_POST['GeoCity']['city_id'] : '';
        ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'city_id'); ?></li>
</ul>
</div>
</div>
<ul>
	<li><span><?php echo 'Address Line 1'; ?><span class="required">*</span></span> <?php echo $form->textArea($model,'address_line1',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'address_line1'); ?></li>
</ul>
<ul>
	<li><span><?php echo 'Address Line 2'; ?></span> <?php echo $form->textArea($model,'address_line2',array('class'=>'txtarea')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'address_line2'); ?></li>
</ul>
</fieldset>

<fieldset><legend>Contact Details</legend>
<ul>
	<li><span><?php echo 'Mobile'; ?><span class="required">*</span></span> <?php echo $form->textField($model,'mobile',array('class'=>'txtbox med')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'mobile'); ?></li>
</ul>
<ul>
	<li><span><?php echo 'Telephone'; ?></span> <?php echo $form->textField($model,'telephone',array('class'=>'txtbox med')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'telephone'); ?></li>
</ul>
<ul>
	<li><span><?php echo 'Email'; ?></span> <?php echo $form->textField($model,'email',array('class'=>'txtbox med')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'email'); ?></li>
</ul>
<ul>
	<li><span><?php echo 'Website'; ?></span>
		<?php echo $form->textField($model,'website',array('class'=>'txtbox med')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'website'); ?></li>
</ul>
</fieldset>
<fieldset><legend>Image</legend>
<ul>
	<li><span><?php 'Image'; ?></span> <?php echo $form->fileField($model,'image'); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'image'); ?></li>
</ul>
</fieldset>

<div align="center"><input type="submit" name="submit" value=""
	class="btn-submit" border="0" /></div>
</div>
	<?php $this->endWidget(); ?></div>
