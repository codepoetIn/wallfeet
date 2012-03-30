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
		<?php echo $form->dropDownList($model,'user_id',UserApi::getUserList(),array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_name'); ?>
		<?php echo $form->textArea($model,'project_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_type_id'); ?>
		<?php echo $form->dropDownList($model,'project_type_id',CHtml::listData(ProjectTypes::model()->findAll(),'id', 'project_type' ),array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ownership_type_id'); ?>
		<?php echo $form->dropDownList($model,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id', 'ownership_type' ),array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'locality_id'); ?>
		<?php echo $form->dropDownList($model,'locality_id',CHtml::listData(GeoLocality::model()->findAll(),'id', 'locality' ),array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'features'); ?>
		<?php echo $form->textArea($model,'features',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'covered_area'); ?>
		<?php echo $form->textField($model,'covered_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'land_area'); ?>
		<?php echo $form->textField($model,'land_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_price'); ?>
		<?php echo $form->textField($model,'total_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_starting_from'); ?>
		<?php echo $form->textField($model,'price_starting_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'per_unit_price'); ?>
		<?php echo $form->textField($model,'per_unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_type'); ?>
		<?php echo $form->textField($model,'area_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'display_price'); ?>
		<?php echo $form->textField($model,'display_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_negotiable'); ?>
		<?php echo $form->textField($model,'price_negotiable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'landmarks'); ?>
		<?php echo $form->textArea($model,'landmarks',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax_fees'); ?>
		<?php echo $form->textArea($model,'tax_fees',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'terms_and_conditions'); ?>
		<?php echo $form->textArea($model,'terms_and_conditions',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'views'); ?>
		<?php echo $form->textField($model,'views'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recently_viewed'); ?>
		<?php echo $form->textField($model,'recently_viewed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->