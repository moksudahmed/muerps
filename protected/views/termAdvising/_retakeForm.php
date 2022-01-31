<?php
/* @var $this ModuleRegistrationController */
/* @var $model ModuleRegistration */
/* @var $form CActiveForm */
?>
<br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-registration-form',
	'enableAjaxValidation'=>false,
    'action'=>CController::createUrl('moduleRegistration/retake'),
)); ?>

	

	

	<div class="row">
	
            <span>Select Module:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'offeredModuleID',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> $value,
                'options'=>array(
                        'minLength'=>'3',
                    
                    ),
                'htmlOptions'=>array('style'=>'width:400px;','required'=>true,
                       ),
            ));
            ?>
            
	
		<?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary ','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->