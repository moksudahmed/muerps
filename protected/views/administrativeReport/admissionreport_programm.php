<?php
/* @var $this AdmissionController */
/* @var $model Admission */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->studentID,
);

$this->menu=array(
	array('label'=>'List Student', 'url'=>array('index')),
	array('label'=>'Create Student', 'url'=>array('create')),
	array('label'=>'Update Student', 'url'=>array('update', 'id'=>$model->studentID)),
	array('label'=>'Delete Student', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->studentID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Student', 'url'=>array('admin')),
        array('label'=>'Student Attendacne', 'url'=>array('allattendance')),
);
?>

<div class="wide form">

    
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row" id="batch">
            
        
	<div class="row">
		<?php echo $form->labelEx($model,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(Programme::model()->findAll(),
                   'programmeCode','pro_name'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    //'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'programmeCode'); ?>
	</div>
		                
        <div class="row">
		<?php echo $form->labelEx($model,'stu_academicYear'); ?>
		<?php echo CHtml::dropDownList('stu_academicYear','stu_academicYear', CHtml::listData(Student::model()->findAll(),
                   'stu_academicYear','stu_academicYear'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    //'url'=>CController::createUrl('admission/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    //'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'stu_academicTerm'); ?>
	</div>
        
   
	<div class="row">
		<?php echo $form->labelEx($model,'stu_academicTerm'); ?>
		<?php echo CHtml::dropDownList('stu_academicTerm','stu_academicTerm', CHtml::listData(Student::model()->findAll(),
                   'stu_academicTerm','stu_academicTerm'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    //'url'=>CController::createUrl('admission/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                   // 'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'stu_academicTerm'); ?>
	</div>

        
	<div class="row buttons">
		<?php echo CHtml::button('Run Report', array('submit' => array('_admission_report'))); ?>
	</div>
</div>

        
<?php $this->endWidget(); ?>

</div><!-- search-form -->