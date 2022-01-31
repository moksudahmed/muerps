<?php
/* @var $this OptionsController */
/* @var $model Options */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'option_id'); ?>
		<?php echo $form->textField($model,'option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'option_name'); ?>
		<?php echo $form->textField($model,'option_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'option_value'); ?>
		<?php echo $form->textArea($model,'option_value',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'auto_load'); ?>
		<?php echo $form->checkBox($model,'auto_load'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->