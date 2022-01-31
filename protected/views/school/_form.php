<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sch_code'); ?>
		<?php echo $form->textField($model,'sch_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'sch_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sch_name'); ?>
		<?php echo $form->textField($model,'sch_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sch_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sch_remarks'); ?>
		<?php echo $form->textArea($model,'sch_remarks',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sch_remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->