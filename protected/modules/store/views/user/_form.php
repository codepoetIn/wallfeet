<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-credentials-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email_id'); ?>
		<?php echo $form->textField($model,'email_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textArea($model,'password',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'salt'); ?>
		<?php echo $form->textField($model,'salt',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'salt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activation_code'); ?>
		<?php echo $form->textArea($model,'activation_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'activation_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>21,'maxlength'=>21)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verified_by'); ?>
		<?php echo $form->textField($model,'verified_by',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'verified_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warnings'); ?>
		<?php echo $form->textField($model,'warnings'); ?>
		<?php echo $form->error($model,'warnings'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'registered_ip'); ?>
		<?php echo $form->textArea($model,'registered_ip',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'registered_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_login_ip'); ?>
		<?php echo $form->textArea($model,'last_login_ip',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'last_login_ip'); ?>
	</div>

<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'updated_time'); ?>
		<?php echo $form->textField($model,'updated_time'); ?>
		<?php echo $form->error($model,'updated_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by'); ?>
		<?php echo $form->error($model,'updated_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_time'); ?>
		<?php echo $form->textField($model,'created_time'); ?>
		<?php echo $form->error($model,'created_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>
*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'last_login_time'); ?>
		<?php echo $form->textField($model,'last_login_time'); ?>
		<?php echo $form->error($model,'last_login_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->