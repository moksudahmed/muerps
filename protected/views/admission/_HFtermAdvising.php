<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

    
    <h4><strong>Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['MainAdmTerm']); ?> </span><strong> Year: </strong><span class="label label-success"> <?php echo yii::app()->session['MainAdmYear'];  ?></span></h4>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'termAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('termAdvising/index'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        <div class="row">
            <?php echo Chtml::hiddenField('traTerm', yii::app()->session['MainAdmTerm']); ?>
            <?php echo Chtml::hiddenField('traYear', yii::app()->session['MainAdmYear']); ?>
        </div>
		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->