<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'termAdmission-form1',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('termAdvising/index'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>

        <div class="row">
	
		<?php  echo CHtml::dropDownList('traYear', (yii::app()->session['traYear']?yii::app()->session['traYear']:FormUtil::getYear()), FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
	
	
	
		<?php echo CHtml::radioButtonList('traTerm',  (yii::app()->session['traTerm']?yii::app()->session['traTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
	
	</div>

		
        <div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->