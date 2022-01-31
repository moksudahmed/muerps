<?php
/* @var $this ToolsController */
/* @var $model Tools */

?>
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
        'action'=>CController::createUrl('copySyallabus'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	

        <div class="row">
             <span>Old Syllabus Code:</span>
                <?php echo CHtml::textField("old_syllabus", '', array('size'=>20,'maxlength'=>20,'width'=>5,));?>    
        </div>
        <div class="row">
             <span>New Syllabus Code:</span>
                <?php echo CHtml::textField("new_syllabus", '', array('size'=>20,'maxlength'=>20,'width'=>5,));?>    
        </div>
        <div class="row">
            
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



