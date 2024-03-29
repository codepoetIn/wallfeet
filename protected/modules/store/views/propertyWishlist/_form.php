<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-wishlist-form',
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
		<?php echo $form->labelEx($model,'property_id'); ?>
		<?php echo $form->dropDownList($model,'property_id',CHtml::listData(Property::model()->findAll(),'id','property_name'),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'property_id'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->