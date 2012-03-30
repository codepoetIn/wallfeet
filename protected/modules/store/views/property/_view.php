<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode(UserApi::getNameByUserId($data->user_id)),
                                 array('/store/user/view','id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_want_to')); ?>:</b>
	<?php echo CHtml::encode($data->i_want_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_name')); ?>:</b>
	<?php echo CHtml::encode($data->property_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('features')); ?>:</b>
	<?php echo CHtml::encode($data->features); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('featured')); ?>:</b>
	<?php echo CHtml::encode($data->featured); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('jackpot_investment')); ?>:</b>
	<?php echo CHtml::encode($data->jackpot_investment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('instant_home')); ?>:</b>
	<?php echo CHtml::encode($data->instant_home); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->propertyType->property_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->transactionType->transaction_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locality_id')); ?>:</b>
	<?php if($data->locality_id)
			echo CHtml::encode($data->locality->locality);
		  else	
			echo CHtml::encode($data->locality_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bathrooms')); ?>:</b>
	<?php echo CHtml::encode($data->bathrooms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedrooms')); ?>:</b>
	<?php echo CHtml::encode($data->bedrooms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('furnished')); ?>:</b>
	<?php echo CHtml::encode($data->furnished); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('age_of_construction')); ?>:</b>
	<?php echo CHtml::encode($data->age_of_construction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownership_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->ownershipType->ownership_type); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_from')); ?>:</b>
	<?php echo CHtml::encode($data->available_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_units')); ?>:</b>
	<?php echo CHtml::encode($data->available_units); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facing')); ?>:</b>
	<?php echo CHtml::encode($data->facing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('floor_number')); ?>:</b>
	<?php echo CHtml::encode($data->floor_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_floors')); ?>:</b>
	<?php echo CHtml::encode($data->total_floors); ?>
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



</div>