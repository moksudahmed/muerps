<?php
/* @var $this ProgrammeController */
/* @var $model Programme */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'programme-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php// echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'programmeCode'); ?>
		<?php echo $form->textField($model,'programmeCode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'programmeCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pro_name'); ?>
		<?php echo $form->textField($model,'pro_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'pro_name'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'pro_shortName'); ?>
		<?php echo $form->textField($model,'pro_shortName',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pro_shortName'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'pro_totalTerms'); ?>
		<?php echo $form->textField($model,'pro_totalTerms',array('size'=>2,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'pro_totalTerms'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'pro_startTerm'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList($model, 'pro_startTerm') ?>
                <?php echo $form->error($model,'pro_startTerm'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'pro_startYear'); ?>
            
            
                  <?php echo $form->dropDownList($model,'pro_startYear', FormUtil::yearForDropDown(), 
                 array('options' => array(' '=>array('selected'=>true)))); ?>
                <?php echo $form->error($model,'pro_startYear'); ?>
	</div>



        <div class="row">
		<?php echo $form->labelEx($model,'pro_type'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList($model, 'pro_type',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
        </div>
        <div class="row">
                <?php echo $form->labelEx($model,'pro_medium'); ?>
                <?php echo ZHtml::enumActiveRadioButtonList($model, 'pro_medium',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
		<?php echo $form->error($model,'sch_medium'); ?>
	</div>
        
        
        <div class="row">
		<?php echo $form->labelEx($model,'pro_remarks'); ?>
		<?php echo $form->textArea($model,'pro_remarks',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'pro_remarks'); ?>
	</div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->