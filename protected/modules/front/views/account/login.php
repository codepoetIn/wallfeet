<div class="login-cols1 left">
<h1>Signin to My Wallfeet</h1>
<div class="login-cols1-wrap">
<?php $form=$this->beginWidget('CActiveForm', array(
						'enableClientValidation'=>true,
						'enableAjaxValidation'=>true,
            			'action'=>'/login',
						'clientOptions'=>array(
						//'validateOnSubmit'=>true,
						),
						'id'=>'login-form',
						'focus'=>array($login,'username'),
					)); ?>
<div class="row"><?php echo $form->label($login,'username',array('class'=>'left'))?> 
<?php echo $form->textField($login,'username',array('size'=>30,'maxlength'=>255,'class'=>'txtbox_login left',)); ?>
<?php echo $form->error($login,'username'); ?>
</div>
<br class="clear">
<div class="row">
<?php echo $form->label($login,'password',array('class'=>'left'))?>
<?php echo $form->passwordField($login,'password',array('size'=>30,'maxlength'=>255,'class'=>'txtbox_login left',)); ?>
<?php echo $form->error($login,'password'); ?>
</div>
<br class="clear">
<div class="row right">
<?php echo $form->checkbox($login,'rememberMe');?>&nbsp;
<?php echo $form->label($login,'rememberMe')?>
</div>
<br class="clear" /> 
<input type="submit" style="margin-left: 85px;" class="btn-login" value="">
<br class="clear" /><br />
<a style="margin:0px; float:right" href="<?php echo Yii::app()->createUrl('/account/forgotPassword');?>">Forgot your password ?</a><br class="clear" />
<a style="margin:0px; float:right" href="<?php echo Yii::app()->createUrl('/account/resendEmail');?>">Haven't received verification mail yet ?</a>
<?php $this->endWidget(); ?>
</div>
</div>


<div class="login-cols2 right"><a class="btn-signup" href="<?php echo Yii::app()->createUrl('/register');?>"></a>
</div>
