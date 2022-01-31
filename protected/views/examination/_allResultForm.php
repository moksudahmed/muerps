
<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examination/reportTabulation'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        <div class="row">
	
		<?php  echo CHtml::dropDownList('resultYear',  (yii::app()->session['reYear']?yii::app()->session['reYear']:FormUtil::getYear()), FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
	
	
	
		<?php echo CHtml::radioButtonList('resultTerm',  (yii::app()->session['reTerm']?yii::app()->session['reTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>
    
        <div class="row">
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                        'required'=>true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examination/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    <div class="row" >
            
		
		<?php echo CHtml::dropDownList('batchName','batchName',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                        'required' => true,
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
    
    

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->