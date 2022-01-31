<?php
/* @var $this UniversityController */
/* @var $model University */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'universityCode'); ?>
		<?php echo $form->textField($model,'universityCode',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uni_name'); ?>
		<?php echo $form->textField($model,'uni_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uni_address'); ?>
		<?php echo $form->textField($model,'uni_address',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uni_email'); ?>
		<?php echo $form->textField($model,'uni_email',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uni_webAddress'); ?>
		<?php echo $form->textField($model,'uni_webAddress',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uni_currentTerm'); ?>
		<?php echo $form->textField($model,'uni_currentTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uni_currentYear'); ?>
		<?php echo $form->textField($model,'uni_currentYear'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->