<div class="left cols1">
<?php 
$withoutBudgetChecked = '';
if(!isset($_POST['Projects'])){
	$withoutBudgetChecked = 'checked="checked"';
} else {
	$withoutBudgetChecked = isset($_POST['without_budget'])? 'checked="checked"' : '';
}
$launchesChecked = '';
if(isset($_POST['new_launches'])){
	$launchesChecked = 'checked="checked"';
}
?>
<h2>Project Search</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'property-search-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('name'=>'thisProperty'),
)); ?>
<input type="hidden" name="mode" value="project" />
<ul class="acc" id="acc2">
	<li>
	<h3>Basic Details</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td><input type="checkbox" value="1" name="new_launches" <?php echo $launchesChecked;?>>
			<label>New launches</label>
			</td>
		</tr>
		<tr>
			<td><label>Project Type</label> <?php echo $form->dropDownList($modelProject,'project_type_id',CHtml::listData(ProjectTypes::model()->findAll(),'id','project_type'),array('class'=>'select_box','empty'=>'All',
			
            										)); ?>
			</td>
		</tr>
		<tr>
			<td>Keyword(s)<input type="text" name="keyword" class="txt-box1" value="<?php echo isset($_POST['keyword'])? $_POST['keyword'] : '';?>" /></td>
		</tr>
		</table>
		</div>
	</li>
	<li>
		<h3>Location</h3>	
		<div class="acc-section">
		<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td><label>State</label> <br />
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
		            	?>
		            </td>
				</tr>
				<tr>
					<td><label>City</label> <br />
					<span id="city_content" class="dis_inline">
					<?php if(isset($_POST['GeoState']['state'])) {?>
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
		            		
		            		?>
		            	<?php } else {?>
						<b>Select a state</b>
						<?php } ?>
		            	</span>
		            </td>
				</tr>
			</table>

		</div>
	</li>
	<li>
		<h3>Price</h3>	
		<div class="acc-section">
		<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td><label>Budget</label><br />
			<select name="budget_min" class="selectbox2" id="budget_min">
				<option value="">Min</option>
				<option value="0" class="">0</option>
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
			<select name="budget_max" class="selectbox2" id="budget_max">
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
			<br />
			<label><input type="checkbox" name="without_budget" value="1" <?php echo $withoutBudgetChecked; ?>/>Include properties without budget</label>
			</td>
		</tr>
		</table>
		</div>
	</li>
	<li>
		<h3>Property Features</h3>	
		<div class="acc-section">
		<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td><label>Type of Ownership</label> <?php echo $form->dropdownList($modelProject,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),
			array('empty'=>'All','class'=>'select_box',)) ?>
			</td>
		</tr>
		<tr>
			<td><label>Amenities</label><br />
				<div class="multi_checkbox med">
				<?php
					$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
					echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'project-amenities-multi'));
				?>
			</td>
		</tr>
	</table>
	</div>
	</li>

</ul><br />
<div align="center"><input type="submit" name="search" value="" class="btn-submit-s" /></div>
<?php $this->endWidget(); ?></div>
<script type="text/javascript">
	document.getElementById('budget_min').value = "<?php echo isset($_POST['budget_min'])? $_POST['budget_min'] : null; ?>";
	document.getElementById('budget_max').value = "<?php echo isset($_POST['budget_max'])? $_POST['budget_max'] : null; ?>";
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
	var parentAccordion2=new TINY.accordion.slider("parentAccordion2");
	parentAccordion2.init("acc2","h3",1,0);
</script>

