<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offeredModule-form3',
	'enableAjaxValidation'=>true,
    'action'=>CController::createUrl('administrativeReport/studentsConsecutiveCGPA'),
)); ?>

	

	<?php //echo $form->errorSummary($admission); ?>
<div class="row ">
	<strong>Term:</strong><br/>
		<?php echo CHtml::radioButtonList('attTerm',  (yii::app()->session['attTerm']?yii::app()->session['attTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>
            
	</div>
        <div class="row">
            <strong>Year:</strong><br/>
		<?php  echo CHtml::dropDownList('attYear','' , FormUtil::yearForDropDown(2003), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'requirte'=>true
                        //'class'=>'span-4',
                        ));  ?>
        </div>
        
	
        <div class="row">
           
            <?php  
            echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
           ?>
        </div>
        
        
<?php $this->endWidget(); ?>

</div><!-- form -->