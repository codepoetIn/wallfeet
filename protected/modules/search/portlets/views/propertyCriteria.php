

<div class="left cols1">
<h2>Property Search</h2>
<script language="javascript">
function urlSearch()
{
	if(document.getElementById("sell").checked==true)
	{
		document.getElementById("property").setAttribute("action","/search/property");
	}
	if(document.getElementById("rent").checked==true)
	{
		document.getElementById("property").setAttribute("action","/search/property");
	}
	if(document.getElementById("lease").checked==true)
	{
		document.getElementById("property").setAttribute("action","/search/property");
	}
}
</script> <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'property',
			'action'=>'/search/property',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('name'=>'thisProperty'),
));

$sellChecked='';
$rentChecked='';
$leaseChecked='';
if(isset($_POST['Property']['i_want_to']))
{
	if($_POST['Property']['i_want_to']=='Sell')
	{
		$sellChecked='checked="checked"';

	}
	elseif($_POST['Property']['i_want_to']=='Rent')
	{
		$rentChecked='checked="checked"';
	}
	elseif($_POST['Property']['i_want_to']=='Lease')
	{
		$leaseChecked='checked="checked"';
	}
}
if(isset($_GET['Property']['i_want_to']))
{
	if($_GET['Property']['i_want_to']=='Sell')
	{
		$sellChecked='checked="checked"';

	}
	elseif($_GET['Property']['i_want_to']=='Rent')
	{
		$rentChecked='checked="checked"';
	}
	elseif($_GET['Property']['i_want_to']=='Lease')
	{
		$leaseChecked='checked="checked"';
	}
}

