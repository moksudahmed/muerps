
<div class="form">
        
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'offerModule-form1',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>(array('autocomplete'=>'off',)),
    
     'action'=>CController::createUrl('examination/PublishResultSwitch'),
)); ?>
        
            <?php echo CHtml::encode("Select group:"); ?>
                
		<?php echo CHtml::dropDownList('publishGroup'.$i,'', CHtml::listData(FormUtil::getOfferedGroupByBatch($batchName,yii::app()->session['rpProCode'],yii::app()->session['rpTerm'],yii::app()->session['rpYear']),
                   'programmeCode','pro_name'),array(
                        'prompt' => '-- All --',
                        'value' => '0',
                    ));?>
            	
                <?php echo CHtml::radioButtonList('publishType'.$i,  (yii::app()->session['publishType']?yii::app()->session['publishType']:1),  array(1=>'Result Sheet',2=>'Tabulation Sheet'), array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));  ?>

     
           <?php  
            echo CHtml::hiddenField('i', $i);
            echo CHtml::hiddenField('batchName'.$i, $batchName);
            echo CHtml::submitButton('Print', array('class' => 'btn btn-success btn-medium','icon'=>'icon-arrow-left'));
           ?>
     
        <?php $this->endWidget(); ?>

</div>
