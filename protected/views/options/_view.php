<?php
/* @var $this OptionsController */
/* @var $data Options */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('optionID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->optionID), array('view', 'id'=>$data->optionID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_name')); ?>:</b>
	<?php echo CHtml::encode($data->option_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_value')); ?>:</b>
	<?php echo CHtml::encode($data->option_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('auto_load')); ?>:</b>
	<?php echo CHtml::encode($data->auto_load); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_group')); ?>:</b>
	<?php echo CHtml::encode($data->option_group); ?>
	<br />


</div>