$allChecked='';
$agentChecked='';
$builderChecked='';
$individualsChecked='';
if(isset($_POST['posted_by']))
{
	$allChecked='';
	$i=0;
	$postedBy=$_POST['posted_by'];
	foreach($postedBy as $posted){
		if($posted=='agent')
		{
			$agentChecked='checked="checked"';
			$i=$i+1;		
		}
		if($posted=='builder')
		{
			$builderChecked='checked="checked"';
			$i=$i+1;		
		}	
		if($posted=='individuals')
		{
			$individualsChecked='checked="checked"';
			$i=$i+1;		
		}			
		if($i==3)
		{
			$allChecked='checked="checked"';	
		}	
	}
}
$launchesChecked = '';
if(isset($_POST['new_launches']) || isset($_GET['new_launches'])){
	$launchesChecked = 'checked="checked"';
}
$withoutBudgetChecked = '';
if(!isset($_POST['Property'])){
	$withoutBudgetChecked = 'checked="checked"';
} else {
	$withoutBudgetChecked = isset($_POST['without_budget'])? 'checked="checked"' : '';
}
?> <input type="hidden" name="mode" value="property" />
<ul class="acc" id="acc">
	<li>
	<h3>Basic Details</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
		<tr>
			<td><label>I Want to</label><br />
			<input type="radio" name="Property[i_want_to]" value="Sell" id="sell"
			<?php echo $sellChecked;?>> <label for="Property_i_want_to_0"
				style="display: inline">Buy</label> <input type="radio"
				name="Property[i_want_to]" value="Rent" id="rent"
				<?php echo $rentChecked?>> <label for="Property_i_want_to_0"
				style="display: inline">Rent In</label> <input type="radio"
				name="Property[i_want_to]" value="Lease" id="lease"
				<?php echo $leaseChecked?>> <label for="Property_i_want_to_0"
				style="display: inline">Lease</label></td>
		</tr>
		<tr>
			<td><input type="checkbox" value="1" name="new_launches"
			<?php echo $launchesChecked;?>> <label>New launches</label></td>
		</tr>
		<tr>
			<td><label>Property Type</label> <?php echo $form->dropDownList($modelProperty,'property_type_id',
			CHtml::listData(PropertyTypes::model()->with('category')->findAll(),'id','property_type','category.category'),array('class'=>'select_box','empty'=>'All',
			'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('/property/getPropertyCriteriaType'),  
                                	'update'=>'#property_criteria_type',
									'data'=>'js:jQuery(this).serialize()',
							)

			)); ?></td>
		</tr>
		
	
	
		<tr>
		<?php 
		$value='';
		if(isset($_POST['keyword'])) 
		{
		if($_POST['keyword']!='Eg: Builder') 
		$value=$_POST['keyword'];
		}?>
			<td>Keyword(s)<input type="text" name="keyword" class="txt-box1"
				value="<?php echo $value;?>" /></td>
		</tr>
	</table>
	</div>
	</li>
	<li>
	<h3>Location</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
		<tr>
			<td><label>Region</label> <br />
			<?php
			if(isset($_POST['GeoState']['state'])){
				$modelState->state = $_POST['GeoState']['state'];
			}
			echo $form->dropdownList($modelState,'state',
			CHtml::listData(GeoState::model()->findAll(),'id','state'),
			array('empty'=>'All',
								  'id'=>'geo_state',
								  'class'=>'select_box',
								  'ajax' => array(
		                                'type'=>'POST',
		                                'url'=>CController::createUrl('/location/city/getCityList'),  
		                                'update'=>'#city_content',
										'data'=>'js:jQuery(this).serialize()',
			)
			)
			);
			?></td>
		</tr>
		<tr>
			<td><label>City</label> <br />
			<span id="city_content" class="dis_inline"> <?php if(isset($_POST['GeoState']['state'])) {?>
			<?php
			if(isset($_POST['GeoCity']['city'])){
				$modelCity->city = $_POST['GeoCity']['city'];
			}
			echo $form->dropdownList($modelCity,'city',CHtml::listData(GeoCity::model()->findAll(),'id','city'),
			array('empty'=>'All','id'=>'geo_city',
									'class'=>'select_box',
			                        'ajax' => array(
		                                'type'=>'POST',
		                                'url'=>CController::createUrl('/location/locality/getList'),  
		                                'update'=>'#locality_content',
										'data'=>'js:jQuery(this).serialize()',
			))
			);

			?> <?php } else { 
			if(isset($_POST['GeoCity']['city'])){
				$modelCity->city = $_POST['GeoCity']['city'];
			}
			echo $form->dropdownList($modelCity,'city',CHtml::listData(GeoCity::model()->findAll(),'id','city'),
			array('empty'=>'All','id'=>'geo_city',
									'class'=>'select_box',
			                        'ajax' => array(
		                                'type'=>'POST',
		                                'url'=>CController::createUrl('/location/locality/getList'),  
		                                'update'=>'#locality_content',
										'data'=>'js:jQuery(this).serialize()',
			))
			);

			} ?> </span></td>
		</tr>
		<tr>
			<td><label>Locality</label> <br />
			<span id="city_content" class="dis_inline"> 
			</span>
			<div id="locality_content" class="dis_inline"><?php
			if(isset($_POST['GeoLocality']['locality'])){
				$locality = $_POST['GeoLocality']['locality'];
				$modelLocality->locality = $_POST['GeoLocality']['locality'];
			}else {
				$locality = '';
			}
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
								'model'=>$modelLocality,
					 			'name'=>'GeoLocality[locality]',
								'value'=>$locality,
			// 'source'=>CController::createUrl('/location/locality/getLocalityAutoComplete/'), 'value'=>'',
								 'source' => array_values($localityList),
								 'htmlOptions'=>array('class'=>'txtbox med')
			));
			?>
			
			</td>
		</tr>
	</table>

	</div>
	</li>
	<li>
	<h3>Price</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
		<tr>
			<td><label>Budget</label><br />
		<select class="selectbox2" name="budget_min" id="drop_property_min">
			<option value="">Min</option>
			<option class="" value="1">Below 5 Lacs</option>
			<option class="" value="500000">5 Lacs</option>
			<option class="" value="1000000">10 Lacs</option>
			<option class="" value="1500000">15 Lacs</option>
			<option class="" value="2000000">20 Lacs</option>
			<option class="" value="2500000">25 Lacs</option>
			<option class="" value="3000000">30 Lacs</option>
			<option class="" value="4000000">40 Lacs</option>
			<option class="" value="5000000">50 Lacs</option>
			<option class="" value="6000000">60 Lacs</option>
			<option class="" value="7500000">75 Lacs</option>
			<option class="" value="9000000">90 Lacs</option>
			<option class="" value="10000000">1 Crore</option>
			<option class="" value="15000000">1.5 Crores</option>
			<option class="" value="20000000">2 Crores</option>
			<option class="" value="30000000">3 Crores</option>
			<option class="" value="50000000">5 Crores</option>
			<option class="" value="100000000">10 Crores</option>
			<option class="" value="200000000">20 Crores</option>
			<option class="" value="300000000">30 Crores</option>
			<option class="" value="400000000">40 Crores</option>
			<option class="" value="500000000">50 Crores</option>
			<option class="" value="600000000">60 Crores</option>
			<option class="" value="700000000">70 Crores</option>
			<option class="" value="800000000">80 Crores</option>
			<option class="" value="900000000">90 Crores</option>
			<option class="" value="1000000000">100 Crores</option>
			<option class="" value="1000000001">100+ Crores</option>
			</select> <span style="padding: 0 1px;">to </span> <select class="selectbox2" name="budget_max" id="drop_property_max" onchange="javascript:validateMinMax('drop_property_min','drop_property_max');">
				<option value="">Max</option>
				<option class="" value="500000">5 Lacs</option>
				<option class="" value="1000000">10 Lacs</option>
				<option class="" value="1500000">15 Lacs</option>
				<option class="" value="2000000">20 Lacs</option>
				<option class="" value="2500000">25 Lacs</option>
				<option class="" value="3000000">30 Lacs</option>
				<option class="" value="4000000">40 Lacs</option>
				<option class="" value="5000000">50 Lacs</option>
				<option class="" value="6000000">60 Lacs</option>
				<option class="" value="7500000">75 Lacs</option>
				<option class="" value="9000000">90 Lacs</option>
				<option class="" value="10000000">1 Crore</option>
				<option class="" value="15000000">1.5 Crores</option>
				<option class="" value="20000000">2 Crores</option>
				<option class="" value="30000000">3 Crores</option>
				<option class="" value="50000000">5 Crores</option>
				<option class="" value="100000000">10 Crores</option>
				<option class="" value="200000000">20 Crores</option>
				<option class="" value="300000000">30 Crores</option>
				<option class="" value="400000000">40 Crores</option>
				<option class="" value="500000000">50 Crores</option>
				<option class="" value="600000000">60 Crores</option>
				<option class="" value="700000000">70 Crores</option>
				<option class="" value="800000000">80 Crores</option>
				<option class="" value="900000000">90 Crores</option>
				<option class="" value="1000000000">100 Crores</option>
				<option class="" value="1000000001">100+ Crores</option>
			</select> <br />
			<label><input type="checkbox" name="without_budget" value="1"
			<?php echo $withoutBudgetChecked; ?> />Include properties without
			budget</label></td>
		</tr>
	</table>
	</div>
	</li>
	<li>
	<h3>Property Features</h3>
	<div class="acc-section" id="property_criteria_type">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
			<tr>
			<td><label>Transaction Type</label> <?php echo $form->dropDownList($modelProperty,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('class'=>'select_box','empty'=>'All'
				
			)); ?>
			</td>
		</tr>
		<tr>
			<td><label>Age Of Construction</label><br />
			<?php echo $form->dropdownList($modelProperty,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'All','class'=>'select_box',)) ?>
			</td>
		</tr>
		<tr>
			<td><label>Type of Ownership</label> <?php echo $form->dropdownList($modelProperty,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'All','class'=>'select_box',)) ?>
			</td>
		</tr>
		<tr>
			<td><label>Amenities</label><br />
			<div class="multi_checkbox med"><?php 
			$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
			echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi'));
			?></div>
			</td>
		</tr>
	</table>
	</div>
	</li>
	<li>
	<h3>Others</h3>
	<div class="acc-section">
	<table align="center" width="94%">
		<tr>
			<td>Posted by
			<table width="92%" border="0">
			<tr>
					<td><input type="checkbox" name="posted_by_all" value="1" onclick="fnCheckAll(this.checked)" <?php echo $allChecked;?> />All</td>
					<td><input type="checkbox" name="posted_by[]" value="agent" onclick="fnChecked(this.checked)" <?php echo $agentChecked;?> />Agent</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="posted_by[]" value="individuals" onclick="fnChecked(this.checked)" <?php echo $individualsChecked;?> />Individuals</td>
					<td><input type="checkbox" name="posted_by[]" value="builder" onclick="fnChecked(this.checked)" <?php echo $builderChecked;?> />Builder</td>
				</tr>				
			</table>
			Listing
			<table>
				<tr>
					<td><?php echo CHtml::activeCheckBox($modelProperty,'jackpot_investment'); ?>
					Jackpot Investment</td>
				</tr>
				<tr>
					<td><?php echo CHtml::activeCheckBox($modelProperty,'featured'); ?>
					Premium/Featured</td>
				</tr>
				<tr>
					<td><?php echo CHtml::activeCheckBox($modelProperty,'instant_home'); ?>
					Instant Homes</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td></td>
		</tr>
	</table>
	</div>
	</li>
