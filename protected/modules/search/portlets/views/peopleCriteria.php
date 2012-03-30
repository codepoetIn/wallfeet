<div class="left cols1">
<h2>People Search</h2>
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'agent-search-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('name'=>'thisPeople'),
)); ?> 
<input type="hidden" name="mode" value="people" />
<label><input type="radio" name="user_type" value="agent" onclick="fnUserBlock('agent');" checked="checked" />Agent</label> 
<label><input type="radio" name="user_type" value="builder" onclick="fnUserBlock('builder');" <?php if(isset($_POST['user_type']) && $_POST['user_type']=="builder") echo 'checked="checked"'; ?> />Builder</label>
<label><input type="radio" name="user_type" value="specialist" onclick="fnUserBlock('specialist');" <?php if(isset($_POST['user_type']) && $_POST['user_type']=="specialist") echo 'checked="checked"'; ?> />Specialist</label>
<?php 
	$agent_class = "";
	$specialist_class = "user_block";
	if(isset($_POST['user_type']) && $_POST['user_type']=="specialist"){
		$agent_class = "user_block";
		$specialist_class = "";
	}

?>
<ul class="acc" id="acc1">
	<li>
	<h3>Basic Details</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">

		<tr>
			<td>
				<label>Keyword Search</label> <input type="text" name="keyword" class="txt-box1" value="<?php echo isset($_POST['keyword'])? $_POST['keyword'] : '';?>" />
			</td>
		</tr>
	</table>
	</div>
	</li>
	<li id="agent" class="<?php echo $agent_class; ?>">
	<h3>Property Details</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
		<tr>
			<td>
				<label>Properties handled</label> <br />
				<div class="multi_checkbox med">
				<?php
					$property_type_id = isset($_POST['property_type_id'])? $_POST['property_type_id'] : null;
					echo CHtml::checkBoxList('property_type_id',$property_type_id,CHtml::listData(PropertyTypes::model()->findAll(),'id','property_type'),array('multiple'=>'multiple','id'=>'property_types_multi'));
				?>
				</div>				
			</td>
		</tr>
	</table>
	</div>
	</li>
	<li id="specialist" class="<?php echo $specialist_class; ?>">
	<h3>Specialist Details</h3>
	<div class="acc-section">
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
		<tr>
			<td><label>Specialist In</label> <br />
				<div class="multi_checkbox med">
				<?php 
					$specialist_type_id = isset($_POST['specialist_type_id'])? $_POST['specialist_type_id'] : null;				
					echo CHtml::checkBoxList('specialist_type_id',$specialist_type_id,CHtml::listData(Specializations::model()->findAll(),'id','specialist'),array('multiple'=>'multiple','id'=>'specialist_multi')); 
				?>
			</td>
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
		            	?>
		            </td>
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

	</table>
	</div>
	</li>
</ul>
<div align="center"><input type="submit" name="search" value="" class="btn-submit-s" /></div>
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
	var parentAccordion1=new TINY.accordion.slider("parentAccordion1");
	parentAccordion1.init("acc1","h3",1,0);
</script>