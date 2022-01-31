<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'studentID'); ?>
		<?php echo $form->textField($model,'studentID',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'personID'); ?>
		<?php echo $form->textField($model,'personID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_academicTerm'); ?>
		<?php echo $form->textField($model,'stu_academicTerm',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_academicYear'); ?>
		<?php echo $form->textField($model,'stu_academicYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_testDate'); ?>
		<?php echo $form->textField($model,'stu_testDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_totalScore'); ?>
		<?php echo $form->textField($model,'stu_totalScore'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_optainedScore'); ?>
		<?php echo $form->textField($model,'stu_optainedScore'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_conditions'); ?>
		<?php echo $form->textArea($model,'stu_conditions',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_previousID'); ?>
		<?php echo $form->textField($model,'stu_previousID',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_previousDegree'); ?>
		<?php echo $form->textField($model,'stu_previousDegree',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_guardiansName'); ?>
		<?php echo $form->textField($model,'stu_guardiansName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_guardiansPostcode'); ?>
		<?php echo $form->textField($model,'stu_guardiansPostcode',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_guardiansTelephone'); ?>
		<?php echo $form->textField($model,'stu_guardiansTelephone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_guardiansMobile'); ?>
		<?php echo $form->textField($model,'stu_guardiansMobile',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_guardiansEmail'); ?>
		<?php echo $form->textField($model,'stu_guardiansEmail',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_financialSource'); ?>
		<?php echo $form->textField($model,'stu_financialSource',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stu_financialSourceDescription'); ?>
		<?php echo $form->textField($model,'stu_financialSourceDescription',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employeeID'); ?>
		<?php echo $form->textField($model,'employeeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'programmeCode'); ?>
		<?php echo $form->textField($model,'programmeCode',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->