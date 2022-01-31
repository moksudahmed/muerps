<?php
/* @var $this StudentController */
/* @var $data Student */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('studentID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->studentID), array('view', 'id'=>$data->studentID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personID')); ?>:</b>
	<?php echo CHtml::encode($data->personID); ?>
	<br />

	

</div>