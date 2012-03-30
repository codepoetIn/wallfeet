<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'feedback_topic_id'); ?>
		<?php echo $form->textField($model,'feedback_topic_id'); ?>
		<?php echo $form->error($model,'feedback_topic_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email_id'); ?>
		<?php echo $form->textArea($model,'email_id',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'email_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile'); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textArea($model,'image',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommendation'); ?>
		<?php echo $form->textArea($model,'recommendation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'recommendation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'satisfaction'); ?>
		<?php echo $form->textArea($model,'satisfaction',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'satisfaction'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->