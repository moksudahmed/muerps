<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('headsFunction/courseAuthentication'),
)); ?>

	

	
	<?php 
        
    
        
//        echo CHtml::hiddenField('caTerm', yii::app()->session['MainCurTerm']);
  //      echo CHtml::hiddenField('caYear', yii::app()->session['MainCurYear']);
        
        ?>
    
        <!--h4><strong>Term: </strong><span class="label label-success"> <?php // echo FormUtil::getTerm(yii::app()->session['MainCurTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php // echo yii::app()->session['MainCurYear']; ?></span></h4-->

   
    
	<div class="row">
            <strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('caTerm',  (yii::app()->session['caTerm']?yii::app()->session['caTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>
    
        <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('caYear',  (yii::app()->session['caYear']?yii::app()->session['caYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',));  ?>
        </div>
    
        <div class="row">
            <strong>Programme:</strong><br/>
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode',yii::app()->session['caProCode'], CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                       'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'required'=>true,
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