<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admission-form1',
	'enableAjaxValidation'=>true,
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        
	<div class="row">
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
        <!--div class="row" id="batch">
            
		
                <?php /* echo $form->labelEx($admission,'batchName'); ?>
		<?php echo CHtml::dropDownList('batchName','batchName',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/getSection'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#sectionName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($admission,'batchName'); ?>
	</div>
   
        <div class="row">
		<?php echo $form->labelEx($admission,'sectionName'); ?>
		<?php echo CHtml::dropDownList('sectionName','sectionName', array(),array(
                    'prompt' => '--Select Batch First--',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/create'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#form', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($admission,'sectionName'); */?>
	</div-->
        <div id="batchName" class="row">
            
        </div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->