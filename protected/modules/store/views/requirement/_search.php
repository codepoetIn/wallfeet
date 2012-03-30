<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'i_want_to'); ?>
		<?php echo $form->textField($model,'i_want_to',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'covered_area_from'); ?>
		<?php echo $form->textField($model,'covered_area_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'covered_area_to'); ?>
		<?php echo $form->textField($model,'covered_area_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plot_area_from'); ?>
		<?php echo $form->textField($model,'plot_area_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plot_area_to'); ?>
		<?php echo $form->textField($model,'plot_area_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'min_price'); ?>
		<?php echo $form->textField($model,'min_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_price'); ?>
		<?php echo $form->textField($model,'max_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_time'); ?>
		<?php echo $form->textField($model,'updated_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_by'); ?>
		<?php echo $form->textField($model,'updated_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_time'); ?>
		<?php echo $form->textField($model,'created_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->