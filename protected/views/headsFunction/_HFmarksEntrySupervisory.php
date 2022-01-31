<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formMarksEntyr-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('headsFunction/GetRegisteredModuleForSpecialRetake'),
    'htmlOptions'=>(array('autocomplete'=>'off',)),
)); ?>

	
	<?php //echo yii::app()->session['mestTerm'] ?>
<div class="row ">
            <strong>Examination: </strong>Final
		
            
	</div>
        <div class="row ">
	<strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('mestTerm',  (yii::app()->session['mestTerm']?yii::app()->session['mestTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',));  ?>
            
	</div>
        
        <div class="row">
            <strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('mestYear', (yii::app()->session['mestYear']?yii::app()->session['mestYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        //'class'=>'span-4',
                        
                        ));  ?>
        </div>
    <div  class="row">
            <strong><?php echo CHtml::encode("Programme:"); ?></strong><br/>
                
		<?php echo CHtml::dropDownList('mestProCode',yii::app()->session['mestProCode'], CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                  ));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>

            
            
        </div>
        <div id="proCode" class="row">
               <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?> 
	</div>

        

		
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->