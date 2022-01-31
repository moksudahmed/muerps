<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

$this->breadcrumbs=array(
        'Exam Registration'=>array('examDepartment/index'),
	'Term Admissions',
	
);


?>
<div class="span-16">
<div class="title">
    <h3>Exam Registration</h3>  
    <h4><strong>Term: </strong><span class="label label-info">  <?php echo FormUtil::getTerm( yii::app()->session['exrTerm']);?></span><span class="label label-success"> <?php echo FormUtil::getExamType(yii::app()->session['exrType']).yii::app()->session['exrYear'];?></span></h4>
</div>
<hr/>

		 <?php if (Yii::app()->user->hasFlash('success')):?>
			<div class="alert in alert-block fade alert-success">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('success')?>
			</div>
		<?php endif;?>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('examRegistration'),
)); ?>

	

	

	<div class="row">
	
            <span>Enter Student ID:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID',
                //'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> $data,
                'options'=>array(
                        'minLength'=>'7',
                    
                    ),
                'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                       ),
            ));
            ?>
            
	</div>
        <div class="row">
            
        </div>
	<div class="row ">
        	<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
<div class="span-8">
    
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'getExamList',
	'enableAjaxValidation'=>true,
           'action'=>CController::createUrl('ExamRegisteredList'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        
	<div class="row" style="padding:126px 0px 0px 0px;">
            <?php echo CHtml::hiddenField('exrTerm', yii::app()->session['exrTerm']); ?>
            <?php echo CHtml::hiddenField('exrYear', yii::app()->session['exrYear']); ?>
            <strong>Select Programme:</strong>
		<?php echo CHtml::dropDownList('programmeCode',yii::app()->session['exrProCode'], CHtml::listData(FormUtil::getProgrammeByGroup(),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                       'class'=>'span-8'
                    ));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
        <div  class="row">
            <?php echo CHtml::submitButton('Get List' , array('class' => 'btn btn-info btn-large','data-loading-text'=>'Loading....')); ?>
        </div>
        
        
<?php $this->endWidget(); ?>

</div>

