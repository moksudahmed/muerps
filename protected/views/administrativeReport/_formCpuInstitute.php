<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offeredModule-form3',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('administrativeReport/CopyInstitute'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
<div class="row ">
		
        <div class="row">
           
            <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>
        </div>
        
  </div>      
<?php $this->endWidget(); ?>

</div><!-- form -->