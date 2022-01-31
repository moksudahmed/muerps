<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'termAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examRegistration/index'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        <div class="row ">
	<strong>Term: </strong>
		<?php echo CHtml::radioButtonList('exrTerm',  (yii::app()->session['exrTerm']?yii::app()->session['exrTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
        
        <div class="row">
	<strong>Year: </strong>
		<?php  echo CHtml::dropDownList('exrYear',  (yii::app()->session['exrYear']?yii::app()->session['exrYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        'class'=>'span-3'));  ?>
                        
	</div>
    <div class="row ">
            <strong>Examination: </strong> 
		<?php // echo CHtml::radioButtonList('exrType',(yii::app()->session['exrType']?yii::app()->session['exrType']:'Supplementary') ,  ZHtml::$ExamType, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ','required'=>true));  ?>
                <?php echo CHtml::encode('Supplementary'); ?>
                <?php echo CHtml::hiddenField('exrType', 2); ?>
	</div>

		
        

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->