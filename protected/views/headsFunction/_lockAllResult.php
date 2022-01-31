<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
        'action'=>CController::createUrl('headsFunction/lockPreviousResults'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
    <div class="row" >
            <strong>Locked All Previous Results:</strong>
                <?php echo CHtml::checkBox("locked");?>                      
	</div> 
   
	<div class="row">
            <strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('lockTerm',  (FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',));  ?>
	
	</div>
    
    <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('lockYear',  (FormUtil::getYear()), FormUtil::yearForDropDown(2010), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',));  ?>
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
                        'required'=>false,
                    'ajax' => array(
                    'type'=>'POST', //request type
                  //  'url'=>CController::createUrl('headsFunction/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
              //      'update'=>'#batchName2', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    
    

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->