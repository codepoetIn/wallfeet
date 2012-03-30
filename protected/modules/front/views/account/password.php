<div id="property_search">
<h1 class="heading">Modify your password </h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'property-form',
   // 'enableAjaxValidation'=>true,
	'htmlOptions'=>array('action'=>'/account/password'),
)); ?>
<div class="property_details_wrap_post">
<fieldset>
<legend>New Password</legend>
<ul>
	<li style="width:125px">
	<?php echo $form->label($model,'currentPassword');?>&nbsp;
	</li>
	<li>
	<?php echo $form->passwordField($model,'currentPassword',array('size'=>30,'maxlength'=>255,
				'class'=>'txtbox med',
				)); ?>
	</li>
	<li class="error_message">
	<?php echo $form->error($model,'currentPassword');?>
	</li>
</ul>
<ul>
	<li style="width:125px">
	<?php echo $form->label($model,'newPassword');?>&nbsp;
	</li>
	<li>
	<?php echo $form->passwordField($model,'newPassword',array('size'=>30,'maxlength'=>255,
				'class'=>'txtbox med',
				)); ?>
	</li>
	<li class="error_message">
	<?php echo $form->error($model,'newPassword');?>
	</li>
</ul>
<ul>
	<li style="width:125px">
	<?php echo $form->label($model,'confirmPassword');?>&nbsp;
	</li>
	<li>
	<?php echo $form->passwordField($model,'confirmPassword',array('size'=>30,'maxlength'=>255,
				'class'=>'txtbox med',
				)); ?>
	</li>
	<li class="error_message">
	<?php echo $form->error($model,'confirmPassword');?>
	</li>
</ul>

</fieldset>


<div align="center"><input type="submit" border="0" class="btn-submit" value="" name="submit"></div>
</div>
<?php $form=$this->endWidget('CActiveForm'); ?>
</div>