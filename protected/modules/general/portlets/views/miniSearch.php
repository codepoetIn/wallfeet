<?php 
if(isset($_POST['cityid']))
{
$properties->property_type_id=$_POST['Property']['property_type_id'];
$modelCity->city=$_POST['GeoCity']['city'];
}

?><script type="text/javascript">
function fnbuycityid(){
	var var1=document.getElementById('Property_city_id_buy').value;
	if(var1==""){
		alert("Select the City");
		document.getElementById('Property_city_id_buy').focus();
		return false;
	}	
}
</script><script type="text/javascript">
function fnrentcityid(){
	var var1=document.getElementById('geo_city_rent').value;
	if(var1==""){
		alert("Select the City");
		document.getElementById('geo_city_rent').focus();
		return false;
	}	
}
</script>

<?php $stateList = CHtml::listData(GeoState::model()->findAll(),'id','state');
$cityList = CHtml::listData(GeoCity::model()->with('state')->findAll(),'id','city','state.state');
$propertyType=CHtml::listData(PropertyTypes::model()->findAll(),'id','property_type');

?>

<div class="home-search-cntr">
<div class="tabs3">
<ul class="tabNavigation3 left">
	<li class="search-tab-top"><a href="#searchtab1" class="selected">Buy</a></li>
	<li class="search-tab-mid"><a href="#searchtab2">Rent In / Lease</a></li>
	<li class="search-tab-mid"><a href="#searchtab3">Sell / Rent Out</a></li>
	<li class="search-tab-bot"><a href="#searchtab4">WF Specialist</a></li>
</ul>
<div id="searchtab1" class="right" style="display: block; ">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'buy',
		'enableAjaxValidation'=>false,
    	 'action'=>$this->buyurl,
		'htmlOptions'=>array('name'=>'thisProperty'),
    	 
		)); ?>
		<input type="hidden" name="mode" value="Property">
		<input type="hidden" name="minbuysearch" value="MinBuySearch">
		<input type="hidden" name="Property[i_want_to]" value="Sell">
		<input type="hidden" name="without_budget" value="1" checked="checked">
		<input type="hidden" name="minisearch">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	
	<tr>		
		<td width="210px" align="right"><label>Property type</label> 
			<?php echo $form->dropDownList($properties,'property_type_id',CHtml::listData(PropertyTypes::model()->findAll(),'id','property_type'),array('class'=>'selectbox1','empty'=>'All','id'=>'buy_property')); ?></select></td>
		
		<td width="200px" align="right">
<label>City&nbsp</label><?php echo $form->dropdownList($modelCity,'city',CHtml::listData(GeoCity::model()->with('state')->findAll(),'id','city','state.state'),array('class'=>'selectbox1','id'=>'Property_city_id_buy' ,
			'empty'=>'Select',
			'OnChange'=>'javascript:changelocality(this.value);'
));

?>

	</tr>
	<tr>
		<td width="210px" align="right">
<label>Budget</label> 
		 <select name="budget_min" class="selectbox2" id="buy_budget_min" valtype="budget_min" onchange="javascript:validateMin('buy_budget_min','buy_budget_max');">
			<option value="">Min</option>
		
				<option value="1" class="">Below 5 Lacs</option>
				<option value="500000" class="">5 Lacs</option>
				<option value="1000000" class="">10 Lacs</option>
				<option value="1500000" class="">15 Lacs</option>
				<option value="2000000" class="">20 Lacs</option>
				<option value="2500000" class="">25 Lacs</option>
				<option value="3000000" class="">30 Lacs</option>
				<option value="4000000" class="">40 Lacs</option>
				<option value="5000000" class="">50 Lacs</option>
				<option value="6000000" class="">60 Lacs</option>
				<option value="7500000" class="">75 Lacs</option>
				<option value="9000000" class="">90 Lacs</option>
				<option value="10000000" class="">1 Crore</option>
				<option value="15000000" class="">1.5 Crores</option>
				<option value="20000000" class="">2 Crores</option>
				<option value="30000000" class="">3 Crores</option>
				<option value="50000000" class="">5 Crores</option>
				<option value="100000000" class="">10 Crores</option>
				<option value="200000000" class="">20 Crores</option>
				<option value="300000000" class="">30 Crores</option>
				<option value="400000000" class="">40 Crores</option>
				<option value="500000000" class="">50 Crores</option>
				<option value="600000000" class="">60 Crores</option>
				<option value="700000000" class="">70 Crores</option>
				<option value="800000000" class="">80 Crores</option>
				<option value="900000000" class="">90 Crores</option>
				<option value="1000000000" class="">100 Crores</option>
				<option value="1000000001" class="">100+ Crores</option>
		</select> 
