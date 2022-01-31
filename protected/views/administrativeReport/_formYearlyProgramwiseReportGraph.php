<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offeredModule-form3',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('administrativeReport/yearlyBasisProgrammeWise'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
<div class="row ">
	
       
          
	
        <div class="row">
           
            <?php  
            echo CHtml::submitButton('Genearte Report', array('class' => 'btn btn-primary btn-large'));
           ?>
        </div>
        
        
<?php $this->endWidget(); ?>
</div>
</div><!-- form -->