<div id="property_search">
<h1 class="heading">Emi Calculator</h1>
<?php echo CHtml::beginForm(); ?>
<script type="text/javascript">

function getElements()
{
	document.getElementById("amterror").style.display="none";
	document.getElementById("interesterror").style.display="none";
	document.getElementById("montherror").style.display="none";
	var amt=document.getElementById("amt").value;
	var interest=document.getElementById("interest").value;
	var years=document.getElementById("years").value;
	
	if(amt==''||amt==0)
	{
	document.getElementById("amterror").style.display="";	
	document.getElementById("amt").focus();
	return false;
	}
	if(years=='')
	{
	document.getElementById("yearserror").style.display="";
	document.getElementById("years").focus();
	return false;	
	}
	if(interest==0)
	{
	document.getElementById("interesterror").style.display="";
	document.getElementById("interest").focus();
	return false;	
	}
	
	
}
</script>

<div class="emical-part">
  <div class="emical">
    <h3 align="center">Emi Calculator</h3>
    <ul class="margin">
      <li><span><?php echo CHtml::label('Loan Amount','amount');?></span>
      <?php echo CHtml::textField('amt',$emiData['amount'],array('class'=>'selectbox1','id'=>'amt'));
      ?><div class="errorMessage" id="amterror" style="display:none">Enter the Amount</div>
      </li>
      <li><span><?php echo CHtml::label('Loan Period (Years)','years')?></span>
      <?php 
      echo CHtml::textField('years',$emiData['year'],array('class'=>'selectbox1','id'=>'years'));?>
      <div class="errorMessage" id="yearserror" style="display:none">Enter the years</div>
      </li>
     
      <li><span><?php echo CHtml::label('Interest Rate ','');?></span>
      <?php 
      echo CHtml::textField('interest',$emiData['interest'],array('class'=>'selectbox1','id'=>'interest')).' %'; ?>
      <div class="errorMessage" id="interesterror" style="display:none">Enter the Interest</div>
      </li>
     
      <li><span><?php echo CHtml::label('Reducing Balance Type','type')?></span>
      <?php 
      echo CHtml::dropDownList('type',$emiData['type'],array('months'=>'Monthly','years'=>'Annaul'),array('class'=>'selectbox1','id'=>'month'));?>
      <div class="errorMessage" id="montherror" style="display:none">Enter the Month</div>
      </li>
      <li><span style="color:red;display:none" id="error">Enter Correct Value</span></li>
      <li><span>&nbsp;</span>
        <input type="submit" value="Calculate" onclick="return getElements();" class="btn-cal" name="emi"/>&nbsp;
          <input type="button" value="Reset" onclick="javascript:Clear();" class="btn-cal" name="emi"/>
      </li>
    </ul>
  </div>
  <div class="emical">
    <h3 align="center">Result</h3>
    <ul>
      <li><span><?php echo CHtml::label('Emi','amount')?></span>
      <?php echo CHtml::textField('amount',$emi,array('class'=>'selectbox1','disabled'=>'disabled'))?>
       
      </li>
    </ul>
  </div>
