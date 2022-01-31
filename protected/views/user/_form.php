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
    
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row">
            <strong>Owner </strong><br/>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getFacultyByDepartmentTwo(),
                   'id','text','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                        'required'=>true,
                    ));?>
		<?php echo $form->error($model,'usr_role'); ?>
	</div>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->