<span style="padding: 0 1px;">to </span> 
		<select name="budget_max" class="selectbox2" id="buy_budget_max" tabindex="2" nameinerr="Max Budget" valtype="budget_max" onchange="javascript:validateMinMax('buy_budget_min','buy_budget_max');">
			<option value="">Max</option>
			<option value="500000" class="">5 Lacs</option>
				<option value="1000000" class="">10 Lacs</option>
				<option value="1500000" class="">15 Lacs</option>
				<option value="2000000" class="">20 Lacs</option>
				<option value="2500000" class="">25 Lacs</option>
				<option value="3000000" class="">30 Lacs</option>
				<option value="4000000" class="">40 Lacs</option>
				<option value="5000000" class="">50 Lacs</option>
				<option value="6000000" class="">60 Lacs</option>
				<option value="7500000" class="">75 Lacs</option>
				<option value="9000000" class="">90 Lacs</option>
				<option value="10000000" class="">1 Crore</option>
				<option value="15000000" class="">1.5 Crores</option>
				<option value="20000000" class="">2 Crores</option>
				<option value="30000000" class="">3 Crores</option>
				<option value="50000000" class="">5 Crores</option>
				<option value="100000000" class="">10 Crores</option>
				<option value="200000000" class="">20 Crores</option>
				<option value="300000000" class="">30 Crores</option>
				<option value="400000000" class="">40 Crores</option>
				<option value="500000000" class="">50 Crores</option>
				<option value="600000000" class="">60 Crores</option>
				<option value="700000000" class="">70 Crores</option>
				<option value="800000000" class="">80 Crores</option>
				<option value="900000000" class="">90 Crores</option>
				<option value="1000000000" class="">100 Crores</option>
				<option value="1000000001" class="">100+ Crores</option>
		</select>
		 </td>
		 <td width="200px" align="right"><label>Locality</label>
		 <span id="localitychange" style="margin:0px;padding:0px">
		 <?php
		 $locality_auto='';
		if(isset($_POST['cityid'])){$locality_auto=GeoLocalityApi::getAllNameListByCity($_POST['cityid']);
		if($locality_auto!='')
		$locality_auto=array_values($locality_auto);
		}
		
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
 			'name'=>'GeoLocality[locality]',
			 'source' => $locality_auto,
			 'htmlOptions'=>array('class'=>'mytxtbox')
	));
	?>
	</span>
		 </td>
		 </tr>
		 
		 <tr>
		 	<td width="210px" align="right"><label>Keywords</label> 
		 	<input type="text" id="buy_keyword" name="keyword" class="mytxtbox" onFocus="javascript:ClearText(this);" onBlur="javascript:ClearText(this);" value="Eg: Builder"></td>
		 
		<td width="200px" align="right"></td>
	</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	
	<tr>
		<td width="260px" align="center">
		<span align="left">Posted by :</span> 
		<span padding-left="5px"> 		
		<label for="p_a"> <input type="checkbox" id="p_a" name="posted_by[]" value="agent" checked="true"> Agent</label> 
		<label for="p_b"> <input type="checkbox" id="p_b" name="posted_by[]" value="builder" checked="true"> Builder</label>		 
		 <label for="p_o"> <input type="checkbox" id="p_o" name="posted_by[]" value="individuals" checked="true">Individual</label></span>
		</td>
		<td align="right"> 
<input type="submit" value="" name="search" onclick="return fnbuycityid()" class="btn-submit-s right"> 
<a  class="advanced_search" style="margin-left: 54px;" onclick="javascript:Advanced('advanced_buy');">Advanced Search</a><br class="clear">
		</td>
	</tr>
</table><?php $this->endWidget(); ?></div>
<form name="locality_auto" method="post">
<input type="hidden" name="cityid" id="cityid_auto">
<input type="hidden" name="Property[property_type_id]" id="auto_property_type">
<input type="hidden" name="GeoCity[city]" id="auto_cityid">
<input type="hidden" name="budget_min" id="auto_budget_min">
<input type="hidden" name="budget_max" id="auto_budget_max">
<input type="hidden" name="keyword" id="auto_keyword">
</form>
<form name="advanced_buy" action="<?php echo $this->buyurl?>" method="post">
		<input type="hidden" name="mode" value="property">
		<input type="hidden" name="Property[i_want_to]" value="Sell">
		<input type="hidden" name="without_budget" value="1" checked="checked">
