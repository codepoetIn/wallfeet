<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id',UserApi::getUserList(),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_want_to'); ?>
		<?php echo $form->textField($model,'i_want_to',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_name'); ?>
		<?php echo $form->textField($model,'property_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'features'); ?>
		<?php echo $form->textArea($model,'features',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'featured'); ?>
		<?php echo $form->textField($model,'featured'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jackpot_investment'); ?>
		<?php echo $form->textField($model,'jackpot_investment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'instant_home'); ?>
		<?php echo $form->textField($model,'instant_home'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_type_id'); ?>
		<?php echo $form->dropDownList($model,'property_type_id',CHtml::listData(PropertyTypes::model()->findAll(),'id', 'property_type' ),array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_type_id'); ?>
		<?php echo $form->textField($model,'transaction_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'locality_id'); ?>
		<?php echo $form->textField($model,'locality_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bathrooms'); ?>
		<?php echo $form->textField($model,'bathrooms',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedrooms'); ?>
		<?php echo $form->textField($model,'bedrooms',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'furnished'); ?>
		<?php echo $form->textField($model,'furnished',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age_of_construction'); ?>
		<?php echo $form->textField($model,'age_of_construction'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ownership_type_id'); ?>
		<?php echo $form->textField($model,'ownership_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'covered_area'); ?>
		<?php echo $form->textField($model,'covered_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'land_area'); ?>
		<?php echo $form->textField($model,'land_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'per_unit_price'); ?>
		<?php echo $form->textField($model,'per_unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_type'); ?>
		<?php echo $form->textField($model,'area_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'display_price'); ?>
		<?php echo $form->textField($model,'display_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_negotiable'); ?>
		<?php echo $form->textField($model,'price_negotiable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'available_from'); ?>
		<?php echo $form->textField($model,'available_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'available_units'); ?>
		<?php echo $form->textField($model,'available_units',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facing'); ?>
		<?php echo $form->textField($model,'facing',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'floor_number'); ?>
		<?php echo $form->textField($model,'floor_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_floors'); ?>
		<?php echo $form->textField($model,'total_floors',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'landmarks'); ?>
		<?php echo $form->textField($model,'landmarks',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax_fees'); ?>
		<?php echo $form->textField($model,'tax_fees',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'terms_and_conditions'); ?>
		<?php echo $form->textArea($model,'terms_and_conditions',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'views'); ?>
		<?php echo $form->textField($model,'views'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recently_viewed'); ?>
		<?php echo $form->textField($model,'recently_viewed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_time'); ?>
		<?php echo $form->textField($model,'updated_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_time'); ?>
		<?php echo $form->textField($model,'created_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->