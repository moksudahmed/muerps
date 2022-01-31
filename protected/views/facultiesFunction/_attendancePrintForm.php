<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form1',
                            'enableAjaxValidation'=>true,
                         'action'=>CController::createUrl('RoutineAttendance'),
                    )); ?>
                    
                    <?php
                        
                    ?>
                    
    	
	<?php 
        
    
        
            echo CHtml::hiddenField('atrTerm', yii::app()->session['MainAdmTerm']);
            echo CHtml::hiddenField('atrYear', yii::app()->session['MainAdmYear']);
        
        ?>
    
    
                <div class="row" >
            
                    <h4><strong>Term: </strong><span class="label label-success" style="font-size: 20px; padding: 10px 10px 10px 20px;"> <?php echo FormUtil::getTerm(yii::app()->session['MainAdmTerm']); ?>  </span> <strong>Year: </strong><span class="label label-info" style="font-size: 20px; padding: 10px 10px 10px 20px;"> <?php echo yii::app()->session['MainAdmYear']; ?></span></h4>
                  

                   
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                    
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
                
                <?php $this->endWidget(); ?>
            </div>