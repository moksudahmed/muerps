<?php
/* @var $this UniversityController */
/* @var $model University */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'university-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'universityCode'); ?>
		<?php echo $form->textField($model,'universityCode',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'universityCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uni_name'); ?>
		<?php echo $form->textField($model,'uni_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'uni_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uni_address'); ?>
		<?php echo $form->textField($model,'uni_address',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'uni_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uni_email'); ?>
		<?php echo $form->textField($model,'uni_email',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'uni_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uni_webAddress'); ?>
		<?php echo $form->textField($model,'uni_webAddress',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'uni_webAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uni_currentTerm'); ?>
		<?php echo $form->textField($model,'uni_currentTerm'); ?>
		<?php echo $form->error($model,'uni_currentTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uni_currentYear'); ?>
		<?php echo $form->textField($model,'uni_currentYear'); ?>
		<?php echo $form->error($model,'uni_currentYear'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->