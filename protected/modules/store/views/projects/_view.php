<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode(UserApi::getNameByUserId($data->user_id)),
                                 array('/store/user/view','id'=>$data->user_id)); ?>
	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->projectType->project_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownership_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->ownershipType->ownership_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locality_id')); ?>:</b>
	<?php echo CHtml::encode($data->locality->locality); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?>:</b>
	<?php echo CHtml::encode($data->features); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('covered_area')); ?>:</b>
	<?php echo CHtml::encode($data->covered_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('land_area')); ?>:</b>
	<?php echo CHtml::encode($data->land_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_price')); ?>:</b>
	<?php echo CHtml::encode($data->total_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_starting_from')); ?>:</b>
	<?php echo CHtml::encode($data->price_starting_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('per_unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->per_unit_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_type')); ?>:</b>
	<?php echo CHtml::encode($data->area_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_price')); ?>:</b>
	<?php echo CHtml::encode($data->display_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_negotiable')); ?>:</b>
	<?php echo CHtml::encode($data->price_negotiable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landmarks')); ?>:</b>
	<?php echo CHtml::encode($data->landmarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_fees')); ?>:</b>
	<?php echo CHtml::encode($data->tax_fees); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('terms_and_conditions')); ?>:</b>
	<?php echo CHtml::encode($data->terms_and_conditions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
	<?php echo CHtml::encode($data->views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recently_viewed')); ?>:</b>
	<?php echo CHtml::encode($data->recently_viewed); ?>
	<br />
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_time')); ?>:</b>
	<?php echo CHtml::encode($data->updated_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	*/ ?>

</div>