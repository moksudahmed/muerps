<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('schoolID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->schoolID),array('view','id'=>$data->schoolID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sch_code')); ?>:</b>
	<?php echo CHtml::encode($data->sch_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sch_name')); ?>:</b>
	<?php echo CHtml::encode($data->sch_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sch_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->sch_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sch_deanStatus')); ?>:</b>
	<?php echo CHtml::encode($data->sch_deanStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sch_dean')); ?>:</b>
	<?php echo CHtml::encode($data->sch_dean); ?>
	<br />


</div>