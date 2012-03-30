<script type="text/javascript">
function checkAgreement() {
	if(document.getElementById("UserProfiles_agree").checked){
		document.getElementById("agree-error").innerHTML = "";
		return true;
	}else{
		document.getElementById("agree-error").innerHTML = "You must agree to the terms and conditions.";
		return false;
	}
}
</script>
<div class="login_signup">
    	<div class="login_wrap">
        	<fieldset>
            	<legend>Already a user ? Sign In</legend>
            	<div class="left signin">
            	<?php $form=$this->beginWidget('CActiveForm', array(
						'enableClientValidation'=>true,
						'enableAjaxValidation'=>true,
            			'action'=>'/account',
						'clientOptions'=>array(
						//'validateOnSubmit'=>true,
						),
						'id'=>'login-form',
						'focus'=>array($login,'username'),
					)); ?>
                <div class="half">
                <?php echo $form->label($login,'username')?>
                    	<?php echo $form->textField($login,'username',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox avg',
						)); ?>
						<?php echo $form->error($login,'username'); ?>
				</div>
                <div class="half"><?php echo $form->label($login,'password')?>
                    	<?php echo $form->passwordField($login,'password',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox avg',
						)); ?>
						<?php echo $form->error($login,'password'); ?>
                </div>         
                <input type="submit" class="btn-login login-home" value="">
                 <div class="half login-cbox"><input type="checkbox" name="checkbox" class="left" /><div class="left remember">Remember me</div></div>
                <?php $this->endWidget(); ?>
                </div>
                <div class="right hints">		
            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis. Vestibulum ut vehicula odio.</p>
            	</div>
                </div>             
            </fieldset>
        </div>
        <center>OR</center>
        <div class="signup_wrap">      
        	<fieldset>
           	  <legend>New user ? Register for a free account</legend>
               	<div class="pad-bot10">            	
               	</div>
			 <?php $form=$this->beginWidget('CActiveForm', array(
						
			 			//'enableAjaxValidation'=>true,
						'clientOptions'=>array(
					//	'validateOnSubmit'=>true,
            			'action'=>'/account',
						),
						'id'=>'register-form',
						//'htmlOptions'=>array('onSubmit'=>'return checkAgreement()'),
					)); ?>
					<?php echo $form->errorSummary(array($credentialsModel,$profilesModel)); ?>
					<div class="property_details_wrap_post">
					<fieldset>
					<legend>Basic Details</legend>
					<div class="left field_set">
			<ul>
			<li><span><?php echo $form->label($credentialsModel,'email_id'); ?></span></li>
			<li><?php echo $form->textField($credentialsModel,'email_id',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?></li>
			<li class="error_message"><?php echo $form->error($credentialsModel,'email_id'); ?></li>
			</ul>
			<ul>
			<li><span><?php echo $form->label($credentialsModel,'password'); ?></span></li>
			<li><?php echo $form->passwordField($credentialsModel,'password',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?></li>
			<li class="error_message"><?php echo $form->error($credentialsModel,'password'); ?></li>
			</ul>
			<ul>
			<li><span><?php echo $form->label($credentialsModel,'password_confirm'); ?></span></li>
			<li><?php echo $form->passwordField($credentialsModel,'password_confirm',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?></li>
			<li class="error_message"><?php echo $form->error($credentialsModel,'password_confirm'); ?></li>
			</ul>
			<ul>
				<li>
					<span><?php echo $form->label($profilesModel,'first_name')?></span> 
					<?php echo $form->textField($profilesModel,'first_name',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?>
				</li>
				<li class="error_message"><?php echo $form->error($profilesModel,'first_name'); ?></li>
			</ul>
			<ul>
				<li>
					<span><?php echo $form->label($profilesModel,'last_name')?></span>  
					 	<?php echo $form->textField($profilesModel,'last_name',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?>
						
				</li>
				<li class="error_message"><?php echo $form->error($profilesModel,'last_name'); ?></li>
			</ul>
			<ul>
				<li>
					<span><?php echo $form->label($profilesModel,'gender')?></span> 
					<?php echo $form->dropDownList($profilesModel,'gender',array(''=>'Gender','male'=>'Male','female'=>'Female'),array('class'=>'slctbox')); ?>	</li>
				<li class="error_message"><?php echo $form->error($profilesModel,'gender'); ?></li>
			</ul>
		</div>
		<div class="right hints">		
            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis. Vestibulum ut vehicula odio.<br></br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis.</p>
            	</div>		
			</fieldset>
			<fieldset>
			 <legend>Location</legend>
			 <div class="left  field_set">
			 <ul>
			 <li><span><?php echo $form->label($profilesModel,'address_line1'); ?></span></li>
			 <li><?php echo $form->textArea($profilesModel,'address_line1',array('size'=>10,'row'=>'2','maxlength'=>255,
						'class'=>'txtarea',
						)); ?></li>
			 <li class="error_message"><?php echo $form->error($profilesModel,'address_line1'); ?></li>
			 </ul>
			  <ul>
			 <li><span><?php echo $form->label($profilesModel,'address_line2'); ?></span></li>
			 <li><?php echo $form->textArea($profilesModel,'address_line2',array('size'=>30,'maxlength'=>255,
						'class'=>'txtarea',
						)); ?></li>
			 <li class="error_message"><?php echo $form->error($profilesModel,'address_line2'); ?></li>
			 </ul>
			 <ul>
			 <li><span><?php echo $form->label($profilesModel,'country_id'); ?></span></li>
			 <li> <?php echo $form->dropdownList($profilesModel,'country_id',CHtml::listData(GeoCountry::model()->findAll(),'id','country'),array('empty'=>'All','class'=>'slctbox',
	                        'ajax' => array(
                                'type'=>'POST',
                                'url'=>CController::createUrl('/location/state/getList/page/register'),  
                                'update'=>'#state_content',
								'data'=>'js:jQuery(this).serialize()',
			))
			);
			?>
			</li>
			<li class="error_message"><?php echo $form->error($profilesModel,'country_id'); ?></li>
			 </ul>
			<div id="state_content" class="pad10"><ul>
			<li><span><?php echo $form->label($profilesModel,'state_id'); ?></span></li>
			 <li>
			<?php echo $form->dropdownList($profilesModel,'state_id',CHtml::listData(GeoState::model()->findAll('country_id=:country_id',array(':country_id'=>$profilesModel->country_id)),'id','state'),array('empty'=>'All',
	                   		    'ajax' => array(
                                'type'=>'POST',
                                'url'=>CController::createUrl('/location/city/getList/page/register'),  
                                'update'=>'#city_content',
								'data'=>'js:jQuery(this).serialize()',
			))
			);
			?></li>
			<li class="error_message"><?php echo $form->error($profilesModel,'state_id'); ?></li>
			</ul>
			<div id="city_content" class="pad10">
			<ul>
			<li><span><?php echo $form->label($profilesModel,'city_id'); ?></span></li>
			<li>
			<?php echo $form->dropdownList($profilesModel,'city_id',CHtml::listData(GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$profilesModel->state_id)),'id','city'),array('empty'=>'All')); ?>
			</li>
			<li class="error_message"><?php echo $form->error($profilesModel,'city_id'); ?></li>
			</ul>
			</div>
			</div>
            	
	
			 <ul>
			 <li><span><?php echo $form->label($profilesModel,'zip'); ?></span></li>
			 <li> <?php echo $form->textField($profilesModel,'zip',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?></li>
			<li class="error_message"><?php echo $form->error($profilesModel,'zip'); ?></li>
						</ul>
		</div>
				<div class="right hints">		
            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis. Vestibulum ut vehicula odio.</p>
            	</div>
			</fieldset>
			<fieldset>
			<legend>Contact Details</legend>
			<div class="left field_set">
			<ul>
			<li><span><?php echo $form->label($profilesModel,'mobile'); ?></span></li>
			<li><?php echo $form->textField($profilesModel,'mobile',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?></li>
			<li class="error_message"><?php echo $form->error($profilesModel,'mobile'); ?></li>
			</ul>
			<ul>
			<li><span><?php echo $form->label($profilesModel,'telephone'); ?></span></li>
			<li><?php echo $form->textField($profilesModel,'telephone',array('size'=>30,'maxlength'=>255,
						'class'=>'txtbox med',
						)); ?></li>
			<li class="error_message"><?php echo $form->error($profilesModel,'telephone'); ?></li>
			</ul>
			</div>
			<div class="right hints">		
            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis. Vestibulum ut vehicula odio.</p>
            	</div>
			</fieldset>
			</div>
			<fieldset>
            		<legend class="hint">Terms &amp; Conditions</legend>
            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis. Vestibulum ut vehicula odio. Pellentesque sollicitudin erat sed nisl commodo malesuada.<br></br> Proin eget eros a odio accumsan faucibus. Aliquam varius molestie dui, ac malesuada ipsum accumsan sagittis. Cras mollis porta bibendum. Donec tincidunt mi ac nisi ultrices at cursus orci blandit. Proin eget eros a odio accumsan faucibus. Aliquam varius molestie dui, ac malesuada ipsum accumsan sagittis. Cras mollis porta bibendum. Donec tincidunt mi ac nisi ultrices at cursus orci blandit.</p>
			 	<ul>
			 	<li class="agree-text">
			 	<?php // echo $form->checkbox($profilesModel,'agree'); ?>
			 	<input type="checkbox" id="UserProfiles_agree" name="UserProfiles[agree]" value="1">
			 	I agree to the <a href="#">Terms &amp; Conditions</a></li>
			 	<li class="agree_error">
			 	<?php echo $form->error($profilesModel,'agree'); ?>
			 	<div id="agree-error"></div></li>
			 	</br>
			 	<li><?php echo CHtml::submitButton('',array('style'=>'margin-top: 0pt','class'=>'btn-signup'))?>
			 	</ul>
              <?php $this->endWidget(); ?>
              </fieldset>
            </fieldset>
        </div>
    </div>