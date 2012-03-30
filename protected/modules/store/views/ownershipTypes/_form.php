<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-ownership-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ownership_type'); ?>
		<?php echo $form->textField($model,'ownership_type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ownership_type'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->