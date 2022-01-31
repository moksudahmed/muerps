<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offeredModule-form3',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('termAdmission/getAttStudentList'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
<div class="row ">
	<strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('attTerm',  (yii::app()->session['attTerm']?yii::app()->session['attTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
       
        <div class="row">
            <strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('attYear',(yii::app()->session['attYear']?yii::app()->session['attYear']:FormUtil::getYear()) , FormUtil::yearForDropDown(2010), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'requirte'=>true
                        //'class'=>'span-4',
                        ));  ?>
        </div>
        
	<div class="row">
		<strong> Programme:</strong><br/>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('getSection'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#sectionName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
        
        <div class="row">
            <strong> Batch:</strong><br/>
            <?php echo CHtml::dropDownList('sectionName','sectionName',array(),array(
                        'prompt' => '-- Select  Programme First--',
                        'value' => '0',
                        'required' =>true,
                'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('termAdmission/getModule'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#moduleName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                    ));?>
            
        </div>
    <div id="moduleName">
    </div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->