<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'property_type'); ?>
		<?php echo $form->textField($model,'property_type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'property_type'); ?>
	</div>

		<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->