<?php
/* @var $this BatchController */
/* @var $model Batch */
/* @var $form CActiveForm */
?>

<div  class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batch-form2',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        
        <div class="row title">
		<?php echo $form->labelEx($model,'batchName'); ?>
		
                <span  class="label label-warning" style="font-size:20px; " > <?php echo $model->batchName.FormUtil::getBatchNameSufix($model->batchName);?> </span>
	
                <?php  echo Chtml::activeHiddenField($model,'batchName',array())?> 
                <?php  echo Chtml::hiddenField('id', 0); ?>
	</div>
        
       <div class="row title">
		<?php echo $form->labelEx($model,'bat_term'); ?>
           <span  class="label label-important" style="font-size:20px; " > <?php  echo FormUtil::getTerm($model->bat_term);?> </span>
		 <?php  echo Chtml::activeHiddenField($model,'bat_term',array())?> 
	
                
	</div>
	
        <div class="row title">
		<?php echo $form->labelEx($model,'bat_year'); ?>
            <span  class="label label-info" style="font-size:20px; " > <?php echo $model->bat_year; ?> </span>
		 <?php  echo Chtml::activeHiddenField($model,'bat_year',array())?> 
	
                
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'syllabusCode'); ?>
            <?php if($flag){echo chtml::activeDropDownList($model,'syllabusCode',Chtml::listData(Syllabus::model()->findAllByAttributes(array('programmeCode'=>yii::app()->session['programmeCode'])),'syllabusCode','syllabusCode') ,array('required'=>true));}
                else{ 
                    ?>
                    <span  class="label label-info" style="font-size:20px; " > <?php echo $model->syllabusCode; ?> </span>
                    <?php
                }
            ?>
            <?php echo $form->error($model,'syllabusCode'); ?>
        </div>


	<div class="row buttons title">
                 <?php 
                    if($flag)
                        { echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....'));}
                    else
                        {
                       ?> 
                        <span  class="label label-important" style="font-size:16px; " >Batch previously Created and in the List..</span>
                       <?php
                        }
                 ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->