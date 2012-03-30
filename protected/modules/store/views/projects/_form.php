<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projects-form',
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
		<?php echo $form->labelEx($model,'project_name'); ?>
		<?php echo $form->textField($model,'project_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'project_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_type_id'); ?>
		<?php echo $form->dropDownList($model,'project_type_id',CHtml::listData(ProjectTypes::model()->findAll(),'id', 'project_type' ),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'project_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ownership_type_id'); ?>
		<?php echo $form->dropDownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id', 'ownership_type' ),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'ownership_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'locality_id'); ?>
		<?php echo $form->dropDownList($model,'locality_id',CHtml::listData(GeoLocality::model()->findAll(),'id', 'locality' ),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'locality_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'features'); ?>
		<?php echo $form->textArea($model,'features',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'features'); ?>
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
		<?php echo $form->labelEx($model,'price_starting_from'); ?>
		<?php echo $form->textField($model,'price_starting_from'); ?>
		<?php echo $form->error($model,'price_starting_from'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'views'); ?>
		<?php echo $form->textField($model,'views'); ?>
		<?php echo $form->error($model,'views'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recently_viewed'); ?>
		<?php echo $form->textField($model,'recently_viewed'); ?>
		<?php echo $form->error($model,'recently_viewed'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->