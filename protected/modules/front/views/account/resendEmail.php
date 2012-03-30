<div id="property_search">
<h1 class="heading">Resend Email</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
//	'enableClientValidation'=>true,
// 	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
//	'validateOnSubmit'=>true,
            'action'=>'/account/resendEmail',
),
	'id'=>'register-form',
//'htmlOptions'=>array('onSubmit'=>'return checkAgreement()'),
)); ?>
<div
	style="background-color: #F0F0F0; padding: 15px 20px; font-size: 14px; text-align: center; line-height: 22px; margin-top: 30px;">
<p style="font-size: 14px; padding-bottom: 20px;">If you have just registered please wait for a few minutes to receive the activation email.
<br/> In case you haven't received any mails, you can use this form to resend an activation email.
<br/> <b>Do not forget to add <?php echo Yii::app()->params['adminEmail'];?> to your whitelist.</b>
</p>
<table width="50%" cellspacing="0" cellpadding="0" border="0"
	align="center">
	<tbody>
		<tr>
			<td style="line-height: 28px;">
			<p>Email Address</p>
			</td>
			<td>
			<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align="left"><?php echo $form->error($model,'email');?></td>
		</tr>
		<tr>
			<td></td>
			<td align="left">
			<input type="submit" class="btn-submit-s1" value=""></td>
		</tr>
	</tbody>
</table>
</div>
<?php $form=$this->endWidget('CActiveForm');?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
