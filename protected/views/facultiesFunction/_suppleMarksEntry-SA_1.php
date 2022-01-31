
<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('facultiesFunction/SuppleModuleMarksList'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        
	<div class="row">
            <strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('suppleTerm',  (yii::app()->session['suppleTerm']?yii::app()->session['suppleTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>
    
    <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('suppleYear',  (yii::app()->session['suppleYear']?yii::app()->session['suppleYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        ));  ?>
        </div>
        <div class="row">
            <strong>Programme:</strong><br/>
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode3','programmeCode3', CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('facultiesFunction/getSuppleCourse'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#moduleCode', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    
            
    <div class="row" >
    <strong>Course:</strong><br/>	
		<?php echo CHtml::dropDownList('moduleCode','moduleCode',array(),array(
                    'prompt' => '--Select  Programme First--',
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