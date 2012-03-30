<div class="signup-home">
<div class="signup-board"><h1 class="center sign-up-text">Sign Up! Its Free!</h1></div><br class="clear">
<?php $form=$this->beginWidget('CActiveForm', array(
		'enableAjaxValidation'=>false,
    	 'action'=>$this->registerUrl,		 
)); ?> 

		Your email address here
		<?php echo $form->textField($credentialsModel,'email_id',array('size'=>30,'maxlength'=>255,
		'class'=>'txt-box-signup',
		'id'=>'Email',
		)); ?>
		
		Your password here
		<?php echo $form->passwordField($credentialsModel,'password',array('size'=>30,'maxlength'=>255,
		'class'=>'txt-box-signup',
		'id'=>'Password',
		)); ?>
	
<div align="center">
<input type="submit" value="" class="btn-signup" /></div>
<?php $this->endWidget(); ?></div>
