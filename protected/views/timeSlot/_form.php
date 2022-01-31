<?php
/* @var $this TimeSlotController */
/* @var $model TimeSlot */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'time-slot-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'timeSlotCode'); ?>
		<?php echo $form->textField($model,'timeSlotCode',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'timeSlotCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tst_start'); ?>
		<?php echo $form->textField($model,'tst_start'); ?>
		<?php echo $form->error($model,'tst_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tst_end'); ?>
		<?php echo $form->textField($model,'tst_end'); ?>
		<?php echo $form->error($model,'tst_end'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->