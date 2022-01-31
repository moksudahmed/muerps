<?php
/* @var $this ExaminationController */
/* @var $model Examination */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'examination-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	

	<div class="row">
		<?php echo $form->labelEx($model,'exm_examTerm'); ?>
		<?php echo ZHtml::enumActiveRadioButtonList($model,'exm_examTerm'); ?>
            
		<?php echo $form->error($model,'exm_examTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exm_examYear'); ?>
		<?php  echo CHtml::activeDropDownList($model,'exm_examYear', FormUtil::yearForDropDown(), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',));  ?>
		<?php echo $form->error($model,'exm_examYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exm_startDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                            'attribute'=>'exm_startDate',
                            'model'=>$model,
                            'options' => array(
                          'mode'=>'focus',
                          'dateFormat'=>'yy-mm-dd',
                          'showAnim' => 'slideDown',
                          ),
			'htmlOptions'=>array('size'=>10,'class'=>'date'),
		)
		);?>
		<?php echo $form->error($model,'exm_startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exm_endDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                    'attribute'=>'exm_endDate',
                    'model'=>$model,
                    'options' => array(
                          'mode'=>'focus',
                          'dateFormat'=>'yy-mm-dd',
                          'showAnim' => 'slideDown',
                          ),
			'htmlOptions'=>array('size'=>10,'class'=>'date'),
		)
		);?>
		<?php echo $form->error($model,'exm_endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exm_resultDate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                    'attribute'=>'exm_resultDate',
                    'model'=>$model,
                    'options' => array(
                          'mode'=>'focus',
                          'dateFormat'=>'yy-mm-dd',
                          'showAnim' => 'slideDown',
                          ),
			'htmlOptions'=>array('size'=>10,'class'=>'date'),
		)
		);?>
		<?php echo $form->error($model,'exm_resultDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->