<?php
/* @var $this SyllabusController */
/* @var $model Syllabus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'syllabus-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	

	
        <div class="row ">
		<?php echo $form->labelEx($model,'syllabusCode'); ?>
		<?php echo $form->textField($model,'syllabusCode'); ?>
		<?php echo $form->error($model,'syllabusCode'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'syl_version'); ?>
		<?php echo $form->textField($model,'syl_version'); ?>
		<?php echo $form->error($model,'syl_version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'syl_startTerm'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList($model,'syl_startTerm' ); ?>
                <?php echo $form->error($model,'syl_startTerm'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'syl_startYear'); ?>
            
            
                  <?php  echo CHtml::activeDropDownList($model,'syl_startYear', FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
                    <?php// echo ZHtml::enumActiveDropDownList($model, 'syl_startTerm', $htmlOptions); ?>
                <?php echo $form->error($model,'syl_startYear'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'syl_maxCreditHour'); ?>
		<?php echo $form->textField($model,'syl_maxCreditHour',array('size'=>1,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'syl_maxCreditHour'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'syl_minMonth'); ?>
		<?php echo $form->textField($model,'syl_minMonth',array('size'=>1,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'syl_minMonth'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'syl_maxCGPA'); ?>
		<?php echo $form->textField($model,'syl_maxCGPA',array('size'=>1,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'syl_maxCGPA'); ?>
	</div>

	

        <div class="row">
		<?php echo $form->labelEx($model,'syl_minCGPA'); ?>
		<?php echo $form->textField($model,'syl_minCGPA',array('size'=>1,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'syl_minCGPA'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'syl_endTerm'); ?>
		<?php echo $form->radioButtonList(
                            $model,
                            'syl_endTerm',
                            array('1'=>'Spring','2'=>'Summer','3'=>'Autumn'),
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'syl_endTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'syl_endYear'); ?>
		
                  <?php echo $form->dropDownList($model,'syl_endYear', FormUtil::yearForDropDown(), 
                 array('prompt' => '--Please Select --',
                        'value' => '0',)); ?>
		<?php echo $form->error($model,'syl_endYear'); ?>
	</div>
        
	

        <div class="row">
		<?php echo $form->labelEx($model,'syl_approvedDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
		array(
        'attribute'=>'syl_approvedDate',
        'model'=>$model,
        'options' => array(
                          'mode'=>'focus',
                          'dateFormat'=>'yy-mm-dd',
                          'showAnim' => 'slideDown',
                          ),
			'htmlOptions'=>array('size'=>10,'class'=>'date'),
		)
		);?>
		<?php echo $form->error($model,'syl_approvedDate'); ?>
	</div>
        
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->