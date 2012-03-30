<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'specializations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'specialist'); ?>
		<?php echo $form->textField($model,'specialist',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'specialist'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->