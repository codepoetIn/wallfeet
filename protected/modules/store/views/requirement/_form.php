<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requirement-form',
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
		<?php echo $form->labelEx($model,'i_want_to'); ?>
		<?php echo $form->dropDownList($model,'i_want_to',array('Buy'=>'Sell','Rent'=>'Rent','Lease'=>'Lease')); ?>
		<?php echo $form->error($model,'i_want_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'covered_area_from'); ?>
		<?php echo $form->textField($model,'covered_area_from'); ?>
		<?php echo $form->error($model,'covered_area_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'covered_area_to'); ?>
		<?php echo $form->textField($model,'covered_area_to'); ?>
		<?php echo $form->error($model,'covered_area_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plot_area_from'); ?>
		<?php echo $form->textField($model,'plot_area_from'); ?>
		<?php echo $form->error($model,'plot_area_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plot_area_to'); ?>
		<?php echo $form->textField($model,'plot_area_to'); ?>
		<?php echo $form->error($model,'plot_area_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'min_price'); ?>
		<?php echo $form->textField($model,'min_price'); ?>
		<?php echo $form->error($model,'min_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_price'); ?>
		<?php echo $form->textField($model,'max_price'); ?>
		<?php echo $form->error($model,'max_price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->