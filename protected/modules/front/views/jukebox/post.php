<div id="property_search">
<h1 class="heading">Post Question</h1>

<?php 
	$model = $modelJukeboxQuestions;
    $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'property-form',
	    'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
?>
<div class="property_details_wrap_post">
<fieldset><legend>Your Question</legend>
<ul>
	<li>
		<span><?php echo $form->labelEx($model,'category_id'); ?></span> 
		<?php echo $form->dropDownList($model,'category_id',CHtml::listData(JukeboxCategoryApi::getAllJukeboxCategory(),'id','category'),array('empty'=>'Select','class'=>'slctbox med')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'category_id'); ?></li>
</ul>

<ul>
	<li>
		<span><?php echo $form->labelEx($model,'question'); ?></span> 
		<?php echo $form->textField($model,'question',array('class'=>'txtbox big')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'question'); ?></li>
</ul>
<ul>
	<li>
		<span><?php echo $form->labelEx($model,'description'); ?></span> 
		<?php echo $form->textArea($model,'description',array('class'=>'txtarea big')); ?>
	</li>
	<li class="error_message"><?php echo $form->error($model,'description'); ?></li>
</ul>
</fieldset>
<div align="center"><input type="submit" name="submit" value="" class="btn-submit" border="0" /></div>
</div>
<?php $this->endWidget(); ?>
</div>
