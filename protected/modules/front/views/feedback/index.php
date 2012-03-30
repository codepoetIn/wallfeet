<style type="text/css">
body
{
border:0px;margin:0px;
padding:0px;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/extra.css">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="feedback" align="center">
  <tr>
  <td><h1>Share your Feedback - Help us to serve you better</h1></td>
  </tr>
 
  <tr>
  	<td id="shareFeedbackForm">
  	<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'property-form',
    'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
  
)); ?> 

			<table width="100%"  border="0" cellpadding="3" cellspacing="0"  >
		      <tr>
		      	<td class="label" width="30%">Topic: </td>

		        <td>
		        <?php 
		        $list=CHtml::listData(FeedbackTopic::model()->findAll(),'id','topic');
		        echo $form->dropDownList($model,'feedback_topic_id',
				$list,array('empty'=>'Select','class'=>'selectbox1','style'=>'float:left'));  
				echo $form->error($model,'feedback_topic_id',array('style'=>'color:red;font-size:12px;float:right')); ?>
		        </td>
		        <td></td>
		      </tr>
		      
		      
		       <tr>
		      	<td class="label" width="30%">
				
		      	
		      	Your
		      		Mobile No.: </td>
		        <td>

		        	<?php echo $form->textField($model,'mobile',array('style'=>'float:left'))?>
					<?php echo $form->error($model,'mobile',array('style'=>'color:red;font-size:12px;float:right'));?>
					
		        </td>
		      </tr>
		      
		      <tr>
		      	<td class="label" width="30%">
		      	
		      	
		      	Your
		      	 Email ID: </td>

		        <td>
		        	<?php echo $form->textField($model,'email_id',array('style'=>'float:left'))?>
					<?php echo $form->error($model,'email_id',array('style'=>'color:red;font-size:12px;float:right'));?>
					
		        </td>
		      </tr>
		      <tr>
		      	<td class="label" width="30%">Feedback Description: </td>

		        <td>
		        
				
		        	<?php echo $form->textArea($model,'description',array('rows'=>'6','cols'=>'30','style'=>'float:left'))?>
					<?php echo $form->error($model,'description',array('style'=>'color:red;font-size:12px;float:right'));?>
					
				
		        </td>

		      </tr>
		      <tr>
		      	<td class="label" width="30%">Attach a Screen Shot or File:</td>
		      	<td>
			       <?php echo $form->fileField($model,'image')?><br/>
			       <span style="color: #656565;font: 11px arial;">[Add JPEG, GIF, PNG, BMP, PDF, DOC, TXT, RTF, PPT or HTML Only with maximum size of 1MB]</span>
					<?php echo $form->error($model,'image',array('style'=>'color:red;font-size:12px;float:right')); ?>
		      </td>

		      </tr>
		      <tr>
		      	<td width="30%" class="label">&nbsp;</td>
		        <td style="font-size: 12px;font-weight: bold;">Will you recommend <span class="red">Wallfeet.com</span> to colleagues/friends?: </td>
		      </tr>
		      <tr>
		      	<td width="30%" class="label">&nbsp;</td>
		      	<td>
			      <select style="font-size:12px;" name="Feedback[recommendation]" id="recommendation" class="selectbox1">
							<option value="-1">-- Please Select --</option>
							<option value="Definitely">Definitely</option><option value="May be">May be</option><option value="Never">Never</option>
						</select>
						<span id="recommendationError" class="err_msg"></span>
					
		      </td>
		      </tr>
		      <tr>
		      	<td width="30%" class="label">How satisfied are you?: </td>
		        <td>
		        	<select style="font-size:12px;" name="Feedback[satisfaction]" id="satisfactionId" class="selectbox1">
						<option value="-1">--Select Satisfaction--</option>
						<option value="Very Satisfied">Very Satisfied</option><option value="Some What Satisfied">Some What Satisfied</option><option value="Neither Satisfied nor Dissatisfied">Neither Satisfied nor Dissatisfied</option><option value="Some What Dissatisfied">Some What Dissatisfied</option><option value="Very Dissatisfied">Very Dissatisfied</option>
					</select>
					<span id="satisfactionIdError" class="err_msg"></span>
					
		        </td>
		      </tr>
		      <tr>
		      	<td class="label" width="30%">&nbsp;</td>
		      	<td>
		      	<input type="submit" value="Post Feedback" class="subBtn" id="pstBtn">
		      	</td>
		      </tr>
		   </table>
		
	
	<?php $this->endWidget(); ?>
    </td>

  </tr>
  
  </table>
