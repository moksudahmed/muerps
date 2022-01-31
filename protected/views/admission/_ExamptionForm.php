<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'termAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('termAdvising/examption'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
    <div class="row">
        <strong>Term:</strong><br/>
        <?php echo CHtml::radioButtonList('traTerm',  (yii::app()->session['traTerm']?yii::app()->session['traTerm']:yii::app()->session['MainAdmTerm']),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
    </div>    
    <div class="row">
	<strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('traYear', (yii::app()->session['traYear']?yii::app()->session['traYear']:yii::app()->session['MainAdmYear']), FormUtil::yearForDropDown(2008), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',));  ?>
	
	
	
		
	
	</div>

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->