
<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('tools/removeTermAdmission'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        <div class="row">
             <span>Student ID:</span>
                <?php echo CHtml::textField("studentID", '', array('size'=>20,'maxlength'=>20,'width'=>5,));?>    
        </div>
	
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->