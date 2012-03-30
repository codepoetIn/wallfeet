<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jukebox-answers-form',
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
		<?php echo $form->labelEx($model,'jukebox_question_id'); ?>
		<?php echo $form->dropDownList($model,'jukebox_question_id',CHtml::listData(JukeboxQuestions::model()->findAll(),'id', 'question' ),array('empty'=>'Select')); ?>
		<?php echo $form->error($model,'jukebox_question_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'answer'); ?>
		<?php echo $form->textArea($model,'answer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'answer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reference_url'); ?>
		<?php echo $form->textArea($model,'reference_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'reference_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->