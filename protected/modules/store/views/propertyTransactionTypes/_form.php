<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-transaction-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_type'); ?>
		<?php echo $form->textField($model,'transaction_type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'transaction_type'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->