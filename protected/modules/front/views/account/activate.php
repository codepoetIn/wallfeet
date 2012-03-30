<div id="property_search">
<?php if($result==true):?>
<h1 class="heading">Activation Success</h1>
<div style="background-color: rgb(240, 240, 240); padding: 20px; font-size: 18px; text-align: center; line-height: 30px; margin-top: 50px;">
<p>Your account has been successfully activated.</p>
<p>Please <a class="red-txt" href="<?php echo Yii::app()->createAbsoluteUrl('/account');?>">Login to manage your account</a></p>
</div>
<?php elseif(is_object($result)):?>
<h1 class="heading">Already Activated</h1>
<div style="background-color: rgb(240, 240, 240); padding: 20px; font-size: 18px; text-align: center; line-height: 30px; margin-top: 50px;">
<p>Your account is already active.</p>
</div>
<?php else:?>
<h1 class="heading">Activation Failed</h1>
<div style="background-color: rgb(240, 240, 240); padding: 20px; font-size: 18px; text-align: center; line-height: 30px; margin-top: 50px;">
<p>Sorry your account could not be activated.</p>
</div>
<?php endif;?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