</ul>
<br />
<div align="center"><input type="submit" name="submit" value=""	class="btn-submit-s" Onclick="urlSearch();" /></div>
			<?php $this->endWidget(); ?></div>
	
<script type="text/javascript">
	document.getElementById('budget_min').value = "<?php echo isset($_POST['budget_min'])? $_POST['budget_min'] : null; ?>";
	document.getElementById('budget_max').value = "<?php echo isset($_POST['budget_max'])? $_POST['budget_max'] : null; ?>";
	//fnMultiSelect('amenities-multi',"<?php echo $amenities; ?>");
	<?php if(isset($_POST['posted_by_all'])){ ?>
	document.thisProperty.posted_by_all.checked = "checked";
	fnCheckAll(1);
	<?php }	?>
	<?php 
		$posted_by = isset($_POST['posted_by'])? $_POST['posted_by'] : null;
		if($posted_by){
			$posted_data = null;
			foreach($posted_by as $i=>$posted){
				if($i!=0)
           			$posted_data.=',';
           		$posted_data.=$posted;
			}	
			$posted_by = $posted_data;
	?>
	var obj = document.thisProperty.elements["posted_by[]"];
	var posted_by = "<?php echo $posted_by; ?>";
	posted_by = posted_by.split(',');
	if(posted_by!=null){
		for(var i=0;i<obj.length;i++){
			for(var j=0;j<posted_by.length;j++){
				if(obj[i].value==posted_by[j]){
					obj[i].checked = "checked";
				}
			}
		}
	}
	<?php } ?>
</script>
<script type="text/javascript">
	var parentAccordion=new TINY.accordion.slider("parentAccordion");
	parentAccordion.init("acc","h3",0,0);
	
	
</script>

