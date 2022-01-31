<?php
/* @var $this PersonController */
/* @var $model Person */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-_referee-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
        <h2>Referees Details</h2>     

        <div class="row">
		<?php echo $form->labelEx($model,'per_refereeOneName'); ?>
		<?php echo $form->textField($model,'per_refereeOneName'); ?>
		<?php echo $form->error($model,'per_refereeOneName'); ?>
	</div>

         
	<div class="row">
		<?php echo $form->labelEx($model,'per_refereeOneOccupation'); ?>
		<?php echo $form->textField($model,'per_refereeOneOccupation'); ?>
		<?php echo $form->error($model,'per_refereeOneOccupation'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'per_refereeOneAddress'); ?>
		<?php echo $form->textField($model,'per_refereeOneAddress'); ?>
		<?php echo $form->error($model,'per_refereeOneAddress'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($model,'per_refereeOneMobile'); ?>
		<?php echo $form->textField($model,'per_refereeOneMobile'); ?>
		<?php echo $form->error($model,'per_refereeOneMobile'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'per_refereeOneEmail'); ?>
		<?php echo $form->textField($model,'per_refereeOneEmail'); ?>
		<?php echo $form->error($model,'per_refereeOneEmail'); ?>
	</div>

                

	<div class="row">
		<?php echo $form->labelEx($model,'per_refereeTwoName'); ?>
		<?php echo $form->textField($model,'per_refereeTwoName'); ?>
		<?php echo $form->error($model,'per_refereeTwoName'); ?>
	</div>
        
          
	<div class="row">
		<?php echo $form->labelEx($model,'per_refereeTwoOccupation'); ?>
		<?php echo $form->textField($model,'per_refereeTwoOccupation'); ?>
		<?php echo $form->error($model,'per_refereeTwoOccupation'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'per_refereeTwoAddress'); ?>
		<?php echo $form->textField($model,'per_refereeTwoAddress'); ?>
		<?php echo $form->error($model,'per_refereeTwoAddress'); ?>
	</div>
                 
         <div class="row">
		<?php echo $form->labelEx($model,'per_refereeTwoMobile'); ?>
		<?php echo $form->textField($model,'per_refereeTwoMobile'); ?>
		<?php echo $form->error($model,'per_refereeTwoMobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_refereeTwoEmail'); ?>
		<?php echo $form->textField($model,'per_refereeTwoEmail'); ?>
		<?php echo $form->error($model,'per_refereeTwoEmail'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->