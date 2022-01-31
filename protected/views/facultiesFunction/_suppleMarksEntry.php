
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
            echo CHtml::hiddenField('suppleTerm', yii::app()->session['MainCurTerm']);
            echo CHtml::hiddenField('suppleYear', yii::app()->session['MainCurYear']);
            $examType=Options::getOptions('current_supple_exam_type');
            echo CHtml::hiddenField('suppleType', $examType);
        ?>
    
    
        
	<div class="row">
            <h4><strong>Term: </strong><span class="label label-success" style="font-size: 20px; padding: 10px 10px 10px 20px;"> <?php echo FormUtil::getTerm(yii::app()->session['MainCurTerm']); ?>  </span> <strong>Year: </strong><span class="label label-info" style="font-size: 20px; padding: 10px 10px 10px 20px;"> <?php echo yii::app()->session['MainCurYear']; ?></span></h4>
            
	
	</div>
        <div class="row ">
            <strong> Examination: </strong> 
		<span class="label label-warning" style="font-size: 20px; padding: 10px 10px 10px 20px;">
                <?php echo FormUtil::getExamName( yii::app()->session['suppleType']?yii::app()->session['suppleType']:$examType)?>
                </span>
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