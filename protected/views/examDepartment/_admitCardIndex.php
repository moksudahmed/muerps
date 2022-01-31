<?php
/* @var $this RegistryController */

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exam-form1',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('examRegistration/AdmitCardIssue'),
)); ?>

<div class="form " >
    <div class="row ">
	<strong>Examination Term:</strong><br/>
		<?php echo CHtml::radioButtonList('aciTerm',(yii::app()->session['aciTerm']?yii::app()->session['aciTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true,));  ?>
            
	</div>

        <div class="row">
	<strong>Examination Year:</strong><br/>
		<?php  echo CHtml::dropDownList('aciYear', (yii::app()->session['aciYear']?yii::app()->session['aciYear']:FormUtil::getYear()),  FormUtil::yearForDropDown(FormUtil::getYear()-4), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>true,
                       /*   'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examRegistration/getProgramme'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#programmeCode', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )*/
                        ));  ?>
	
	</div>
        
        <div class="row" >
            
            <strong>Select Programme:</strong><br/>
		<?php echo CHtml::dropDownList('programmeCode','', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                       //'class'=>'span-8',
                       'required'=>true,
                       'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                    ));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    
    <div class="row" id="batch">
            <strong>Select Batch:</strong><br/>
		<?php echo CHtml::dropDownList('batchName','batchName',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                    /*'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('offeredModule/getTerm'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchTerm', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )*/));?>
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
        <div  class="row">
            
            <?php echo CHtml::submitButton('Get List' , array('class' => 'btn btn-info btn-large','data-loading-text'=>'Loading....')); ?>
        </div>
    
     <?php $this->endWidget(); ?>
</div>

