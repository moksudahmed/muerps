<?php
/* @var $this BatchController */
/* @var $model Batch */
/* @var $form CActiveForm */
?>

<div  class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batch-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

       
	
        <div class="row">
            
		<?php echo $form->labelEx($model,'bat_term'); ?>
		<?php 
                $model->bat_term=  FormUtil::getCurrentTerm();
                
                echo $form->RadioButtonList(
                            $model,
                            'bat_term',
                            array('1'=>'Spring','2'=>'Summer','3'=>'Autumn'),
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'bat_term'); ?>
	</div>
	<div class="row">
            
		<?php echo $form->labelEx($model,'bat_year'); ?>
		<?php echo $form->dropDownList($model,'bat_year', FormUtil::yearForDropDown(2003), 
                 array('options' => array(FormUtil::getYear()=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'bat_year'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'syllabusCode'); ?>
		<?php //echo chtml::activeDropDownList($model,'syllabusCode',chtml::listData(Syllabus::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['programmeCode'])),'syllabusCode','syllabusCode') ,array('prompt' => '-- Select --','value' => NULL,'required'=>true)); ?>
                
                    
                    <?php
                        
                    echo chtml::activeDropDownList($model,'syllabusCode',chtml::listData($syllabus,'syllabusCode','syllabusCode') ,array('prompt' => '-- Select --','value' => NULL,'required'=>true)); ?>
		<?php echo $form->error($model,'syllabusCode'); ?>
                
	</div>
        <div class="row">
                <?php echo $form->labelEx($model,'feesStructure'); ?>
		<?php //echo chtml::activeDropDownList($model,'syllabusCode',chtml::listData(Syllabus::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['programmeCode'])),'syllabusCode','syllabusCode') ,array('prompt' => '-- Select --','value' => NULL,'required'=>true)); ?>
                
                    
                    <?php
                        
                    echo chtml::activeDropDownList($model,'feesName',chtml::listData($fees,'feesName','feesTitle') ,array('prompt' => '-- Select --','value' => NULL,'required'=>false)); ?>
		<?php echo $form->error($model,'feesName'); ?>
                
	</div>
        
	<div class="row buttons">
		<?php 
                echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>	
        
        
        
        

<?php $this->endWidget(); ?>

</div><!-- form -->