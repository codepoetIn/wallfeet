<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-templates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_email'); ?>
		<?php echo $form->textField($model,'from_email',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'from_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'from_name'); ?>
		<?php echo $form->textField($model,'from_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'from_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body_html'); ?>
		<?php $this->widget('ext.ckeditor.CKEditorWidget',array(
			"model"=>$model,                 # Data-Model
			"defaultValue"=>$model->body_html,
			"attribute"=>'body_html',          # Attribute in the Data-Model
			"config" => array(
				"height"=>"300px",
				"width"=>"100%",
				"pasteFromWordRemoveFontStyles"=>"false",
				"scayt_autoStartup"=>"true"
		    ),
		  ) );?>
		<?php echo $form->error($model,'body_html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body_plain'); ?>
		<?php echo $form->textArea($model,'body_plain',array('rows'=>12, 'cols'=>100)); ?>
		<?php echo $form->error($model,'body_plain'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->