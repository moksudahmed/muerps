<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'administration-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'administrationCode'); ?>
		<?php echo $form->textField($model,'administrationCode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'administrationCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adm_name'); ?>
		<?php echo $form->textField($model,'adm_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'adm_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adm_location'); ?>
		<?php echo $form->textField($model,'adm_location',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'adm_location'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'adm_contactNo'); ?>
		<?php echo $form->textField($model,'adm_contactNo',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'adm_contactNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adm_email'); ?>
		<?php echo $form->textField($model,'adm_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'adm_email'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'adm_remarks'); ?>
		<?php echo $form->textArea($model,'adm_remarks',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'adm_remarks'); ?>
	</div>
	<div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->