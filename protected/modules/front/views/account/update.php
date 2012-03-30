<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ui.core.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ui.sortable.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
            (
            function($){

                $.fn.shuffle = function() {
                    return this.each(function(){
                        var items = $(this).children();

                        return (items.length)
                            ? $(this).html($.shuffle(items,$(this)))
                        : this;
                    });
                }

                $.fn.validate = function() {
                    var res = false;
                    this.each(function(){
                        var arr = $(this).children();
                        res =    ((arr[0].innerHTML=="W")&&
                            (arr[1].innerHTML=="A")&&
                            (arr[2].innerHTML=="L")&&
                            (arr[3].innerHTML=="L")&&
                            (arr[4].innerHTML=="F")&&
                            (arr[5].innerHTML=="E")&&
                            (arr[6].innerHTML=="E")&&
                            (arr[7].innerHTML=="T")
                            );
                    });
                    return res;
                }

                $.shuffle = function(arr,obj) {
                    for(
                    var j, x, i = arr.length; i;
                    j = parseInt(Math.random() * i),
                    x = arr[--i], arr[i] = arr[j], arr[j] = x
                );
                    if(arr[0].innerHTML=="1") obj.html($.shuffle(arr,obj))
                    else return arr;
                }

            })(jQuery);

            $(function() {
                $("#sortable").sortable();
                $("#sortable").disableSelection();
                $('#sortable').shuffle();

                $("#register-form").click(function(){
                    if($('#sortable').validate()){
                      $('#captcha-error').html('');
                    	return true;
                    }else {
                    	$('#captcha-error').html('Incorrect Captcha. Please arrange "W A L L F E E T".');
                    	return false;
                    }   
                });
            });
 </script>



<div class="signup_wrap">      
        	<fieldset>
           	  <legend>Update Your Account</legend>
               	<div class="pad-bot10">            	
               	</div>
			 <?php $form=$this->beginWidget('CActiveForm', array(
					//	'enableClientValidation'=>true,
			 			'enableAjaxValidation'=>true,
						'clientOptions'=>array(
						'validateOnSubmit'=>true,
            			'action'=>'/update',
						),
						'id'=>'update-form',
						//'htmlOptions'=>array('onSubmit'=>'return checkAgreement()'),
					)); ?>
					<?php echo $form->errorSummary(array($profilesModel)); ?>
					<div class="property_details_wrap_post">
					<fieldset>
					<legend>Basic Details</legend>
					<div class="left field_set">
			
			
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
			 <li> <?php echo $form->dropdownList($profilesModel,'country_id',CHtml::listData(GeoCountry::model()->findAll(),'id','country'),array('empty'=>'Select','class'=>'slctbox',
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
			<?php echo $form->dropdownList($profilesModel,'state_id',CHtml::listData(GeoState::model()->findAll('country_id=:country_id',array(':country_id'=>$profilesModel->country_id)),'id','state'),array('empty'=>'Select',
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
			<?php echo $form->dropdownList($profilesModel,'city_id',CHtml::listData(GeoCity::model()->findAll('state_id=:state_id',array(':state_id'=>$profilesModel->state_id)),'id','city'),array('empty'=>'Select')); ?>
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
			
			
			<fieldset>
			<legend>Anti Spam Check</legend>
			<div class="left field_set">
						<label>Drag and arrange <b>"WALLFEET"</b></label>
			<div class="captcha_wrap">			
                    <div class="captcha">
                    </div>
                    <ul id="sortable" class="ui-sortable" unselectable="on" style="-moz-user-select: none;">
                    <li class="captchaItem" style="">W</li>
                    <li class="captchaItem" style="">A</li>
                    <li class="captchaItem" style="">L</li>
                    <li class="captchaItem" style="">L</li>
                    <li class="captchaItem" style="background-color:#AD0F0F">F</li>
                    <li class="captchaItem" style="background-color:#AD0F0F">E</li>
                    <li class="captchaItem" style="background-color:#AD0F0F">E</li>
                    <li class="captchaItem" style="background-color:#AD0F0F">T</li>
                    </ul>
            </div>
            <br clear="all" /> <br clear="all" />
            <div id="captcha-error" class="errorMessage"></div>
			</div>
			</fieldset>
			
			<fieldset>
            		<legend class="hint">Terms &amp; Conditions</legend>
            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque gravida mattis. Vestibulum ut vehicula odio. Pellentesque sollicitudin erat sed nisl commodo malesuada.<br></br> Proin eget eros a odio accumsan faucibus. Aliquam varius molestie dui, ac malesuada ipsum accumsan sagittis. Cras mollis porta bibendum. Donec tincidunt mi ac nisi ultrices at cursus orci blandit. Proin eget eros a odio accumsan faucibus. Aliquam varius molestie dui, ac malesuada ipsum accumsan sagittis. Cras mollis porta bibendum. Donec tincidunt mi ac nisi ultrices at cursus orci blandit.</p>
			 	<ul>
			 	<li class="agree-text">
			 	<?php // echo $form->checkbox($profilesModel,'agree'); ?>
			 	<input type="checkbox" id="UserProfiles_agree" name="UserProfiles[agree]" value="1">
			 	I agree to the <a href="#">Terms &amp; Conditions</a></li>
			 	<br clear="all" />
			 	<li class="agree_error">
			 	<?php echo $form->error($profilesModel,'agree'); ?>
			 	
			 	<div id="agree-error"></div></li>
			 	<br clear="all" />
			 	<li><?php echo CHtml::submitButton('',array('style'=>'margin-top: 0pt','class'=>'btn-signup'))?>
			 	</ul>
              <?php $this->endWidget(); ?>
              </fieldset>
           </div>	
			</div>
        </div>