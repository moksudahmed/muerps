<?php
/* @var $this BatchController */
/* @var $model Batch */
/* @var $form CActiveForm */
?>

<div  class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batch-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

       <div class="row">
		<?php echo $form->labelEx($model,'bat_term'); ?>
		<?php echo $form->radioButtonList(
                            $model,
                            'bat_term',
                            array('1'=>'Spring','2'=>'Summer','3'=>'Autumn'),
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'bat_term'); ?>
                
	</div>
	
        <div class="row">
		<?php echo $form->labelEx($model,'bat_year'); ?>
		<?php echo $form->textField($model,'bat_year',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'bat_year'); ?>
                
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'batchName'); ?>
		<?php echo $form->textField($model,'batchName',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'batchName'); ?>
                <?php  echo Chtml::hiddenField('id', 0); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'syllabusCode'); ?>
		<?php //echo chtml::activeDropDownList($model,'syllabusCode',chtml::listData(Syllabus::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['programmeCode'])),'syllabusCode','syllabusCode') ,array('prompt' => '-- Select --','value' => NULL,'required'=>true)); ?>
            <?php echo chtml::activeDropDownList($model,'syllabusCode',chtml::listData(Syllabus::model()->findAll(),'syllabusCode','syllabusCode') ,array('prompt' => '-- Select --','value' => NULL,'required'=>true)); ?>
		<?php echo $form->error($model,'syllabusCode'); ?>
                
	</div>

        <div class="row">
                <?php echo $form->labelEx($model,'feesStructure'); ?>
		<?php //echo chtml::activeDropDownList($model,'syllabusCode',chtml::listData(Syllabus::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['programmeCode'])),'syllabusCode','syllabusCode') ,array('prompt' => '-- Select --','value' => NULL,'required'=>true)); ?>
                
                    
                    <?php
                        
                    echo chtml::activeDropDownList($model,'feesName',chtml::listData($fees,'feesName','feesTitle') ,array('prompt' => '-- Select --','required'=>true)); ?>
		<?php echo $form->error($model,'feesName'); ?>
                
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->