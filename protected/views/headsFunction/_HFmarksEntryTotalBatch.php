<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formMarksEntyr-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('headsFunction/GetRegisteredModuleForBatch'),
    'htmlOptions'=>(array('autocomplete'=>'off',)),
)); ?>

	
	<?php //echo yii::app()->session['mreTerm'] ?>
<div class="row ">
            <strong>Examination: </strong>Final
		<?php //echo CHtml::radioButtonList('mreExamType',(yii::app()->session['mreExamType']?yii::app()->session['mreExamType']:1) ,  ZHtml::$ExamType, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  
                    echo CHtml::hiddenField('mreExamType', 1);
                ?>
            
	</div>
        <div class="row ">
	<strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('mreTerm',  (yii::app()->session['mreTerm']?yii::app()->session['mreTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',));  ?>
            
	</div>
        
        <div class="row">
            <strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('mreYear', (yii::app()->session['mreYear']?yii::app()->session['mreYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        //'class'=>'span-4',
                        
                        ));  ?>
        </div>
    <div  class="row">
            <strong><?php echo CHtml::encode("Programme:"); ?></strong><br/>
                
		<?php echo CHtml::dropDownList('programmeCode','', CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                    'ajax' => array(
                    'type'=>'POST', //request type
          'url'=>CController::createUrl('headsFunction/marksEntryProCode'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#proCode', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>

            
            
        </div>
        <div id="proCode" class="row">
                
	</div>

        

		
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->