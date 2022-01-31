<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */

    $this->breadcrumbs=array(
	'Exam Department'=>array('examDepartment/index'),
	
    
        'Exam Registration For'=>array('examRegistration/examRegistrationSupple'),
        'Select Student Id'
);




?>

<div class="title span-12">
<h3 class="span-12">Exam Registration For:</h3>    
    <h4>  <span class="label label-warning"><?php echo FormUtil::getTerm( yii::app()->session['exrTerm'])?> </span><span class="label label-info"><?php echo FormUtil::getExamType(yii::app()->session['exrType']); ?></span><span class="label label-success"> <?php echo yii::app()->session['exrYear'];?></span></h4>
</div>
<hr/>


		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
	





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

<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'exam-registratin-supple',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'action'=>CController::createUrl('examRegistration/registerSuppleExam'),
        )); ?>
	
            <strong>Enter Student ID:</strong>
		<br/>
                
                <?php 
                
          
            //print_r($data2);
            //exit();
               
                ?>
              <?php echo CHtml::dropDownList('tmID','', CHtml::listData($data,
                   'tmID','studentID'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       //'class'=>'span-8',
                       'required'=>true,
                       'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examRegistration/getModules'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#offeredModuleID', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                    ));?>
<br/>

<?php 
                            //echo CHtml::ajaxLink('save', CController::createUrl('examRegistration/saveTest'),array('class'=>'btn btn btn-danger','style'=>'display:none;','data-toggle'=>'tooltip','title'=>'Save Marks','id'=>'save-',));
                       // echo  CHtml::ajaxSubmitButton('Student Id', CController::createUrl('examRegistration/getStudentID'), array('update'=>'#studentID'),array('class'=>'btn btn-large btn-info','style'=>'','data-toggle'=>'tooltip','title'=>'Save Marks',));
                 echo  CHtml::submitButton('Register', array('class'=>'btn btn-large btn-info','style'=>'',)).' ';
                 echo  CHtml::link('Registered List',array('examRegistration/examRegisteredSuppleList'), array('class'=>'btn btn-large btn-success','style'=>''));
                        ?>
            <?php $this->endWidget(); ?>