</form>
<div id="searchtab2" class="right" style="display: none; ">

<script language="javascript">

function budget(text)
{
	if(text.value=='Rent')
	{
		document.getElementById("budget_change_rent").style.display="block";
		document.getElementById("budget_change_lease").style.display="none";
	}
	else if(text.value=='Lease')
	{
		document.getElementById("budget_change_rent").style.display="none";
		document.getElementById("budget_change_lease").style.display="block";
	}
	
}

</script>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'Rent',
		'enableAjaxValidation'=>false,
    	 'action'=>$this->renturl,  
		 
		)); ?>
		<input type="hidden" name="mode" value="property">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>		
		<td width="210px" align="center"><?php echo $form->radioButtonList($properties,'i_want_to',array('Rent'=>'Rent In','Lease'=>'Lease'),array('separator'=>' ','labelOptions'=>array('style'=>'display:inline'),'OnClick'=>'javascript:budget(this);')); ?></td>
		<td width="200px" align="right">
<label>City </label><?php echo $form->dropdownList($modelCity,'city',
	$cityList,
	array('empty'=>'Select','id'=>'geo_city_rent','class'=>'selectbox1'));?> </td>
	</tr>
	<tr>
		<td width="210px" align="right">
		 <label>Property type</label> 
			<?php echo $form->dropDownList($properties,'property_type_id',$propertyType,array('class'=>'selectbox1','empty'=>'All')); ?>
		
		 </td>
		 <td width="200px" align="right"><label>Locality</label>
		 <?php
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
 			'name'=>'Property[locality]',
			
			 'source' => array_values(GeoLocalityApi::getAllNameList()),
			 'htmlOptions'=>array('class'=>'mytxtbox')
	));
	?>
		 </td>
		 </tr>
		 
		 <tr>
		 	<td width="210px" align="right"><label>Keywords</label> <input id="keyword_search" type="text" name="keyword" class="mytxtbox" onFocus="javascript:ClearText(this);" onBlur="javascript:ClearText(this);" value="Eg: Builder"></td>
		 
		<td width="200px" align="right">
