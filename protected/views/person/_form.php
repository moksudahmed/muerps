<?php
/* @var $this PersonController */
/* @var $model Person */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'per_title'); ?>
                <?php echo CHtml::activeDropDownList( $model,'per_title',ZHtml::enumItem($model, 'per_title') ); ?>
                <?php echo $form->error($model,'per_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_firstName'); ?>
		<?php echo $form->textField($model,'per_firstName'); ?>
		<?php echo $form->error($model,'per_firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_lastName'); ?>
		<?php echo $form->textField($model,'per_lastName'); ?>
		<?php echo $form->error($model,'per_lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_gender'); ?>
                <?php echo ZHtml::enumRadioButtonList($model,'per_gender',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>     
                <?php echo $form->error($model,'per_gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_nationality'); ?>
		<?php echo $form->textField($model,'per_nationality'); ?>
		<?php echo $form->error($model,'per_nationality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_maritulStatus'); ?>
                <?php echo ZHtml::enumRadioButtonList( $model,'per_maritulStatus',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>
		<?php echo $form->error($model,'per_maritulStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_dateofBirth'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                		array(
                                        'attribute'=>'per_dateofBirth',
                                        'model'=>$model,
                                        'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=>'yy-mm-dd',
                                        'showAnim' => 'slideDown',
                                        ),
                                        'htmlOptions'=>array('size'=>30,'class'=>'date'),
		)
		);?>
		<?php //echo $form->textField($model,'per_dateofBirth'); ?>
		<?php echo $form->error($model,'per_dateofBirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_fathersName'); ?>
		<?php echo $form->textField($model,'per_fathersName'); ?>
		<?php echo $form->error($model,'per_fathersName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'per_husbandsName'); ?>
		<?php echo $form->textField($model,'per_husbandsName'); ?>
		<?php echo $form->error($model,'per_husbandsName'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($model,'per_mothersName'); ?>
		<?php echo $form->textField($model,'per_mothersName'); ?>
		<?php echo $form->error($model,'per_mothersName'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'per_presentAddress'); ?>
		<?php echo $form->textField($model,'per_presentAddress'); ?>
		<?php echo $form->error($model,'per_presentAddress'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'per_postCode'); ?>
		<?php echo $form->textField($model,'per_postCode'); ?>
		<?php echo $form->error($model,'per_postCode'); ?>
	</div>
       
	<div class="row">
		<?php echo $form->labelEx($model,'per_mobile'); ?>
		<?php echo $form->textField($model,'per_mobile'); ?>
		<?php echo $form->error($model,'per_mobile'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($model,'per_email'); ?>
		<?php echo $form->textField($model,'per_email'); ?>
		<?php echo $form->error($model,'per_email'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($model,'per_telephone'); ?>
		<?php echo $form->textField($model,'per_telephone'); ?>
		<?php echo $form->error($model,'per_telephone'); ?>
	</div>
         
	<div class="row">
		<?php echo $form->labelEx($model,'per_bloodGroup'); ?>
                <?php echo ZHtml::enumRadioButtonList($model, 'per_bloodGroup',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
		<?php echo $form->error($model,'per_bloodGroup'); ?>
	</div>
        
        <!--
	 <div class="row"> 
            
		<?php //echo $form->labelEx($model,'per_criminalConviction'); ?>
		<?php //echo $form->textField($model,'per_criminalConviction'); ?>
		<?php //echo $form->error($model,'per_criminalConviction'); ?>
	</div>
        -->
        
	
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'per_englishLanguageProficiency'); ?>
		<?php //echo $form->textField($model,'per_englishLanguageProficiency'); ?>
		<?php //echo $form->error($model,'per_englishLanguageProficiency'); ?>
	</div>
      	<div class="row">
		<?php //echo $form->labelEx($model,'per_parmanentAddress'); ?>
		<?php //echo $form->textField($model,'per_parmanentAddress'); ?>
		<?php //echo $form->error($model,'per_parmanentAddress'); ?>
	</div>
     -->

	
     <!--

	<div class="row">
		<?php //echo $form->labelEx($model,'per_computerLiteracy'); ?>
		<?php //echo $form->textField($model,'per_computerLiteracy'); ?>
		<?php //echo $form->error($model,'per_computerLiteracy'); ?>
	</div>
       
	<div class="row">
		<?php //echo $form->labelEx($model,'per_otherActivities'); ?>
		<?php //echo $form->textField($model,'per_otherActivities'); ?>
		<?php //echo $form->error($model,'per_otherActivities'); ?>
	</div>
       
	
	<div class="row">
		<?php //echo $form->labelEx($model,'per_personalStatment'); ?>
		<?php //echo $form->textField($model,'per_personalStatment'); ?>
		<?php //echo $form->error($model,'per_personalStatment'); ?>
	</div>
                
	<div class="row">
                
                <?php //echo "Convictions".'<input type="checkbox" name="option" value="estado" checked /> ';?>
		<?php //echo $form->labelEx($model,'per_convictionDetails'); ?>
                <?php //echo $form->checkBox($model,'per_convictionDetails','');?>
		<?php //echo $form->textField($model,'per_convictionDetails'); ?>
		<?php //echo $form->error($model,'per_convictionDetails'); ?>
	</div>

         <!--Referees Details --!>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->