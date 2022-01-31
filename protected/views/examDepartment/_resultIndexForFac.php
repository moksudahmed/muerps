
<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examination/reportTabulation'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        <h4><strong>Term: </strong><span class="label label-info"><?php echo FormUtil::getTerm(yii::app()->session['MainCurTerm']); ?> </span><strong> Year: </strong><span class="label label-success"> <?php echo yii::app()->session['MainCurYear'];  ?></span></h4>
	<div class="row">
        
            <?php echo Chtml::hiddenField('resultTerm', yii::app()->session['MainCurTerm']); ?>
            <?php echo Chtml::hiddenField('resultYear', yii::app()->session['MainCurYear']); ?>
        
        </div>
    
        <div class="row ">
            <strong>Examination: </strong> <br/>
		<?php  echo CHtml::radioButtonList('resultType',(yii::app()->session['reType']?yii::app()->session['reType']:1) ,  ZHtml::$ExamType, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ','required'=>true));  ?>
                <?php //echo CHtml::encode('Supplementary'); ?>
                <?php //echo CHtml::hiddenField('exrType', 2); ?>
	</div>
        <div class="row">
            <strong>Programme:</strong><br/>
		<?php //echo $form->labelEx($admission,'programmeCode'); ?>
		<?php echo CHtml::dropDownList('programmeCode','programmeCode', CHtml::listData(FormUtil::getProgrammeByGroupByDepartmentID(yii::app()->session['MainDepartmentID']),
                   'programmeCode','pro_name','group'),array(
                        'prompt' => '--Select Programme--',
                        'value' => '0',
                        'required'=>true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examination/getBatch'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#batchName2', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )));?>
            	<?php //echo $form->error($admission,'programmeCode'); ?>
	</div>
    <div class="row" >
            
	<strong>Batch:</strong><br/>	
		<?php echo CHtml::dropDownList('batchName2','batchName2',array(),array(
                    'prompt' => '--Select Programme First--',
                        'value' => '0',
                        'required' => true,
                    'ajax' => array(
                    'type'=>'POST', //request type
                    'url'=>CController::createUrl('examination/getGroup'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#group', //selector to update
                    //'data'=>'js: $(this).val()' 
                    //leave out the data key to pass all form values through
                    )
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>
    <div class="row" >
    <strong>Major Subject Name:</strong><br/>	
		<?php echo CHtml::dropDownList('group','group',array(),array(
                    'prompt' => '--Select  Batch First--',
                        'value' => '0',
                        'required' => false,
                    
                     ));?>
                    
            	<?php // echo $form->error($admission,'batchName'); ?>
	</div>

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->