<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offeredModule-form3',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('termAdmission/termAdmissionAdvance'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
<div class="row ">
	<strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('traTermAdv',  (yii::app()->session['traTermAdv']?yii::app()->session['traTermAdv']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
       
        <div class="row">
            <strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('traYearAdv','' , FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                        'requirte'=>true,
                        'style'=>'font-size:20px; height:40px;',
                        ));  ?>
        </div>
        
	<div class="row">
		<strong> Programme:</strong><br/>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('facultiesFunction/getSection'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#sectionName4', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
        
        <div class="row">
            <strong> Batch:</strong><br/>
            <?php echo CHtml::dropDownList('sectionName4','sectionName4',array(),array(
                        'prompt' => '-- Select  Programme First--',
                        'value' => '0',
                        'class'=>'span-10',
                        'style'=>'font-size:20px; height:40px;',
                        'required' =>true
                    ));?>
            <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>
        </div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->