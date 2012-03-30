<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-form',
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
		<?php echo $form->labelEx($model,'i_want_to'); ?>
		<?php echo $form->textField($model,'i_want_to',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'i_want_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_name'); ?>
		<?php echo $form->textField($model,'property_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'property_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'features'); ?>
		<?php echo $form->textArea($model,'features',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'features'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'featured'); ?>
		<?php echo $form->textField($model,'featured'); ?>
		<?php echo $form->error($model,'featured'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jackpot_investment'); ?>
		<?php echo $form->textField($model,'jackpot_investment'); ?>
		<?php echo $form->error($model,'jackpot_investment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instant_home'); ?>
		<?php echo $form->textField($model,'instant_home'); ?>
		<?php echo $form->error($model,'instant_home'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_type_id'); ?>
		<?php echo $form->dropDownList($model,'property_type_id',CHtml::listData(PropertyTypes::model()->findAll(),'id', 'property_type' ),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'property_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_type_id'); ?>
		<?php echo $form->textField($model,'transaction_type_id'); ?>
		<?php echo $form->error($model,'transaction_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locality_id'); ?>
		<?php echo $form->textField($model,'locality_id'); ?>
		<?php echo $form->error($model,'locality_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bathrooms'); ?>
		<?php echo $form->textField($model,'bathrooms',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bathrooms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bedrooms'); ?>
		<?php echo $form->textField($model,'bedrooms',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'bedrooms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'furnished'); ?>
		<?php echo $form->textField($model,'furnished',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'furnished'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age_of_construction'); ?>
		<?php echo $form->textField($model,'age_of_construction'); ?>
		<?php echo $form->error($model,'age_of_construction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ownership_type_id'); ?>
		<?php echo $form->textField($model,'ownership_type_id'); ?>
		<?php echo $form->error($model,'ownership_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'covered_area'); ?>
		<?php echo $form->textField($model,'covered_area'); ?>
		<?php echo $form->error($model,'covered_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'land_area'); ?>
		<?php echo $form->textField($model,'land_area'); ?>
		<?php echo $form->error($model,'land_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price'); ?>
		<?php echo $form->error($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_unit_price'); ?>
		<?php echo $form->textField($model,'per_unit_price'); ?>
		<?php echo $form->error($model,'per_unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_type'); ?>
		<?php echo $form->textField($model,'area_type',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'area_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'display_price'); ?>
		<?php echo $form->textField($model,'display_price'); ?>
		<?php echo $form->error($model,'display_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_negotiable'); ?>
		<?php echo $form->textField($model,'price_negotiable'); ?>
		<?php echo $form->error($model,'price_negotiable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'available_from'); ?>
		<?php echo $form->textField($model,'available_from'); ?>
		<?php echo $form->error($model,'available_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'available_units'); ?>
		<?php echo $form->textField($model,'available_units',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'available_units'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facing'); ?>
		<?php echo $form->textField($model,'facing',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'facing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'floor_number'); ?>
		<?php echo $form->textField($model,'floor_number',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'floor_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_floors'); ?>
		<?php echo $form->textField($model,'total_floors',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'total_floors'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'landmarks'); ?>
		<?php echo $form->textField($model,'landmarks',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'landmarks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tax_fees'); ?>
		<?php echo $form->textField($model,'tax_fees',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tax_fees'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'terms_and_conditions'); ?>
		<?php echo $form->textArea($model,'terms_and_conditions',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'terms_and_conditions'); ?>
	</div>

		<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->