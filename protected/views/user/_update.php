<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'action'=>CController::createUrl('user/edit'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
<?php  echo CHtml::hiddenField('userID', $model->userID); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'usr_password'); ?>
		<?php echo $form->textField($model,'usr_password',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'usr_password'); ?>
	</div>




	<div class="row">
		<?php echo $form->labelEx($model,'usr_role'); ?>
		<?php echo ZHtml::enumActiveDropDownList(
                            $model,
                            'usr_role',
                            
                            array()
       
                        ); ?>
		<?php echo $form->error($model,'usr_role'); ?>
	</div>
        
        <div id="type" class="row">
		<?php  echo $form->labelEx($model,'usr_active'); ?>
		<?php echo CHtml::radioButtonList(
                            
                            'usr_active',
                            $model->usr_active,
                            array('f'=>'false','t'=>'true'),
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'usr_active'); ?>
	</div>


	<div class="row buttons">
            
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->