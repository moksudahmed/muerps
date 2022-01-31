<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
                    <h4><strong>Term:</strong></h4>

                    <?php echo CHtml::dropDownList('ofmTermYear',yii::app()->session['batTermOfm'].'-'.yii::app()->session['batYearOfm'], CHtml::listData(FormUtil::getOfferedModuleTerm(yii::app()->session['secNameOfm'],yii::app()->session['batNameOfm'],yii::app()->session['proCodeOfm']),
                   'ofmTermYear','ofm_term','group'),array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                    ));?>
                    <?php // echo $form->error($admission,'batchName'); ?>
                </div>
                <div class="row">
                 <?php echo   CHtml::radioButtonList('ofmType',yii::app()->session['ofmType'] , array('0'=>'All Section','1'=>'Individual Section'), array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>
                </div>
                <div class="row" >

                    <?php  
                     echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large'));
                    ?>
                </div>
 