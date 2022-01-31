<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'termAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examDepartment/SMEmarksEntry'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        <div class="row ">
	<strong>Term: </strong>
		<?php echo CHtml::radioButtonList('exrEntTerm',  (yii::app()->session['exrEntTerm']?yii::app()->session['exrEntTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
        
        <div class="row">
	<strong>Year: </strong>
		<?php  echo CHtml::dropDownList('exrEntYear',  (yii::app()->session['exrEntYear']?yii::app()->session['exrEntYear']:FormUtil::getYear()), FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-3'));  ?>
                        
	</div>
    
		
        

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->