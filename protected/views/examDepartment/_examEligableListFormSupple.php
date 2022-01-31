<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'allAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('examDepartment/ExamEligibleListSupple'),
)); ?>

	

	<?php 
        
        //$models = Programme::model()->findAll();
        
        
        
        ?>
    
        
	<div class="row">
            <strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('eligibleTerm',  (yii::app()->session['eligibleTerm']?yii::app()->session['eligibleTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>
    
        <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('eligibleYear',  (yii::app()->session['eligibleYear']?yii::app()->session['eligibleYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2010), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',));  ?>
        </div>
        <div class="row ">
            <strong>Examination: </strong> <br/>
		<?php  echo CHtml::radioButtonList('exrType',(yii::app()->session['exrType']?yii::app()->session['exrType']:FormUtil::getSuppleExamType()) ,  ZHtml::enumItem('exm_supple_type'), array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ','required'=>true));  ?>
                <?php //echo CHtml::encode('Supplementary'); ?>
                <?php //echo CHtml::hiddenField('exrType', 2); ?>
	</div>	

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->