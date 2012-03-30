<?php 
switch($type)
{
	case 22:
	case 23:
	case 24:
	case 25:
	case 26:
		?>
		<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
		<tr>
			<td><label>Type of Ownership</label> <?php echo CHtml::activeDropDownList($modelProperty,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'All','class'=>'select_box',)) ?>
			</td>
		</tr>
			
	</table>
		<?php break;
default:?>
	<table width="92%" border="0" cellpadding="0" cellspacing="0"
		align="center">
			<tr>
			<td><label>Transaction Type</label> <?php echo CHtml::activeDropDownList($modelProperty,'transaction_type_id',CHtml::listData(PropertyTransactionTypes::model()->findAll(),'id','transaction_type'),array('class'=>'select_box','empty'=>'All'
				
			)); ?>
			</td>
		</tr>
		<tr>
			<td><label>Age Of Construction</label><br />
			<?php echo CHtml::activeDropDownList($modelProperty,'age_of_construction',CHtml::listData(PropertyAgeOfConstruction::model()->findAll(),'id','age'),array('empty'=>'All','class'=>'select_box',)) ?>
			</td>
		</tr>
		<tr>
			<td><label>Type of Ownership</label> <?php echo CHtml::activeDropDownList($modelProperty,'ownership_type_id',CHtml::listData(CategoryOwnershipTypes::model()->findAll(),'id','ownership_type'),array('empty'=>'All','class'=>'select_box',)) ?>
			</td>
		</tr>
		<tr>
			<td><label>Amenities</label><br />
			<div class="multi_checkbox med"><?php 
			//$amenities = isset($_POST['amenity_id'])? $_POST['amenity_id'] : null;
			echo CHtml::activeCheckBoxList($propertyAmenities,'amenity_id',CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi'));
			//echo CHtml::checkBoxList('amenity_id',$amenities,CHtml::listData(CategoryAmenities::model()->findAll(),'id','amenity'),array('size'=>'5','multiple'=>'multiple','id'=>'amenities-multi'));
			?></div>
			</td>
		</tr>
	</table>
<?php break;
}?>