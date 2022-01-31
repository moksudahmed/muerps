<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
    'Department Functions'=>array('offeredModule/index'),
	'Select Module'
);




//echo FormUtil::getTermNumber(3, 2010, 3, 2012).'<br/>';
//echo FormUtil::getTermNumberWithSufix(3, 2010, 3, 2012)

?>






    <div class="title ">
        <div class="span-18">
            <h3 >Print Attendance For: </h3>
            
            
            
            
                <div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form5',
                            'enableAjaxValidation'=>true,
                        'htmlOptions'=>(array('autocomplete'=>'off',)),
                         'action'=>CController::createUrl('termAdmission/getAttStudentList'),
                    )); ?>
                    
                    <?php
                        
                    ?>
                    
                <div class="row" >
            
                    <h4><strong>Term: </strong><span class="label label-success"> <?php echo FormUtil::getTerm(yii::app()->session['attTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['attYear']; ?></span></h4>
                    <h4><strong>Select Course:</strong></h4>

                    <?php echo CHtml::dropDownList('offeredModuleID',yii::app()->session['attOfmID'], 
                        CHtml::listData(FormUtil::getRegisteredModuleNameCode($ofmModule),'offeredModuleID','mod_name','mod_group')
                        ,array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                            'required'=>true
                    )); ?>
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                    <div class="row">
                        <strong>Faculty Name:</strong><br/>
                        <?php echo CHtml::textField('facultyID',yii::app()->session['attFacultyID'],array('required'=>true)); ?>
                </div>
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
                
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="span-7">
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['attBatName'].FormUtil::getBatchNameSufix(yii::app()->session['attBatName']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['attSecName']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['attProCode']); ?></h6>

        </div>
</div>



