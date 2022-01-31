<?php
/* @var $this UniversityController */
/* @var $data University */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('universityCode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->universityCode), array('view', 'id'=>$data->universityCode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uni_name')); ?>:</b>
	<?php echo CHtml::encode($data->uni_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uni_address')); ?>:</b>
	<?php echo CHtml::encode($data->uni_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uni_email')); ?>:</b>
	<?php echo CHtml::encode($data->uni_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uni_webAddress')); ?>:</b>
	<?php echo CHtml::encode($data->uni_webAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uni_currentTerm')); ?>:</b>
	<?php echo CHtml::encode($data->uni_currentTerm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uni_currentYear')); ?>:</b>
	<?php echo CHtml::encode($data->uni_currentYear); ?>
	<br />


</div>