<?php
/* @var $this PersonController */
/* @var $persons Person */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>false,
    'id'=>'person-form',
    'stateful'=>true,
));
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($persons); ?>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_title'); ?>
                <?php echo CHtml::activeDropDownList( $persons,'per_title',ZHtml::enumItem($persons, 'per_title') ); ?>
                <?php echo $form->error($persons,'per_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_firstName'); ?>
		<?php echo $form->textField($persons,'per_firstName'); ?>
		<?php echo $form->error($persons,'per_firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_lastName'); ?>
		<?php echo $form->textField($persons,'per_lastName'); ?>
		<?php echo $form->error($persons,'per_lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_gender'); ?>
                <?php echo ZHtml::enumRadioButtonList($persons,'per_gender',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>     
                <?php echo $form->error($persons,'per_gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_nationality'); ?>
		<?php echo $form->textField($persons,'per_nationality'); ?>
		<?php echo $form->error($persons,'per_nationality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_maritulStatus'); ?>
                <?php echo ZHtml::enumRadioButtonList( $persons,'per_maritulStatus',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>
		<?php echo $form->error($persons,'per_maritulStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_dateOfBirth'); ?>
               
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                		array(
                                        'attribute'=>'per_dateOfBirth',
                                        'model'=>$persons,
                                        'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=>'yy-mm-dd',
                                        'showAnim' => 'slideDown',
                                        ),
                                        'htmlOptions'=>array('size'=>30,'class'=>'date'),
		)
		);?>
		
		<?php //echo $form->textField($persons,'per_dateofBirth'); ?>
		<?php echo $form->error($persons,'per_dateOfBirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_fathersName'); ?>
		<?php echo $form->textField($persons,'per_fathersName'); ?>
		<?php echo $form->error($persons,'per_fathersName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($persons,'per_husbandsName'); ?>
		<?php echo $form->textField($persons,'per_husbandsName'); ?>
		<?php echo $form->error($persons,'per_husbandsName'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($persons,'per_mothersName'); ?>
		<?php echo $form->textField($persons,'per_mothersName'); ?>
		<?php echo $form->error($persons,'per_mothersName'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($persons,'per_presentAddress'); ?>
		<?php echo $form->textField($persons,'per_presentAddress'); ?>
		<?php echo $form->error($persons,'per_presentAddress'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($persons,'per_postCode'); ?>
		<?php echo $form->textField($persons,'per_postCode'); ?>
		<?php echo $form->error($persons,'per_postCode'); ?>
	</div>
       
	<div class="row">
		<?php echo $form->labelEx($persons,'per_mobile'); ?>
		<?php echo $form->textField($persons,'per_mobile'); ?>
		<?php echo $form->error($persons,'per_mobile'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($persons,'per_email'); ?>
		<?php echo $form->textField($persons,'per_email'); ?>
		<?php echo $form->error($persons,'per_email'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($persons,'per_telephone'); ?>
		<?php echo $form->textField($persons,'per_telephone'); ?>
		<?php echo $form->error($persons,'per_telephone'); ?>
	</div>
         
	<div class="row">
		<?php echo $form->labelEx($persons,'per_bloodGroup'); ?>
                <?php echo ZHtml::enumRadioButtonList($persons, 'per_bloodGroup',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
		<?php echo $form->error($persons,'per_bloodGroup'); ?>
	</div>
        
        <!--
	 <div class="row"> 
            
		<?php //echo $form->labelEx($persons,'per_criminalConviction'); ?>
		<?php //echo $form->textField($persons,'per_criminalConviction'); ?>
		<?php //echo $form->error($persons,'per_criminalConviction'); ?>
	</div>
        -->
        
	
<!--
	<div class="row">
		<?php //echo $form->labelEx($persons,'per_englishLanguageProficiency'); ?>
		<?php //echo $form->textField($persons,'per_englishLanguageProficiency'); ?>
		<?php //echo $form->error($persons,'per_englishLanguageProficiency'); ?>
	</div>
      	<div class="row">
		<?php //echo $form->labelEx($persons,'per_parmanentAddress'); ?>
		<?php //echo $form->textField($persons,'per_parmanentAddress'); ?>
		<?php //echo $form->error($persons,'per_parmanentAddress'); ?>
	</div>
     -->

	
     <!--

	<div class="row">
		<?php //echo $form->labelEx($persons,'per_computerLiteracy'); ?>
		<?php //echo $form->textField($persons,'per_computerLiteracy'); ?>
		<?php //echo $form->error($persons,'per_computerLiteracy'); ?>
	</div>
       
	<div class="row">
		<?php //echo $form->labelEx($persons,'per_otherActivities'); ?>
		<?php //echo $form->textField($persons,'per_otherActivities'); ?>
		<?php //echo $form->error($persons,'per_otherActivities'); ?>
	</div>
       
	
	<div class="row">
		<?php //echo $form->labelEx($persons,'per_personalStatment'); ?>
		<?php //echo $form->textField($persons,'per_personalStatment'); ?>
		<?php //echo $form->error($persons,'per_personalStatment'); ?>
	</div>
                
	<div class="row">
                
                <?php //echo "Convictions".'<input type="checkbox" name="option" value="estado" checked /> ';?>
		<?php //echo $form->labelEx($persons,'per_convictionDetails'); ?>
                <?php //echo $form->checkBox($persons,'per_convictionDetails','');?>
		<?php //echo $form->textField($persons,'per_convictionDetails'); ?>
		<?php //echo $form->error($persons,'per_convictionDetails'); ?>
	</div>

   

-->
            
              
	<div class="row buttons">
                <?php echo CHtml::submitButton("Cancel", array('name'=>'cancel'));?>
                <?php //echo CHtml::submitButton('Continue', array('name'=>'step1');?>
		<?php echo CHtml::submitButton('Continue', array('name'=>'step1'));?> 
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->