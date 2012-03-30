<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-specialist-profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id',UserApi::getUserList(),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_person_name'); ?>
		<?php echo $form->textField($model,'contact_person_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'contact_person_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_description'); ?>
		<?php echo $form->textArea($model,'company_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line1'); ?>
		<?php echo $form->textField($model,'address_line1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line2'); ?>
		<?php echo $form->textField($model,'address_line2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_id')?>
		<?php echo $form->dropdownList($model,'country_id',CHtml::listData(GeoCountry::model()->findAll(),'id','country'),array('empty'=>'All','class'=>'slctbox',
	                        'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('/location/state/getList/page/specialist'),  
                                	'update'=>'#state_content',
									'data'=>'js:jQuery(this).serialize()',
								))
								);?>	
		<?php echo $form->error($model,'country_id'); ?>			
	</div>
	
	<div id="state_content">  
	<div class="row">
		<?php echo $form->labelEx($model,'state_id')?>
		<?php echo $form->dropdownList($model,'state_id',CHtml::listData(GeoState::model()->findAll('country_id=:country_id',array(':country_id'=>$model->country_id)),'id','state'),array('empty'=>'All','class'=>'slctbox',
		                        'ajax' => array(
		                                'type'=>'POST',
		                                'url'=>CController::createUrl('/location/city/getList/page/specialist'),  
		                                'update'=>'#city_content',
										'data'=>'js:jQuery(this).serialize()',
								))
								);?>
	
		<?php echo $form->error($model,'state_id'); ?>			
	</div>	
	
	<div id="city_content"> 
	<div class="row">
		<?php echo $form->labelEx($model,'city_id')?>
		<?php echo $form->dropdownList($model,'city_id',CHtml::listData(GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$model->state_id)),'id','city'),array('empty'=>'All','class'=>'slctbox'));
			$city = isset($_POST['GeoCity']['city_id'])? $_POST['GeoCity']['city_id'] : '';?>		
		<?php echo $form->error($model,'city_id'); ?>
	</div>	
	</div>
	</div> 

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->