<label style="width:50px;float:left;">Budget</label>
		<span id="budget_change_rent" style="display:none;padding:0px;">
		<select name="budget_min_rent" class="selectbox2" id="buy_budget_min_rent" valtype="budget_min" onchange="javascript:validateMin('buy_budget_min_rent','buy_budget_max_rent');">
			<option value="">Min</option>
			<option value="1" class="">Below 5000</option>
			<option value="5000" class="">5000</option>
			<option value="10000" class="">10000</option>
			<option value="15000" class="">15000</option>
			<option value="20000" class="">20000</option>
			<option value="25000" class="">25000</option>
			<option value="30000" class="">30000</option>
			<option value="40000" class="">40000</option>
			<option value="50000" class="">50000</option>
			<option value="60000" class="">60000</option>
			<option value="75000" class="">75000</option>
			<option value="90000" class="">90000</option>
			<option value="100000" class="">1 Lacs</option>
			<option value="150000" class="">1.5 Lacs</option>
			<option value="200000" class="">2 Lacs</option>
			<option value="300000" class="">3 Lacs</option>
			<option value="500000" class="">5 Lacs</option>
			<option value="1000000" class="">10 Lacs</option>
			<option value="2000000" class="">20 Lacs</option>
			<option value="3000000" class="">30 Lacs</option>
			<option value="4000000" class="">40 Lacs</option>
			<option value="5000000" class="">50 Lacs</option>
			<option value="6000000" class="">60 Lacs</option>
			<option value="7000000" class="">70 Lacs</option>
			<option value="8000000" class="">80 Lacs</option>
			<option value="9000000" class="">90 Lacs</option>
			<option value="10000000" class="">100 Lacs</option>
			<option value="10000000" class="">100+ Lacs</option>
			
		</select> <span style="padding: 0 1px;">to </span> <select name="budget_max_rent" class="selectbox2" id="buy_budget_max_rent" tabindex="2" nameinerr="Max Budget" valtype="budget_max" onchange="javascript:validateMinMax('buy_budget_min_rent','buy_budget_max_rent');">
			<option value="">Max</option>
			<option value="5000" class="">5000</option>
			<option value="10000" class="">10000</option>
			<option value="15000" class="">15000</option>
			<option value="20000" class="">20000</option>
			<option value="25000" class="">25000</option>
			<option value="30000" class="">30000</option>
			<option value="40000" class="">40000</option>
			<option value="50000" class="">50000</option>
			<option value="60000" class="">60000</option>
			<option value="75000" class="">75000</option>
			<option value="90000" class="">90000</option>
			<option value="100000" class="">1 Lacs</option>
			<option value="150000" class="">1.5 Lacs</option>
			<option value="200000" class="">2 Lacs</option>
			<option value="300000" class="">3 Lacs</option>
			<option value="500000" class="">5 Lacs</option>
			<option value="1000000" class="">10 Lacs</option>
			<option value="2000000" class="">20 Lacs</option>
			<option value="3000000" class="">30 Lacs</option>
			<option value="4000000" class="">40 Lacs</option>
			<option value="5000000" class="">50 Lacs</option>
			<option value="6000000" class="">60 Lacs</option>
			<option value="7000000" class="">70 Lacs</option>
			<option value="8000000" class="">80 Lacs</option>
			<option value="9000000" class="">90 Lacs</option>
			<option value="10000000" class="">100 Lacs</option>
			<option value="10000000" class="">100+ Lacs</option>
		</select>
		</span>
		<span id="budget_change_lease" style="padding:0px;">
		<select name="budget_min" class="selectbox2" id="lease_budget_min" valtype="budget_min" onchange="javascript:validateMin('lease_budget_min','lease_budget_max');">
			<option value="">Min</option>
			<option value="1">Below 5 Lacs</option>
			<option value="500000" class="">5 Lacs</option>
				<option value="1000000" class="">10 Lacs</option>
				<option value="1500000" class="">15 Lacs</option>
				<option value="2000000" class="">20 Lacs</option>
				<option value="2500000" class="">25 Lacs</option>
				<option value="3000000" class="">30 Lacs</option>
				<option value="4000000" class="">40 Lacs</option>
				<option value="5000000" class="">50 Lacs</option>
				<option value="6000000" class="">60 Lacs</option>
				<option value="7500000" class="">75 Lacs</option>
				<option value="9000000" class="">90 Lacs</option>
				<option value="10000000" class="">1 Crore</option>
				<option value="15000000" class="">1.5 Crores</option>
				<option value="20000000" class="">2 Crores</option>
				<option value="30000000" class="">3 Crores</option>
				<option value="50000000" class="">5 Crores</option>
				<option value="100000000" class="">10 Crores</option>
				<option value="200000000" class="">20 Crores</option>
				<option value="300000000" class="">30 Crores</option>
				<option value="400000000" class="">40 Crores</option>
				<option value="500000000" class="">50 Crores</option>
				<option value="600000000" class="">60 Crores</option>
				<option value="700000000" class="">70 Crores</option>
				<option value="800000000" class="">80 Crores</option>
				<option value="900000000" class="">90 Crores</option>
				<option value="1000000000" class="">100 Crores</option>
				<option value="1000000001" class="">100+ Crores</option>
		</select> <span style="padding: 0 1px;">to </span> 
		<select name="budget_max" class="selectbox2" id="lease_budget_max" tabindex="2" nameinerr="Max Budget" valtype="budget_max" onchange="javascript:validateMinMax('lease_budget_min','lease_budget_max');">
			<option value="">Max</option>
			<option value="500000" class="">5 Lacs</option>
				<option value="1000000" class="">10 Lacs</option>
				<option value="1500000" class="">15 Lacs</option>
				<option value="2000000" class="">20 Lacs</option>
				<option value="2500000" class="">25 Lacs</option>
				<option value="3000000" class="">30 Lacs</option>
				<option value="4000000" class="">40 Lacs</option>
				<option value="5000000" class="">50 Lacs</option>
				<option value="6000000" class="">60 Lacs</option>
				<option value="7500000" class="">75 Lacs</option>
				<option value="9000000" class="">90 Lacs</option>
				<option value="10000000" class="">1 Crore</option>
				<option value="15000000" class="">1.5 Crores</option>
				<option value="20000000" class="">2 Crores</option>
				<option value="30000000" class="">3 Crores</option>
				<option value="50000000" class="">5 Crores</option>
				<option value="100000000" class="">10 Crores</option>
				<option value="200000000" class="">20 Crores</option>
				<option value="300000000" class="">30 Crores</option>
				<option value="400000000" class="">40 Crores</option>
				<option value="500000000" class="">50 Crores</option>
				<option value="600000000" class="">60 Crores</option>
				<option value="700000000" class="">70 Crores</option>
				<option value="800000000" class="">80 Crores</option>
				<option value="900000000" class="">90 Crores</option>
				<option value="1000000000" class="">100 Crores</option>
				<option value="1000000001" class="">100+ Crores</option>
		</select>
		</span></td>
	</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">	
	<tr>
		<td width="260px" align="center">
		<span>Posted by :</span> 
		<span padding-left="5px"> 		
		<label for="p_a"> <input type="checkbox" id="p_a" name="posted_by[]" value="agent" checked="true"> Agent</label> 
		<label for="p_b"> <input type="checkbox" id="p_b" name="posted_by[]" value="builder" checked="true"> Builder</label>		 
		 <label for="p_o"> <input type="checkbox" id="p_o" name="posted_by[]" value="individuals" checked="true">Individual</label></span>
		</td>
		<td align="right"> 
