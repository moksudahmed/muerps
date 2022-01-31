<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php  echo $form->errorSummary($student); ?>
        <?php  echo $form->errorSummary($person); ?>
        <div class="row">
		<?php  echo $form->labelEx($student,'studentID'); ?>
		<?php echo $form->textField($student,'studentID',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($student,'studentID'); ?>
	</div>

        	<div class="row">
		<?php echo $form->labelEx($student,'stu_previousID'); ?>
		<?php echo $form->textField($student,'stu_previousID',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($student,'stu_previousID'); ?>
	</div>

	<div class="row">
		<?php  echo $form->labelEx($student,'stu_previousDegree'); ?>
		<?php echo $form->textField($student,'stu_previousDegree',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($student,'stu_previousDegree'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($person,'per_title'); ?>
                <?php echo CHtml::activeDropDownList( $person,'per_title',ZHtml::enumItem($persons, 'per_title') ); ?>
                <?php echo $form->error($person,'per_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_firstName'); ?>
		<?php echo $form->textField($person,'per_firstName'); ?>
		<?php echo $form->error($person,'per_firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_lastName'); ?>
		<?php echo $form->textField($person,'per_lastName'); ?>
		<?php echo $form->error($person,'per_lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_gender'); ?>
                <?php echo ZHtml::enumRadioButtonList($person,'per_gender',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>     
                <?php echo $form->error($person,'per_gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_nationality'); ?>
		<?php echo $form->textField($person,'per_nationality'); ?>
		<?php echo $form->error($person,'per_nationality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_maritulStatus'); ?>
                <?php echo ZHtml::enumRadioButtonList( $person,'per_maritulStatus',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>
		<?php echo $form->error($person,'per_maritulStatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_dateofBirth'); ?>
               
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                		array(
                                        'attribute'=>'per_dateofBirth',
                                        'model'=>$person,
                                        'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=>'yy-mm-dd',
                                        'showAnim' => 'slideDown',
                                        ),
                                        'htmlOptions'=>array('size'=>30,'class'=>'date'),
		)
		);?>
		
		<?php //echo $form->textField($persons,'per_dateofBirth'); ?>
		<?php echo $form->error($person,'per_dateofBirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_fathersName'); ?>
		<?php echo $form->textField($person,'per_fathersName'); ?>
		<?php echo $form->error($person,'per_fathersName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($person,'per_husbandsName'); ?>
		<?php echo $form->textField($person,'per_husbandsName'); ?>
		<?php echo $form->error($person,'per_husbandsName'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($person,'per_mothersName'); ?>
		<?php echo $form->textField($person,'per_mothersName'); ?>
		<?php echo $form->error($person,'per_mothersName'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($person,'per_presentAddress'); ?>
		<?php echo $form->textField($person,'per_presentAddress'); ?>
		<?php echo $form->error($person,'per_presentAddress'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($person,'per_postCode'); ?>
		<?php echo $form->textField($person,'per_postCode'); ?>
		<?php echo $form->error($person,'per_postCode'); ?>
	</div>
       
	<div class="row">
		<?php echo $form->labelEx($person,'per_mobile'); ?>
		<?php echo $form->textField($person,'per_mobile'); ?>
		<?php echo $form->error($person,'per_mobile'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($person,'per_email'); ?>
		<?php echo $form->textField($person,'per_email'); ?>
		<?php echo $form->error($person,'per_email'); ?>
	</div>

         <div class="row">
		<?php echo $form->labelEx($person,'per_telephone'); ?>
		<?php echo $form->textField($person,'per_telephone'); ?>
		<?php echo $form->error($person,'per_telephone'); ?>
	</div>
         
	<div class="row">
		<?php echo $form->labelEx($person,'per_bloodGroup'); ?>
                <?php echo ZHtml::enumRadioButtonList($person, 'per_bloodGroup',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
		<?php echo $form->error($person,'per_bloodGroup'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($student,'stu_academicTerm'); ?>
		<?php echo $form->textField($student,'stu_academicTerm',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($student,'stu_academicTerm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($student,'stu_academicYear'); ?>
		<?php echo $form->textField($student,'stu_academicYear'); ?>
		<?php echo $form->error($student,'stu_academicYear'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($student->isNewRecord ? 'Continue' : 'Save');  ?>
	</div>

<?php $this->endWidget();  ?>

</div><!-- form -->