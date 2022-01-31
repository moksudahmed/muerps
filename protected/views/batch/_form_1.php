<?php
/* @var $this BatchController */
/* @var $model Batch */
/* @var $form CActiveForm */
?>

<div  class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batch-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

       
	
        <div class="row">
            
		<?php echo $form->labelEx($model,'bat_term'); ?>
		<?php 
                $model->bat_term=  FormUtil::getCurrentTerm();
                
                echo $form->RadioButtonList(
                            $model,
                            'bat_term',
                            array('1'=>'Spring','2'=>'Summer','3'=>'Autumn'),
                            array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',) 
       
                        ); ?>
		<?php echo $form->error($model,'bat_term'); ?>
	</div>
	<div class="row">
            
		<?php echo $form->labelEx($model,'bat_year'); ?>
		<?php echo $form->dropDownList($model,'bat_year', FormUtil::yearForDropDown(), 
                 array('options' => array(FormUtil::getYear()=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'bat_year'); ?>
	</div>

        <div class="row buttons">
		<?php echo CHtml::ajaxButton('Get Batch Name', 
                $this->createUrl('batch/create', array("id" => 1)), 
                array(// these are ajax options
                
                'data' => array('term'=>'js: $("#Batch_bat_term input[type=\'radio\']:checked").val()',
                    'year'=> 'js: $("#Batch_bat_year option:selected").val()',
                    ),
                // and don't use semi-colon after val(), you can also pass id here itself
                'update' => '#dataToUpdate',
                    
                    ),array('class' => 'btn btn-primary btn-large',)
                ); ?>
	</div>
        
        
        

<?php $this->endWidget(); ?>

</div><!-- form -->