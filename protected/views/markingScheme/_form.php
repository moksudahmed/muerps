<?php
/* @var $this MarkingSchemeController */
/* @var $model MarkingScheme */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marking-scheme-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_versionNo'); ?>
		<?php echo $form->textField($model,'mrs_versionNo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mrs_versionNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_attendance'); ?>
		<?php echo $form->textField($model,'mrs_attendance'); ?>
		<?php echo $form->error($model,'mrs_attendance'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'mrs_attendancePass'); ?>
		<?php echo $form->textField($model,'mrs_attendancePass'); ?>
		<?php echo $form->error($model,'mrs_attendancePass'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mrs_classTest'); ?>
		<?php echo $form->textField($model,'mrs_classTest'); ?>
		<?php echo $form->error($model,'mrs_classTest'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_classTestPass'); ?>
		<?php echo $form->textField($model,'mrs_classTestPass'); ?>
		<?php echo $form->error($model,'mrs_classTestPass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_midterm'); ?>
		<?php echo $form->textField($model,'mrs_midterm'); ?>
		<?php echo $form->error($model,'mrs_midterm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_midtermPass'); ?>
		<?php echo $form->textField($model,'mrs_midtermPass'); ?>
		<?php echo $form->error($model,'mrs_midtermPass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_final'); ?>
		<?php echo $form->textField($model,'mrs_final'); ?>
		<?php echo $form->error($model,'mrs_final'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_finalPass'); ?>
		<?php echo $form->textField($model,'mrs_finalPass'); ?>
		<?php echo $form->error($model,'mrs_finalPass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_startTerm'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList($model,'mrs_startTerm' ); ?>
		<?php echo $form->error($model,'mrs_startTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_startYear'); ?>
		<?php  echo CHtml::activeDropDownList($model,'mrs_startYear', FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
		<?php echo $form->error($model,'mrs_startYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_endTerm'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList($model,'mrs_endTerm' ); ?>
		<?php echo $form->error($model,'mrs_endTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_endYear'); ?>
		<?php  echo CHtml::activeDropDownList($model,'mrs_endYear', FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
		<?php echo $form->error($model,'mrs_endYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mrs_gradingSchemeName'); ?>
		<?php echo $form->textField($model,'mrs_gradingSchemeName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mrs_gradingSchemeName'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'ex_mrs_default'); ?>
		<?php echo $form->checkBox($model,'ex_mrs_default'); ?>
		<?php echo $form->error($model,'ex_mrs_default'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->