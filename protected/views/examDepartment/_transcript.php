<?php
/* @var $this TermAdmissionController */
/* @var $model TermAdmission */

?>
		 <?php if (Yii::app()->user->hasFlash('warning')):?>
			<div class="alert in alert-block fade alert-danger">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <?php echo Yii::app()->user->getFlash('warning')?>
			</div>
		<?php endif;?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'action'=>CController::createUrl('transcript'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	

	<div class="row">
	
            <span>Enter Student ID:</span>
		
                <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                 
                'name'=>'studentID',
               // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                'source'=> $data,
                'options'=>array(
                        'minLength'=>'7',
                    
                    ),
                'htmlOptions'=>array('required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111]',
                    'class'=>'span-6',
                       'style'=>'font-size:20px; height:25px;',   
                    ),
            ));
            ?>
             
	</div>
        <div class="row">
             <span>No of line per page:</span>
                <?php echo CHtml::textField("lines", '', array('size'=>2,'maxlength'=>2,'width'=>5,));?>    
              <span>Range (22 - 28)</span>
        </div>
        <div class="row" >
            <strong>Old Date:</strong>
                <?php echo CHtml::checkBox("passYear");?>                      
	</div>
         <div class="row" >
            <strong>Absolute CGPA:</strong>
                <?php echo CHtml::checkBox("absoluteCGPA");?></br>                      
               <strong><?php echo "N.B. This option may be use for issued certificate where CGPA is not possible to change otherwise please keep it unchecked.";?></strong>
            
	</div>
    <div class="row" >
            <strong>Customize Passing Year:</strong>
                <?php echo CHtml::checkBox("customPassYear");?>                      
	</div>
    <div class="row">
    <strong>Passing Year:</strong>
		<?php  echo CHtml::dropDownList('resultYear',  (yii::app()->session['tarYear']?yii::app()->session['tarYear']:FormUtil::getYear()), FormUtil::yearForDropDown(2004), 
                    array('prompt' => '--Please Select --',
                        'value' => '0',
                        'class'=>'span-10',
                       'style'=>'font-size:20px; height:40px;',
                        ));?>
        </div>
        <div class="row">
            
        </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit' , array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



