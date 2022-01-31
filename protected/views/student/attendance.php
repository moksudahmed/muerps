<?php
/* @var $this StudentController */
/* @var $model Student */

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

	<div class="row">
		<?php echo $form->labelEx($model,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(Programme::model()->findAll(),
                   'programmeCode','pro_name'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/getBatchByProgrammeCode'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'programmeCode'); ?>
	</div>

        <div class="row" id="batch">
            
		
                <?php  echo $form->labelEx($model,'batchName'); ?>
		<?php echo CHtml::dropDownList('batchName','batchName',array(),array(
                    'prompt' => '--Select Batch--',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('admission/getSectionByProgrammeCode'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#sectionName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'batchName'); ?>
	</div>
           <div class="row">
		<?php echo $form->labelEx($model,'sectionName'); ?>
		<?php echo CHtml::dropDownList('sectionName','sectionName', array(),array(
                    'prompt' => '--Select Section--',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('student/allattendance'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                   // 'update'=>'#form', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'sectionName'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::button('Run Report', array('submit' => array('_attendance'))); ?>
	</div>


        
<?php $this->endWidget(); ?>

</div><!-- search-form -->