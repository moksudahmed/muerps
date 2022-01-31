<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admission-update',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
    'stateful'=>true, 
  'htmlOptions'=>array('enctype' => 'multipart/form-data'),
    //'action'=>CController::createUrl('update')
)); ?>

<?php $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
                            'data' => $person->per_title.' '.$person->per_firstName.' '.$person->per_lastName.' '.$person->per_dateOfBirth.' '.$person->per_fathersName.' '.$person->per_presentAddress,
                            'filename' => $person->personID.".png",
                            'filePath'=>YiiBase::getPathOfAlias('webroot.images.uploads'),
                            'subfolderVar' => false,
                            'matrixPointSize' => 5,
                            'displayImage'=>false,
                            'errorCorrectionLevel'=>'L',
                            'matrixPointSize'=>4, // 1 to 10 only
                        )) ?>
   <?php

$image = Yii::app()->baseUrl . '/images/uploads/'.$person->personID.".png";

echo CHtml::image($image , ' ' , array(
   'style' => 'max-height: 128px;',
)); ?> 
        <div id="step1" class="form-style-one">
            <hr/>
            <div class="title">
                <h4>Personal Details</h4>
                
            </div>
            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <div class="row">
                <?php //echo $form->errorSummary($person);?>
                
            </div>
            
            
            <div class="row">
                    <?php  echo $form->labelEx($person,'per_title'); ?>
                    <?php echo ZHtml::enumActiveDropDownList( $person,'per_title',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_title'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_firstName'); ?>
                    <?php echo $form->textField($person,'per_firstName',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_firstName'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_lastName'); ?>
                    <?php echo $form->textField($person,'per_lastName',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_lastName'); ?>
            </div>
            
<div class="row">
                    <?php echo $form->labelEx($person,'per_fathersName'); ?>
                    <?php echo $form->textField($person,'per_fathersName',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_fathersName'); ?>
            </div>


             <div class="row">
                    <?php echo $form->labelEx($person,'per_mothersName'); ?>
                    <?php echo $form->textField($person,'per_mothersName',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_mothersName'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_gender'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($person,'per_gender',array('rel'=>'gender','labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',)); ?>     
                    <?php echo $form->error($person,'per_gender'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($person,'per_dateOfBirth'); ?>

                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                            'attribute'=>'per_dateOfBirth',
                                            'model'=>$person,
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'yy-mm-dd',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date span-10'),
                    )
                    );?>

                    <?php //echo $form->textField($persons,'per_dateOfBirth'); ?>
                    <?php echo $form->error($person,'per_dateOfBirth'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($person,'per_bloodGroup'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($person, 'per_bloodGroup',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',)); ?>        
                    <?php echo $form->error($person,'per_bloodGroup'); ?>
            </div>
            
            <div class="row">
                    <?php echo $form->labelEx($person,'per_nationality'); ?>
                    <?php echo $form->textField($person,'per_nationality',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_nationality'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_maritalStatus'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList( $person,'per_maritalStatus',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',)); ?>
                    <?php echo $form->error($person,'per_maritalStatus'); ?>
            </div>

            <div id="maritalStatus" class="row" style="<?php echo ($person->per_maritalStatus=='married'?'display:inline':'display:none');  ?>">
                    <?php echo $form->labelEx($person,'per_spouseName'); ?>
                    <?php echo $form->textField($person,'per_spouseName',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_spouseName'); ?>
            </div>
        <div class="row">
      
                    <?php echo $form->labelEx($person,'per_permanentAddress'); ?>
                    <?php echo $form->textArea($person,'per_permanentAddress',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_permanentAddress'); ?>
            </div>
            


            <div class="row">
                           <span>Same As Permanent Address</span>                
 <?php 
         
 echo CHtml::checkBox('presentAddress',yii::app()->session['stuCreatePeresentAdd'], array('value'=>1, 'uncheckValue'=>0)); ?>
<br/>
                    <?php echo $form->labelEx($person,'per_presentAddress'); ?>
                    <?php echo $form->textArea($person,'per_presentAddress',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_presentAddress'); ?>
            </div>

    


            

            <div class="row">
                    <?php echo $form->labelEx($person,'per_mobile'); ?>
                    <?php echo $form->textField($person,'per_mobile',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_mobile'); ?>
            </div>

             <div class="row">
                    <?php echo $form->labelEx($person,'per_email'); ?>
                    <?php echo $form->textField($person,'per_email',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_email'); ?>
            </div>

             <div class="row">
                    <?php echo $form->labelEx($person,'per_telephone'); ?>
                    <?php echo $form->textField($person,'per_telephone',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_telephone'); ?>
            </div> 
            
   
            <div class="row">
                    <?php echo $form->labelEx($person,'per_criminalConviction'); ?>
                    <?php echo $form->checkBox($person,'per_criminalConviction', array('value'=>1, 'uncheckValue'=>0)); ?>
                    <?php echo $form->error($person,'per_criminalConviction'); ?>
            </div>
            
            <div id="crimiCon" class="row" style="<?php echo ($person->per_criminalConviction==1?'display:inline':'display:none');  ?>">
                    <?php echo $form->labelEx($person,'per_convictionDetails'); ?>
                    <?php echo $form->textArea($person,'per_convictionDetails',array('class'=>'span-10')); ?>
                    <?php echo $form->error($person,'per_convictionDetails');  ?>
            </div>
        
        </div>
        <hr/>
        <div id="step2" class="form-style-one">
            <div class="title">
                <h4>Other Details</h4>
                
            </div>
            <div class="row">
                <?php  //echo $form->errorSummary($admission); ?>
                    <?php //echo $form->errorSummary($student); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($admission,'adm_date'); ?>
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                            'attribute'=>'adm_date',
                                            'model'=>$admission,
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'yy-mm-dd',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date span-10'),
                    )
                    );?>
                    <?php echo $form->error($admission,'adm_date'); ?>
            </div>
            <div class="row">
                          <span>Father is the local guardian </span>                
 <?php echo CHtml::checkBox('localGuardian',yii::app()->session['stuCreateLocalGua'], array('value'=>1, 'uncheckValue'=>0)); ?>
<br/> 
                    <?php echo $form->labelEx($student,'stu_guardiansName'); ?>
                    <?php echo $form->textField($student,'stu_guardiansName',array('class'=>'span-10')); ?>
                    <?php echo $form->error($student,'stu_guardiansName'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_guardiansAddress'); ?>
                    <?php echo $form->textArea($student,'stu_guardiansAddress',array('class'=>'span-10')); ?>
                    <?php echo $form->error($student,'stu_guardiansAddress'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_guardiansMobile'); ?>
                    <?php echo $form->textField($student,'stu_guardiansMobile',array('class'=>'span-10')); ?>
                    <?php echo $form->error($student,'stu_guardiansMobile'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_conditions'); ?>
                    <?php echo $form->textArea($student,'stu_conditions',array('class'=>'span-10')); ?>
                    <?php echo $form->error($student,'stu_conditions'); ?>
            </div>
            <div class="row">
                          <strong><?php echo CHtml::encode("Achived any previous degree form this University"); ?></strong><br/>
                    <?php // echo CHtml::checkBox('hasPreDegree',yii::app()->session['stuCreateHasPreDeg'], array('value'=>1, 'uncheckValue'=>0)); ?>
            </div>
            <div id="preDegree" style="<?php //echo ($_REQUEST['hasPreDegree']==1?'display:inline':'display:none');  ?>">
                <div class="row">
                        <?php echo $form->labelEx($student,'stu_previousID'); ?>
                        <?php echo $form->textField($student,'stu_previousID',array('class'=>'span-10')); ?>
                        <?php echo $form->error($student,'stu_previousID'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($student,'stu_previousDegree'); ?>
                        <?php echo $form->dropDownList($student,'stu_previousDegree', CHtml::listData(Programme::model()->findAll(),
                       'pro_name','pro_name'),array('prompt' => '--Select Degree--','value' => '0','class'=>'span-10'));?>
                        <?php echo $form->error($student,'stu_previousDegree'); ?>
                </div>
                
            </div>
            <div class="row" >
                <?php echo $form->labelEx($admission,'waiverID'); ?>
                    <?php echo CHtml::activeDropDownList($admission, 'waiverID', Chtml::listData(Waiver::model()->findAllBySql('SELECT * FROM tbl_ab_waiver where wav_active=true order by wav_title;'), 'waiverID', 'wav_title'), array('prompt' => '--Please Select --',
                        'value' => '0','class'=>'span-10')); ?>
                    <?php echo $form->error($admission,'waiverID'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_paymentMethod'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($student,'stu_paymentMethod',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;' ), 'separator'=>'  ',)); ?>     
                    <?php echo $form->error($student,'stu_paymentMethod'); ?>
            </div>
        </div>
        <div id="step3" class="form-style-one">
            <hr/>

            <div class="row">
                <?php  echo $form->labelEx($person,'ex_per_image'); ?>
               
                
                <?php echo chtml::fileField('photograph','',array('style'=>'width:auto;','pattern'=>'/(\.|\/)(gif|jpe?g|png)$/','title'=>'File Type = jpg, size = passport',)) ?>
                <?php echo $form->error($person,'photograph'); ?>
            </div>
        </div>
        <hr/>
       
	<div class="row buttons">
		
            <?php 
       echo CHtml::hiddenField('test', 12);
            echo CHtml::submitButton('Update', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....'));
            
            ?>
            	
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    
    
    //---------------
    $( "#Person_per_criminalConviction").on( "click", function()
    {
        
        
    if ( $(this).prop('checked') ){
        $("#crimiCon").show('slow');
        $("#Person_per_convictionDetails").attr('required',true);
    }
    else 
        {
            $("#crimiCon").hide('slow');
            $("#Person_per_convictionDetails").attr('required',false);
            $("#Person_per_convictionDetails").val('');
        }
        

    } );
    
    //---------------------//
    $( "#HasPreDegree").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            $("#preDegree").show('slow');
            $("#Student_stu_previousID").attr('required',true);
            $("#Student_stu_previousDegree").attr('required',true);
        }
        else 
        {
            $("#preDegree").hide('slow');
            $("#Student_stu_previousID").attr('required',false);
            $("#Student_stu_previousID").val('');
            $("#Student_stu_previousDegree").attr('required',false);
            $("#Student_stu_previousDegree").val('');
        }
        

    } );
    
    //---------------
    $( "input[type='radio']").on( "click", function()
    {
        
        
        if ( $(this).attr('value')=='married' ){//alert('dd');
            $("#maritalStatus").show('slow');
            $("#Person_per_spouseName").attr('required',true);
        }
        else 
        {
            $("#maritalStatus").hide('slow');
            $("Person_per_spouseName").attr('required',false);
            $("#Person_per_spouseName").val('');
        }
        
    });
    
    $( "input[rel='gender']").on( "click", function()
    {
      if ( $(this).attr('value')=='female' ){//alert('dd');
        
        $("#Admission_waiverID").val(1);
    }
    else 
        {
            $value = <?php echo ($admission->waiverID!=0?$admission->waiverID:0) ?>;
            $("#Admission_waiverID").val($value);
        }  

    } );
    
     //---------------
    $( "#presentAddress").on( "click", function()
    {
        
        
    if ( $(this).prop('checked') ){
        
        $("#Person_per_presentAddress").val($("#Person_per_permanentAddress").val());
    }
    else 
        {
           
            $("#Person_per_presentAddress").val('');
        }
        

    } );
    
    //---------------
    $( "#localGuardian").on( "click", function()
    {
        
        
    if ( $(this).prop('checked') ){
        
        $("#Student_stu_guardiansName").val($("#Person_per_fathersName").val());
        $("#Student_stu_guardiansAddress").val($("#Person_per_presentAddress").val());
    }
    else 
        {
           
            $("#Student_stu_guardiansName").val('');
            $("#Student_stu_guardiansAddress").val('');
        }
        

    } );
    
    
    </script>
</div><!-- form -->