<input type="submit" value="" name="search" onclick="return fnrentcityid()" class="btn-submit-s right"> <br class="clear">
		</td>
	</tr>
</table><?php $this->endWidget(); ?></div>
<div id="searchtab3" class="right" style="display: none; ">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
    	 'action'=>$this->sellurl,
    	 
		)); ?>
<input type="hidden" name="minsubmit" value="minsubmit">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
	<tr>		
		<td style="padding-left:60px;" align="right"><?php echo $form->radioButtonList($properties,'i_want_to',array('Sell'=>'Sell','Rent'=>'Rent Out'),array('separator'=>' ','labelOptions'=>array('style'=>'display:inline'))); ?></td>
	</tr>	
	<tr>
		<td width="230px" align="right"><label>Property type </label><?php echo $form->dropDownList($properties,'property_type_id',$propertyType,array('class'=>'selectbox1','empty'=>'Select')); ?></td>
	 </tr>
	 <tr>
		<td width="230px" align="right"><label>City </label><?php echo $form->dropdownList($properties,'city_id',$cityList,array('empty'=>'Select','id'=>'geo_city','class'=>'selectbox1'));	?></td>
	</tr>
	 <tr>
		 <td width="230px" align="right"><label>OwnerShip Type </label><?php echo $form->dropDownList($properties,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'Select','class'=>'selectbox1')); ?></td>
		 <td width="180px" align="center"> <input type="submit"  name="minsubmit" value="" class="btn-submit-s1"></td>
	 </tr>
		 
		</tbody> 
	</table>	
<?php $this->endWidget(); ?>
</div>
<div id="searchtab4" class="right" style="display: none; ">
<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
    	 'action'=>$this->specialisturl,   	 
		)); ?>
		<input type="hidden" name="keyword" value=''>
		<input type="hidden" name="search" value=''>
				<input type="hidden" name="mode" value="people">
		<input type="hidden" name="user_type" value="specialist">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-left:37px;">
	<tbody><tr>
		<td><span style="text-align: right; padding: 0 50px 0 0px;">Search for</span> <?php 
				$data= CHtml::listData(Specializations::model()->findAll(),'id','specialist');
			echo CHtml::dropdownList('specialist_type_id[]','',$data,array('empty'=>'Select','class'=>'selectbox1'));
				?></td>
				</tr>
				
				<tr>
		<td><span style="text-align: right; padding: 0 85px 0 0px;">City</span>
		
		<?php
	 echo $form->dropdownList($modelCity,'city',$cityList,array('empty'=>'Select','id'=>'geo_city_wf','class'=>'selectbox1'));
		            	?></td>
	</tr>
	<tr><td>&nbsp</td></tr>
	
	
	<tr>
		<td style="padding-right:70px;"> <input type="submit" value="" onclick="return fnwfcityid()" class="btn-submit-s right"> <br class="clear">
		</td>
	</tr>
</tbody></table>
<?php $this->endWidget(); ?>
</div>
</div>
<script type="text/javascript">

function ClearText(field){
 		
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
function Advanced(name)
{
	document.forms[name].submit();
}
function changelocality(val)
{
	document.getElementById('cityid_auto').value=val;
	document.getElementById('auto_property_type').value=document.getElementById('buy_property').value;
	document.getElementById('auto_cityid').value=document.getElementById('Property_city_id_buy').value;
	document.getElementById('auto_budget_min').value=document.getElementById('buy_budget_min').value;
	document.getElementById('auto_budget_max').value=document.getElementById('buy_budget_max').value;
	document.getElementById('auto_keyword').value=document.getElementById('buy_keyword').value;
	document.forms['locality_auto'].submit();
}

 </script>