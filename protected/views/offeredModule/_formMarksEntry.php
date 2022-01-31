<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formMarksEntyr-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examRegistration/getRegisteredModule'),
    'htmlOptions'=>(array('autocomplete'=>'off',)),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
<div class="row ">
            <strong>Examination: </strong>Final
		<?php //echo CHtml::radioButtonList('mreExamType',(yii::app()->session['mreExamType']?yii::app()->session['mreExamType']:1) ,  ZHtml::$ExamType, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  
                    echo CHtml::hiddenField('mreExamType', 1);
                ?>
            
	</div>
        <div class="row ">
	<strong>Term:</strong>
		<?php echo CHtml::radioButtonList('mreTerm',  (yii::app()->session['mreTerm']?yii::app()->session['mreTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
        
        <div class="row">
            <strong>Year:</strong>
		<?php  echo CHtml::dropDownList('mreYear', '', FormUtil::yearForDropDown(2010), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        //'class'=>'span-4',
                        'ajax' => array(
                        'type'=>'POST', //request type
                        'url'=>CController::createUrl('offeredModule/marksEntryProCode'), //url to call.
                        //Style: CController::createUrl('currentController/methodToCall')
                        'update'=>'#proCode', //selector to update
                        //'data'=>'js: $(this).val()' 
                        //leave out the data key to pass all form values through
                        )));  ?>
        </div>
        <div id="proCode" class="row">
                
	</div>

        

		
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->