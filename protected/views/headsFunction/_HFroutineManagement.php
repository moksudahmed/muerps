
<div class="form">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offerModule-form1',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>(array('autocomplete'=>'off',)),
    
     'action'=>CController::createUrl('routineManagement'),
)); ?>
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
                    'url'=>CController::createUrl('offeredModule/getSection'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName3', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>

        
            
        </div>
        
    <div class="row" id="batch">
            
		
                <strong><?php echo CHtml::encode("Section:") ?></strong>
        <br/>
		<?php echo CHtml::dropDownList('batchName3','batchName',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                        'required'=>'true',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                    /*'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('offeredModule/authOfferedModule'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#authOfferedModule',
                    
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )*/
                      ));?>
                     
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
        
        <div class="row" id="authOfferedModule">
            
        
           <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>
            
        </div>
        <?php $this->endWidget(); ?>

</div>
