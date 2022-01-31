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

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_academicTerm')); ?>:</b>
	<?php echo CHtml::encode($data->stu_academicTerm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_academicYear')); ?>:</b>
	<?php echo CHtml::encode($data->stu_academicYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_testDate')); ?>:</b>
	<?php echo CHtml::encode($data->stu_testDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_totalScore')); ?>:</b>
	<?php echo CHtml::encode($data->stu_totalScore); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_optainedScore')); ?>:</b>
	<?php echo CHtml::encode($data->stu_optainedScore); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_conditions')); ?>:</b>
	<?php echo CHtml::encode($data->stu_conditions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_previousID')); ?>:</b>
	<?php echo CHtml::encode($data->stu_previousID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_previousDegree')); ?>:</b>
	<?php echo CHtml::encode($data->stu_previousDegree); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_guardiansName')); ?>:</b>
	<?php echo CHtml::encode($data->stu_guardiansName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_guardiansPostcode')); ?>:</b>
	<?php echo CHtml::encode($data->stu_guardiansPostcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_guardiansTelephone')); ?>:</b>
	<?php echo CHtml::encode($data->stu_guardiansTelephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_guardiansMobile')); ?>:</b>
	<?php echo CHtml::encode($data->stu_guardiansMobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_guardiansEmail')); ?>:</b>
	<?php echo CHtml::encode($data->stu_guardiansEmail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_financialSource')); ?>:</b>
	<?php echo CHtml::encode($data->stu_financialSource); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stu_financialSourceDescription')); ?>:</b>
	<?php echo CHtml::encode($data->stu_financialSourceDescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeID')); ?>:</b>
	<?php echo CHtml::encode($data->employeeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('programmeCode')); ?>:</b>
	<?php echo CHtml::encode($data->programmeCode); ?>
	<br />

	*/ ?>

</div>