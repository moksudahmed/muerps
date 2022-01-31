
<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('tools/deleteModuleRegistration'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        
	<div class="row">
            <strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('resultTerm',  (yii::app()->session['reTerm']?yii::app()->session['reTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>
    
        <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('resultYear',  (yii::app()->session['reYear']?yii::app()->session['reYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2008), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        ));  ?>
        </div>
    
        <div class="row ">
            <strong>Examination: </strong> <br/>
		<?php  echo CHtml::radioButtonList('resultType',(yii::app()->session['reType']?yii::app()->session['reType']:1) ,  ZHtml::enumItem('exm_type'), array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true));  ?>
                <?php //echo CHtml::encode('Supplementary'); ?>
                <?php //echo CHtml::hiddenField('exrType', 2); ?>
	</div>
        <div class="row">
            <strong>Programme:</strong><br/>
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examination/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName2', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    <div class="row" >
            
	<strong>Batch:</strong><br/>	
		<?php echo CHtml::dropDownList('batchName2','batchName2',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required' => true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('tools/getGroup'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#moduleCode', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
    <div class="row" >
    <strong>Subject Name:</strong><br/>	
		<?php echo CHtml::dropDownList('moduleCode','moduleCode',array(),array(
                    'prompt' => '--Select Course --',
                        'value' => '0',
                    'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required' => false,
                    
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
        
		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->