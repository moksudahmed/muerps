<?php
/* @var $this OptionsController */
/* @var $model Options */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'options-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'option_name'); ?>
		<?php echo $form->textField($model,'option_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'option_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'option_value'); ?>
		<?php echo $form->textArea($model,'option_value',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'option_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'auto_load'); ?>
		<?php echo $form->checkBox($model,'auto_load'); ?>
		<?php echo $form->error($model,'auto_load'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->