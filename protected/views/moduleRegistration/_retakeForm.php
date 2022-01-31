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
    'action'=>CController::createUrl('moduleRegistration/saveRetake'),
)); ?>

	

	

	<div class="row">
	
            <h5>Select Module:</h5>
            <span class="span-17">
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'offeredModuleID',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> $value,
                'options'=>array(
                        'minLength'=>'3',
                    
                    ),
                'htmlOptions'=>array('class'=>'span-16','style'=>'min-height:0px;','required'=>true,
                       ),
            ));
            ?>
                </span>
	
		<?php echo CHtml::submitButton('Save', array('class' => 'btn btn-medium btn-success','style'=>'width:150px;','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->