<?php
/* @var $this FacultyController */
/* @var $model Faculty */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faculty-report-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'facultyID'); ?>
		<?php echo $form->textField($model,'facultyID'); ?>
		<?php echo $form->error($model,'facultyID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'departmentID'); ?>
		<?php echo $form->textField($model,'departmentID'); ?>
		<?php echo $form->error($model,'departmentID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_designation'); ?>
		<?php echo $form->textField($model,'fac_designation'); ?>
		<?php echo $form->error($model,'fac_designation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_position'); ?>
		<?php echo $form->textField($model,'fac_position'); ?>
		<?php echo $form->error($model,'fac_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_loginName'); ?>
		<?php echo $form->textField($model,'fac_loginName'); ?>
		<?php echo $form->error($model,'fac_loginName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_password'); ?>
		<?php echo $form->textField($model,'fac_password'); ?>
		<?php echo $form->error($model,'fac_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_accessLevel'); ?>
		<?php echo $form->textField($model,'fac_accessLevel'); ?>
		<?php echo $form->error($model,'fac_accessLevel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_joining'); ?>
		<?php echo $form->textField($model,'fac_joining'); ?>
		<?php echo $form->error($model,'fac_joining'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fac_leave'); ?>
		<?php echo $form->textField($model,'fac_leave'); ?>
		<?php echo $form->error($model,'fac_leave'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->