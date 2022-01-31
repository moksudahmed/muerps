<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('administrativeReport/reportAllAdmission'),
)); ?>

	

	<?php 
        
        $models = Programme::model()->findAll();
        
        
        
        ?>
        <div class="row">
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                       'required'=>true,
                    /*'ajax' => array(
                    'type'=>'POST', //request type
                    //'url'=>CController::createUrl('admission/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    //'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )*/));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
        <div class="row">
	
		<?php  echo CHtml::dropDownList('reportYear',  FormUtil::getYear(), FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
	
	
	
		<?php echo CHtml::radioButtonList('reportTerm',  FormUtil::getCurrentTerm(),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->