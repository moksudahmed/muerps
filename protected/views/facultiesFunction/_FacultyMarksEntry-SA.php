<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">
        
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'offerModule-form1',
                            'enableAjaxValidation'=>true,
                         'action'=>CController::createUrl('GetRegModuleMarksList'),
                    )); ?>
                    
                    <?php
                        
                    ?>
                    
    	
	<?php 
        
    
        
           // echo CHtml::hiddenField('mreTerm', yii::app()->session['MainCurTerm']);
           // echo CHtml::hiddenField('mreYear', yii::app()->session['MainCurYear']);
        
        ?>
    
                <div class="row">
                            <strong>Term:</strong><br/>
                        <?php echo CHtml::radioButtonList('mreTerm',  (yii::app()->session['mreTerm']?yii::app()->session['mreTerm']:FormUtil::getCurrentTerm()),  ZHtml::$Terms, array('labelOptions'=>array('style'=>'display:inline; font-size:20px; padding-right:10px'), 'separator'=>'  ',));  ?>
                    
                </div>
                <div class="row">
                    <strong>Year:</strong><br/>
                        <?php  echo CHtml::dropDownList('mreYear',  (yii::app()->session['mreYear']?yii::app()->session['mreYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2020), 
                                    array('prompt' => '--Please Select --',
                                        'value' => '0',
                                        'class'=>'span-10',
                                    'style'=>'font-size:20px; height:40px;',
                                        ));  ?>
                </div>
                <div class="row" >
            
                    <h4><strong>Select Module:</strong></h4>

                    <?php echo CHtml::dropDownList('offeredModuleID',yii::app()->session['mreOfmID'], 
                        CHtml::listData(FormUtil::getRegisteredModuleNameCode($ofmModule),'offeredModuleID','mod_name','mod_group')
                        ,array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                            'class'=>'span-14',
                       'style'=>'font-size:20px; height:40px;',
                            'required'=>true
                    )); ?>
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                    
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
                
                <?php $this->endWidget(); ?>
            </div>