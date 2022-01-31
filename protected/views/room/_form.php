<?php
/* @var $this RoomController */
/* @var $model Room */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
'enableClientValidation'=>true,
    'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'roomCode'); ?>
		<?php echo $form->textField($model,'roomCode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'roomCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rom_type'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList(
                            $model,
                            'rom_type',
                            
                            array('rel'=>'type','labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'rom_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rom_capacity'); ?>
		<?php echo $form->textField($model,'rom_capacity'); ?>
		<?php echo $form->error($model,'rom_capacity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rom_floor'); ?>
		<?php echo $form->textField($model,'rom_floor'); ?>
		<?php echo $form->error($model,'rom_floor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->