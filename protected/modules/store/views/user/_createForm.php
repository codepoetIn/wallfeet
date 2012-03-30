<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-credentials-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<hr/>
	
	<h4>Account Information</h4>

	<?php echo $form->errorSummary(array($credentialsModel,$profilesModel)); ?>

	<div class="row">
		<?php echo $form->labelEx($credentialsModel,'email_id'); ?>
		<?php echo $form->textField($credentialsModel,'email_id',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($credentialsModel,'email_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($credentialsModel,'password'); ?>
		<?php echo $form->passwordField($credentialsModel,'password',array('size'=>'30')); ?>
		<?php echo $form->error($credentialsModel,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($credentialsModel,'password_confirm'); ?>
		<?php echo $form->passwordField($credentialsModel,'password_confirm',array('size'=>'30')); ?>
		<?php echo $form->error($credentialsModel,'password_confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($credentialsModel,'status'); ?>
		<?php echo $form->dropDownList($credentialsModel,'status', UserApi::getAllStatus(), array('empty'=>'Select a status')); ?>
		<?php echo $form->error($credentialsModel,'status'); ?>
	</div>

	<hr/>
	
	<h4>Profile Information</h4>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'first_name'); ?>
        <?php echo $form->textField($profilesModel,'first_name',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($profilesModel,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'last_name'); ?>
        <?php echo $form->textField($profilesModel,'last_name',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($profilesModel,'last_name'); ?>
    </div>

   
   
    <div class="row">
        <?php echo $form->labelEx($profilesModel,'gender'); ?>
        <?php echo $form->dropDownList($profilesModel,'gender', UserApi::getAllgender(), array('empty'=>'Select a gender')); ?>
        <?php echo $form->error($profilesModel,'gender'); ?>
    </div>

    
    <div class="row">
        <?php echo $form->labelEx($profilesModel,'address_line1'); ?>
        <?php echo $form->textArea($profilesModel,'address_line1',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($profilesModel,'address_line1'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'address_line2'); ?>
        <?php echo $form->textArea($profilesModel,'address_line2',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($profilesModel,'address_line2'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'city'); ?>
        <?php echo $form->dropDownList($profilesModel,'city',CHtml::listData(GeoCity::model()->findAll(),'id', 'city' ),array('empty'=>'Select')); ?>
        
        <?php echo $form->error($profilesModel,'city'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'state'); ?>
 <?php echo $form->dropDownList($profilesModel,'city',CHtml::listData(GeoState::model()->findAll(),'id', 'state' ),array('empty'=>'Select')); ?>
        <?php echo $form->error($profilesModel,'state'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'zip'); ?>
        <?php echo $form->textField($profilesModel,'zip'); ?>
        <?php echo $form->error($profilesModel,'zip'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'country'); ?>
         <?php echo $form->dropDownList($profilesModel,'country',CHtml::listData(GeoCountry::model()->findAll(),'id', 'country' ),array('empty'=>'Select')); ?>
        <?php echo $form->error($profilesModel,'country'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'mobile'); ?>
        <?php echo $form->textField($profilesModel,'mobile',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($profilesModel,'mobile'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($profilesModel,'telephone'); ?>
        <?php echo $form->textField($profilesModel,'telephone',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($profilesModel,'telephone'); ?>
    </div>

    
    
    <div class="row buttons">
		<?php echo CHtml::submitButton('Create'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->