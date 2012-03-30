<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-amenities-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'amenity'); ?>
		<?php echo $form->textField($model,'amenity',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'amenity'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->