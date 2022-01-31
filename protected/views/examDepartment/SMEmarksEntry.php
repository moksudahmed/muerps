<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

    $this->breadcrumbs=array(
	'Exam Department'=>array('examDepartment/index'),
	
    
        'Supple Marks Entry For'
);




?>

<div class="title span-12">
<h3 class="span-12">Supple Marks Entry For:</h3>    
    <h4>  <span class="label label-warning"><?php echo FormUtil::getTerm( yii::app()->session['exrEntTerm'])?> </span><span class="label label-info"><?php echo FormUtil::getExamType(2); ?></span><span class="label label-success"> <?php echo yii::app()->session['exrEntYear'];?></span></h4>
</div>
<hr/>


		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
	<?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-warning">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>




    <div class="span-12">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'exam-registratin-supple',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'action'=>CController::createUrl('examDepartment/SMEstudentList'),
        )); ?>
       <div class="row" >
            
            <strong>Select Programme:</strong>
            <br/>
		<?php echo CHtml::dropDownList('programmeCode','', CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       //'class'=>'span-8',
                       'required'=>true,
                       'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examDepartment/SMEgetModules'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#offeredModuleID', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                    ));?>
       </div>
       <div class="row" id="offeredModuleID">     
       </div>
       <div class="row" id="studentID">     
       </div> 

	
        <?php $this->endWidget(); ?>
     
        </div>