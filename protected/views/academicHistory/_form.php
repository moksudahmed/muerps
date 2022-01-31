<?php
/* @var $this AcademicHistoryController */
/* @var $model AcademicHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'academic-history-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ach_degree'); ?>
		
                <?php echo ZHtml::enumActiveDropDownList( $model,'ach_degree'); ?>	
                <?php echo $form->error($model,'ach_degree'); ?>
            
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ach_group'); ?>

                <?php echo ZHtml::enumActiveRadioButtonList($model, 'ach_group',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
		<?php echo $form->error($model,'ach_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ach_institution'); ?>
		<?php echo $form->textField($model,'ach_institution',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ach_institution'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ach_board'); ?>
		<?php echo ZHtml::enumActiveDropDownList( $model,'ach_board'); ?>	
		<?php echo $form->error($model,'ach_board'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ach_passingYear'); ?>
		<?php echo $form->textField($model,'ach_passingYear',array('style'=>'width:50px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?>
		<?php echo $form->error($model,'ach_passingYear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ach_result'); ?>
                <?php 
                    $_REQUEST['result']='';
                echo CHtml::checkBox('result',$_REQUEST['result'], array('value'=>1, 'uncheckValue'=>0,'rel'=>'0','class'=>'result','title'=>'GPA/Division')); 
                            
                           if($_REQUEST['result']==1)
                                {   
                                    echo " ".$form->dropDownList($model,'ach_result',array($_REQUEST['AcademicHistory_ach_result']=>$_REQUEST['AcademicHistory_ach_result'],'1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo " ".$form->textField($model,'ach_result',array('type'=>'number',"style"=>"width:25px;",'pattern'=>'\d{1}[.]\d{1,2}','title'=>'It should be GPA like 5.0')); 
                                }    
                ?>
		
		<?php echo $form->error($model,'ach_result'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ach_remarks'); ?>
		<?php echo $form->textArea($model,'ach_remarks',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ach_remarks'); ?>
	</div>

        <div class="row buttons">
		
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Continue' : 'Save', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $( ".result").on( "click", function()
    {
        //alert('ok');
        //alert($(this).attr('rel'));
        
        if ( !$(this).prop('checked') ){
            //alert('ok');
           // var id = 'ach_result_'+$(this).attr('rel');
            //$(id).hide('slow');
            $('#AcademicHistory_ach_result').replaceWith("<input id='AcademicHistory_ach_result' name='AcademicHistory[ach_result]' type='text'  pattern='\d{1}[.]\d{1,2}' style='width:25px;' title='It should be GPA like 5.0'></input>");
            
        }
        else 
        {
            //var id = 'ach_result_'+$(this).attr('rel');
            //$(id).hide('slow');
            $('#AcademicHistory_ach_result').replaceWith( "<select id='AcademicHistory_ach_result' name='AcademicHistory[ach_result]'  value='0' style='width:60px;'><option value=''>--</option><option value='1st'>1st</option><option value='2nd'>2nd</option><option value='3rd'>3rd</option><option value='pass'>pass</option></select>" );
            
        }
        

    } );
    
    </script>