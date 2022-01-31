
<div class="form">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offerModule-form1',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>(array('autocomplete'=>'off',)),
    
     'action'=>CController::createUrl('sectionTransfer'),
)); ?>
    <div class="row">
        <strong>Term:</strong><br/>
        <?php echo CHtml::radioButtonList('stfTerm',  (yii::app()->session['stfTerm']?yii::app()->session['stfTerm']:yii::app()->session['MainAdmTerm']),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
    </div>    
    <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('stfYear', (yii::app()->session['stfYear']?yii::app()->session['stfYear']:yii::app()->session['MainAdmYear']), FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',));  ?>
	
	
	
		
	
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
                    'url'=>CController::createUrl('getSection'), //url to call.
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
		<?php echo CHtml::dropDownList('batchName3','batchName3',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>'true',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('getNewSection'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#newSection',
                    
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                      ));?>
                     
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
        
        <div class="row" id="newSection2">
            <strong>New Section:</strong><br/>
                    <?php echo CHtml::dropDownList('newSection','newSection', array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>'true',
                    /*'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/newSection'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#newSection',
                    
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )*/
                      ));?>

        
            
        </div>
    
    
        <div class="row buttons">
            <?php 
               // echo CHtml::hiddenField('stfTerm', yii::app()->session['MainAdmTerm']);
               // echo CHtml::hiddenField('stfYear', yii::app()->session['MainAdmYear']);
            ?>
            
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        <?php $this->endWidget(); ?>

</div>
