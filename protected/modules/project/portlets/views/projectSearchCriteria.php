<div class="left cols1">
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
			<td><label>City</label> 
				<?php echo $form->dropdownList($modelProject,'city_id',CHtml::listData(GeoCity::model()->findAll(),'id','city'),array('empty'=>'All','id'=>'geo_city',
	                        'ajax' => array(
                                'type'=>'POST',
                                'url'=>CController::createUrl('/location/locality/getList'),  
                                'update'=>'#locality_content',
							'data'=>'js:jQuery(this).serialize()',
            		))
            		);
            		$city = isset($_POST['Projects']['city_id'])? $_POST['Projects']['city_id'] : '';
            		?>
            </td>
		</tr>
		<tr>
			<td><label>Locality</label>
			<div id="locality_content" class="dis_inline">
				<?php
					echo $form->dropdownList($modelProject,'locality_id',CHtml::listData(GeoLocality::model()->findAll('city_id=:city_id',array(':city_id'=>$city)),'id','locality'),array('empty'=>'All','id'=>'geo_locality'));
				?>
			</div>
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
			<td><label>Type of Ownership</label> <?php echo $form->dropdownList($modelProject,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'All',)) ?>
			</td>
		</tr>
		<tr>
			<td><label>Amenities</label><br />
				<div class="multi_checkbox med">
				<?php
					$property_type_id = isset($_POST['property_type_id'])? $_POST['property_type_id'] : null;
					echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'project-amenities-multi'));
				?>
				</div>
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
					<td><input type="checkbox" name="posted_by_all" value="1" onclick="fnCheckAll(this.checked)"/>All</td>
					<td><input type="checkbox" name="posted_by[]" value="agent" onclick="fnChecked(this.checked)" />Agent</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="posted_by[]" value="individuals" onclick="fnChecked(this.checked)" />Individuals</td>
					<td><input type="checkbox" name="posted_by[]" value="builder" onclick="fnChecked(this.checked)" />Builder</td>
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
</ul><br />
<div align="center"><input type="submit" name="search" value="" class="btn-submit-s" /></div>
<?php $this->endWidget(); ?></div>
<script type="text/javascript">
	document.getElementById('geo_city').value = "<?php echo $city; ?>";
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

<script type="text/javascript">
$(function(){
	$("#project-amenities-multi").multiselect();
});
</script>
