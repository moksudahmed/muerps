<?php
/* @var $this StudentController */
/* @var $model Student */
$this->breadcrumbs=array(
    'registry'=>array('site/registry'),
    'School'=>array('school/index'),
        'Department'=>array('Department/index', 'id'=> Yii::app()->session['schoolID']),
	'Programme'=>array('Programme/index', 'id'=>Yii::app()->session['departmentID']),
	'Syllabus',
);

$this->menu=array(
	array('label'=>'Create Syllabus', 'url'=>array('create')),
	array('label'=>'Manage Syllabus', 'url'=>array('admin')),
        array('label'=>'Syllabus Print', 'url'=>array('syllabusprint')),
      array('label'=>'Back to Programme', 'url'=>array('Programme/index', 'id'=>Yii::app()->session['departmentID'])),
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
                    'url'=>CController::createUrl('syllabus/getSyllabusVersion'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'programmeCode'); ?>
	</div>

    <div class="row">
            <?php echo $form->labelEx($model,'syllabusCode'); ?>
		<?php echo CHtml::dropDownList('syllabusCode','syllabusCode', CHtml::listData(Syllabus::model()->findAll(),
                   'syllabusCode','syllabusCode'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    'ajax' => array(
                    'type'=>'POST', //request type
                    //'url'=>CController::createUrl('syllabus/getSyllabusVersion'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php echo $form->error($model,'syllabusCode'); ?>
        
	</div>
           
	<div class="row buttons">
		<?php echo CHtml::button('Run Report', array('submit' => array('_print_syllabus'))); ?>
	</div>


        
<?php $this->endWidget(); ?>

</div><!-- search-form -->