<?php echo CHtml::endForm();?>
<br>
</div>
	<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
	
  
)); ?> 
<div class="emical-part">
  <div class="emical">
    <h3 align="center">Apply for a Loan</h3>
    <ul class="margin">
      <li><span><?php echo $form->label($loan,'name');?></span>
      <?php echo  $form->textField($loan,'name',array('class'=>'selectbox1'));
      echo $form->error($loan,'name');?>
      </li>
      <li><span><?php echo $form->label($loan,'city')?></span>
      <?php 
      echo $form->dropDownList($loan,'city',CHtml::listData(GeoCity::model()->findAll(),'id','city','state.state'),array('empty'=>'Select','class'=>'selectbox1'));
      echo $form->error($loan,'city');?>
      
      </li>
       <li><span><?php echo $form->label($loan,'mobile')?></span>
      <?php 
      echo $form->textField($loan,'mobile',array('class'=>'selectbox1'));
      echo $form->error($loan,'mobile');?>
      
      </li>
      <li><span><?php echo $form->label($loan,'lamount')?></span>
      <?php
      echo $form->textField($loan,'lamount',array('class'=>'selectbox1'));
      echo $form->error($loan,'lamount');?>
    
      </li>
     
       <li><span><?php echo $form->label($loan,'email')?></span>
      <?php 
      echo $form->textField($loan,'email',array('class'=>'selectbox1'));
      echo $form->error($loan,'email');?>
      
      </li>
       <li><span><?php echo $form->label($loan,'dob')?></span>
      <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
	array(
		// you must specify name or model/attribute
		'model'=>$loan,
		'attribute'=>'dob',
	//	'name'=>'Project[projectDateStart]',

		// optional: what's the initial value/date?
		//'value' => $model->projectDateStart
		//'value' => '08/20/2010',

	

		/* optional: change visual
		 * themeUrl: "where the themes for this widget are located?"
		 * theme: theme name. Note that there must be a folder under themeUrl with the theme name
		 * cssFile: specifies the css file name under the theme folder. You may specify a
		 *          single filename or an array of filenames
		 * try http://jqueryui.com/themeroller/
		*/
		'themeUrl' =>Yii::app()->theme->baseUrl.'/css' ,
		'theme'=>'redmond',	//try 'bee' also to see the changes
		'cssFile'=>array('jquery-ui-1.8.17.custom.css' /*,anotherfile.css, etc.css*/),


		//  optional: jquery Datepicker options
		'options' => array(
			// how to change the input format? see http://docs.jquery.com/UI/Datepicker/formatDate
			'dateFormat'=>'yy/mm/dd',

			// user will be able to change month and year
			'changeMonth' => 'true',
			'changeYear' => 'true',

			// shows the button panel under the calendar (buttons like "today" and "done")
			//'showButtonPanel' => 'true',

			// this is useful to allow only valid chars in the input field, according to dateFormat
			'constrainInput' => 'false',

			// speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
			'duration'=>'fast',

			// animation effect, see http://docs.jquery.com/UI/Effects
			'showAnim' =>'drop',
		),


		// optional: html options will affect the input element, not the datepicker widget itself
		'htmlOptions'=>array(
		'class'=>'selectbox1'
		
		)
	)
);
    
      echo $form->error($loan,'dob');?>
      
      </li>
       <li><span><?php echo $form->label($loan,'occupation');?></span>
      <?php $occupation=array('Salaried-Public Ltd.Co.'=>'Salaried-Public Ltd.Co.','Salaried-MNC'=>'Salaried-MNC','Salaried-Govt'=>'Salaried-Govt','Salaried-Pvt Ltd.Co.'=>'Salaried-Pvt Ltd.Co.','Salaried-Doctor'=>'Salaried-Doctor','Self employed-Doctor'=>'Self employed-Doctor','Self employed-CA/MBA'=>'Self employed-CA/MBA','Self employed-Engg/Arch'=>'Self employed-Engg/Arch','Self employed-Others'=>'Self employed-Others');
      echo $form->dropDownList($loan,'occupation',$occupation,array('empty'=>'Occupation','class'=>'selectbox1'));
      echo $form->error($loan,'occupation');?>
      
      </li>
      
      <li><span><?php echo $form->label($loan,'income');?></span>
      <?php $income=array('<50'=>'<50','50-1L'=>'50-1L');
      echo $form->dropDownList($loan,'income',$income,array('empty'=>'Monthly Income','class'=>'selectbox1'));
      echo $form->error($loan,'income');?>      
      </li>
      
       <li><span><?php echo $form->label($loan,'property_identified');?></span>
      <?php echo $form->radioButtonList($loan,'property_identified',array('1'=>'Yes','0'=>'No'),array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
      echo $form->error($loan,'property_identified');?>      
      </li>
      <li><span style="color:red;display:none" id="error">Enter Correct Value</span></li>
      <li><span>&nbsp;</span>
        <input type="submit" value="Submit" class="btn-cal" name="loan"/>
      </li>
    </ul>
  </div>
  
<?php $this->endWidget(); ?>
<br>
</div>
</div>
<script type="text/javascript">
function Clear()
{
	 document.getElementById("amt").value='';
	document.getElementById("interest").value='';
	document.getElementById("years").value='';
	document.getElementById("amount").value='';
	
}
</script>