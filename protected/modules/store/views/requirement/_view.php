<div class="view">

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo UserApi::getNameByUserId($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('i_want_to')); ?>:</b>
	<?php echo CHtml::encode($data->i_want_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('covered_area_from')); ?>:</b>
	<?php echo CHtml::encode($data->covered_area_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('covered_area_to')); ?>:</b>
	<?php echo CHtml::encode($data->covered_area_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plot_area_from')); ?>:</b>
	<?php echo CHtml::encode($data->plot_area_from); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('plot_area_to')); ?>:</b>
	<?php echo CHtml::encode($data->plot_area_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_price')); ?>:</b>
	<?php echo CHtml::encode($data->min_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_price')); ?>:</b>
	<?php echo CHtml::encode($data->max_price); ?>
	<br />

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