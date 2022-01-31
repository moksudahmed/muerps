<?php
/* @var $this RegistryController */

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exam-form1',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('examRegistration/individualAdmitCardIssue'),
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
       
        <div  class="row">
            
            <?php echo CHtml::submitButton('Continue' , array('class' => 'btn btn-info btn-large','data-loading-text'=>'Loading....')); ?>
        </div>
    
     <?php $this->endWidget(); ?>
</div>

