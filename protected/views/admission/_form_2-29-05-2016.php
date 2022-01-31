<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admission-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
    'htmlOptions'=>(array('autocomplete'=>'off',)),
    'action'=>CController::createUrl('create'),
)); 




?>

	

	

        
        
        <div id="step1">
            
            <div class="title">
                <h4>Personal Details</h4>
                
            </div>
            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <div class="row">
                <?php //echo $form->errorSummary($person);?>
                
            </div>
            <div class="row">
                    <?php  echo $form->labelEx($person,'per_title'); ?>
                    <?php echo ZHtml::enumActiveDropDownList( $person,'per_title',array('class'=>'span-10','style'=>'height:35px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_title'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_firstName'); ?>
                    <?php echo $form->textField($person,'per_firstName',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_firstName'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_lastName'); ?>
                    <?php echo $form->textField($person,'per_lastName',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_lastName'); ?>
            </div>
<div class="row">
                    <?php echo $form->labelEx($person,'per_fathersName'); ?>
                    <?php echo $form->textField($person,'per_fathersName',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_fathersName'); ?>
            </div>


             <div class="row">
                    <?php echo $form->labelEx($person,'per_mothersName'); ?>
                    <?php echo $form->textField($person,'per_mothersName',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_mothersName'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_gender'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($person,'per_gender',array('rel'=>'gender','labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px'), 'separator'=>'  ',)); ?>     
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
                                            'dateFormat'=>'dd-mm-yy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date span-10','style'=>'font-size:20px; height:25px;'),
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
                    <?php echo $form->textField($person,'per_nationality',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_nationality'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_maritalStatus'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList( $person,'per_maritalStatus',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px;  font-size:20px;'), 'separator'=>'  ',)); ?>
                    <?php echo $form->error($person,'per_maritalStatus'); ?>
            </div>

            <div id="maritalStatus" class="row" style="<?php echo ($person->per_maritalStatus=='married'?'display:inline':'display:none');  ?>">
                    <?php echo $form->labelEx($person,'per_spouseName'); ?>
                    <?php echo $form->textField($person,'per_spouseName',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_spouseName'); ?>
            </div>

            
            <div class="row">
                    <?php echo $form->labelEx($person,'per_permanentAddress'); ?>
                    <?php echo $form->textArea($person,'per_permanentAddress',array('class'=>'span-10','style'=>' font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_permanentAddress'); ?>
            </div>
            


            <div class="row">
                
                    <?php echo $form->labelEx($person,'per_presentAddress'); ?>
<span>Same As Permanent Address</span>                
 <?php 
         
 echo CHtml::checkBox('presentAddress',yii::app()->session['stuCreatePeresentAdd'], array('value'=>1, 'uncheckValue'=>0)); ?>
<br/>                
                    <?php echo $form->textArea($person,'per_presentAddress',array('class'=>'span-10','style'=>' font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_presentAddress'); ?>
            </div>

            


            
            <div class="row">
                    <?php echo $form->labelEx($person,'per_mobile'); ?>
                    <?php echo $form->textField($person,'per_mobile',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_mobile'); ?>
            </div>

             <div class="row">
                    <?php echo $form->labelEx($person,'per_email'); ?>
                    <?php echo $form->textField($person,'per_email',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_email'); ?>
            </div>

             <div class="row">
                    <?php echo $form->labelEx($person,'per_telephone'); ?>
                    <?php echo $form->textField($person,'per_telephone',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_telephone'); ?>
            </div> 
            
   
            <div class="row">
                    <?php echo $form->labelEx($person,'per_criminalConviction'); ?>
                    <?php echo $form->checkBox($person,'per_criminalConviction', array('value'=>1, 'uncheckValue'=>0)); ?>
                    <?php echo $form->error($person,'per_criminalConviction'); ?>
            </div>
            
            <div id="crimiCon" class="row" style="<?php echo ($person->per_criminalConviction==1?'display:inline':'display:none');  ?>">
                    <?php echo $form->labelEx($person,'per_convictionDetails'); ?>
                    <?php echo $form->textArea($person,'per_convictionDetails',array('class'=>'span-10','style'=>' font-size:20px;')); ?>
                    <?php echo $form->error($person,'per_convictionDetails');  ?>
            </div>
        
        </div>
        <hr/>
        <div id="step2">
            <div class="title">
                <h4>Other Details</h4>
                
            </div>
            <div class="row">
                <?php  // echo $form->errorSummary($admission); ?>
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
                                            'dateFormat'=>'dd-mm-yy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date span-10','style'=>'height:25px; font-size:20px;'),
                    )
                    );?>
                    <?php echo $form->error($admission,'adm_date'); ?>
            </div>
      
            <div class="row">
                <span>Father is the local guardian </span>                
 <?php echo CHtml::checkBox('localGuardian',yii::app()->session['stuCreateLocalGua'], array('value'=>1, 'uncheckValue'=>0)); ?>
<br/> 
                    <?php echo $form->labelEx($student,'stu_guardiansName'); ?>
                    <?php echo $form->textField($student,'stu_guardiansName',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($student,'stu_guardiansName'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_guardiansAddress'); ?>
                    <?php echo $form->textArea($student,'stu_guardiansAddress',array('class'=>'span-10','style'=>' font-size:20px;')); ?>
                    <?php echo $form->error($student,'stu_guardiansAddress'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_guardiansMobile'); ?>
                    <?php echo $form->textField($student,'stu_guardiansMobile',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                    <?php echo $form->error($student,'stu_guardiansMobile'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_conditions'); ?>
                    <?php echo $form->textArea($student,'stu_conditions',array('class'=>'span-10','style'=>'font-size:20px;')); ?>
                    <?php echo $form->error($student,'stu_conditions'); ?>
            </div>
            <div class="row">
                <strong><?php echo CHtml::encode("Achived any previous degree form this University"); ?></strong><br/>
                    <?php echo CHtml::checkBox('hasPreDegree',yii::app()->session['stuCreateHasPreDeg'], array('value'=>1, 'uncheckValue'=>0)); ?>
                    
            </div>
            <div id="preDegree" style="<?php echo (yii::app()->session['stuCreateHasPreDeg']==1?'display:inline':'display:none');  ?>">
                <div class="row">
                        <?php echo $form->labelEx($student,'stu_previousID'); ?>
                        <?php echo $form->textField($student,'stu_previousID',array('class'=>'span-10','style'=>'height:25px; font-size:20px;')); ?>
                        <?php echo $form->error($student,'stu_previousID'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($student,'stu_previousDegree'); ?>
                        <?php echo $form->dropDownList($student,'stu_previousDegree', CHtml::listData(Programme::model()->findAll(),
                       'pro_name','pro_name'),array('prompt' => '--Select Degree--','value' => '0',));?>
                        <?php echo $form->error($student,'stu_previousDegree'); ?>
                </div>
            </div>
            
            <div class="row" >
                <?php echo $form->labelEx($admission,'waiverID'); ?>
                    <?php echo $form->dropDownList($admission, 'waiverID', Chtml::listData(Waiver::model()->findAll(), 'waiverID', 'wav_title'), array('prompt' => '-- Please Select --','value' => '0','class'=>'span-10','style'=>'height:35px; font-size:20px;')); ?>
                    <?php echo $form->error($admission,'waiverID'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($student,'stu_paymentMethod'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($student,'stu_paymentMethod',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px; font-size:20px;'), 'separator'=>'  ',)); ?>     
                    <?php echo $form->error($student,'stu_paymentMethod'); ?>
            </div>
        </div>
        <hr/>
        <div id="step3">
            
            <div class="title">
                <h4>Academic Details</h4>
                
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th><?php  echo $form->labelEx($acHistory,'ach_degree'); ?></th>
                            <th><?php echo $form->labelEx($acHistory,'ach_group'); ?></th>
                            <th><?php echo $form->labelEx($acHistory,'ach_board'); ?></th>
                            
                            <th><?php  echo $form->labelEx($acHistory,'ach_institution');  ?></th>
                            <th><?php echo $form->labelEx($acHistory,'ach_passingYear'); ?></th>
                          
                            <th><?php echo $form->labelEx($acHistory,'ach_result'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[0]',$acHistory->ach_degree[0],array('S.S.C.'=>'S.S.C.','DAKHIL'=>'DAKHIL','GCE O-Level'=>'GCE O-Level'),array('prompt' => '--Select Degree--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                        
                           <td><?php echo CHtml::dropDownList('ach_group[0]',$acHistory->ach_group[0],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[0]',$acHistory->ach_board[0], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            
                            <!--td><?php // echo CHtml::textField('ach_institution[0]',$acHistory->ach_institution[0],array('class'=>'span-3','style'=>'height:25px; font-size:20px;')); ?></td-->
               
                            <td>
                                <?php 
                                                               
                                 
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(

                                        'name'=>'ach_institution[0]',
                                       // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                                        'source'=> AcademicHistory::searchInstitution('0'),
                                        'options'=>array(
                                                'minLength'=>'3',
                                            'htmlOptions'=>array('style'=>'font-size:18px; width:198px;'),
                                            ),
                                        //'htmlOptions'=>array('style'=>'width:700px;','required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111] ',
                                             'htmlOptions'=>array('class'=>'','style'=>'height:25px; width:98px; font-size:18px;','required'=>false,
                                                 ////'title'=>'ID have to be like [111-111-111] ',
                                               ),
                                    ));
                                ?>
                            </td>
                            <td><?php echo CHtml::textField('ach_passingYear[0]',$acHistory->ach_passingYear[0],array('class'=>'span-2','style'=>'height:25px; font-size:20px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                             <td><?php echo CHtml::checkBox('result[0]',yii::app()->session['stuCreateResult0'], array('value'=>1, 'uncheckValue'=>0,'rel'=>'0','class'=>'result','title'=>'GPA/Division')); ?></td>
                            <td><?php
                                if(yii::app()->session['stuCreateResult0']==1)
                                {
                                    echo CHtml::dropDownList('ach_result[0]',$acHistory->ach_result[0],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','class'=>'span-1','style'=>'height:35px; font-size:15px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[0]',$acHistory->ach_result[0],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4,'title'=>'It should be GPA like 5.0','class'=>'span-2','style'=>'height:25px; font-size:20px;')); 
                                }    
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[1]',$acHistory->ach_degree[1],array('H.S.C.'=>'H.S.C.','ALIM'=>'ALIM','GCE A-Level'=>'GCE A-Level','Diploma'=>'Diploma'),array('prompt' => '--Select Degree--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[1]',$acHistory->ach_group[1],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[1]',$acHistory->ach_board[1], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            
                            <td>
                                <?php 
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(

                                        'name'=>'ach_institution[1]',
                                       // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                                        'source'=>  AcademicHistory::searchInstitution('1'),
                                        'options'=>array(
                                                'minLength'=>'3',
                                            'htmlOptions'=>array('style'=>'font-size:18px;'),
                                            ),
                                        //'htmlOptions'=>array('style'=>'width:700px;','required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111] ',
                                             'htmlOptions'=>array('class'=>'','style'=>'height:25px; width:98px; font-size:18px;','required'=>false,
                                                 ////'title'=>'ID have to be like [111-111-111] ',
                                               ),
                                    ));
                                ?>
                            </td>
                            <td><?php echo CHtml::textField('ach_passingYear[1]',$acHistory->ach_passingYear[1],array('class'=>'span-2','style'=>'height:25px; font-size:20px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                            <td><?php echo CHtml::checkBox('result[1]',yii::app()->session['stuCreateResult1'], array('value'=>1, 'uncheckValue'=>0,'rel'=>'1','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if(yii::app()->session['stuCreateResult1']==1)
                                {
                                    echo CHtml::dropDownList('ach_result[1]',$acHistory->ach_result[1],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[1]',$acHistory->ach_result[1],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4,'title'=>'It should be GPA like 5.0','class'=>'span-2','style'=>'height:25px; font-size:20px;')); 
                                }    
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[2]',$acHistory->ach_degree[2],array('Graduation'=>'Graduation'),array('prompt' => '--Select Degree--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[2]',$acHistory->ach_group[2],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[2]',$acHistory->ach_board[2], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            <td>
                                <?php 
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(

                                        'name'=>'ach_institution[2]',
                                       // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                                        'source'=>  AcademicHistory::searchInstitution('2'),
                                        'options'=>array(
                                                'minLength'=>'3',
                                            'htmlOptions'=>array('style'=>'font-size:25px;'),
                                            ),
                                        //'htmlOptions'=>array('style'=>'width:700px;','required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111] ',
                                             'htmlOptions'=>array('class'=>'','style'=>'height:25px; width:98px; font-size:20px;','required'=>false,
                                                 ////'title'=>'ID have to be like [111-111-111] ',
                                               ),
                                    ));
                                ?>
                            </td>
                            <td><?php echo CHtml::textField('ach_passingYear[2]',$acHistory->ach_passingYear[2],array('class'=>'span-2','style'=>'height:25px; font-size:20px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                            <td><?php echo CHtml::checkBox('result[2]',yii::app()->session['stuCreateResult2'], array('value'=>1, 'uncheckValue'=>0,'rel'=>'2','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if(yii::app()->session['stuCreateResult2']==1)
                                {
                                    echo CHtml::dropDownList('ach_result[2]',$acHistory->ach_result[2],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[2]',$acHistory->ach_result[2],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4,'title'=>'It should be GPA like 5.0','class'=>'span-2','style'=>'height:25px; font-size:20px;')); 
                                }    
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[3]',$acHistory->ach_degree[3],array('Post Graduation'=>'Post Graduation','Post Graduation Deploma'=>'Post Graduation Deploma'),array('prompt' => '--Select Degree--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[3]',$acHistory->ach_group[3],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[3]',$acHistory->ach_board[3], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','class'=>'span-4','style'=>'height:35px; font-size:15px;')); ?></td>
                            <td>
                                <?php 
                                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(

                                        'name'=>'ach_institution[3]',
                                       // 'source'=>array('111-115-001', '111-112-110', '111-112-100','211-115-001', '211-112-110','211-112-111', '311-112-100',),
                                        'source'=>  AcademicHistory::searchInstitution('3'),
                                        'options'=>array(
                                                'minLength'=>'3',
                                            'htmlOptions'=>array('style'=>'font-size:25px; width:98px;'),
                                            ),
                                        //'htmlOptions'=>array('style'=>'width:700px;','required'=>true,'pattern'=>'([0-9][0-9][0-9]-[0-9][0-9][0-9]-[0-9][0-9][0-9])$','title'=>'ID have to be like [111-111-111] ',
                                             'htmlOptions'=>array('class'=>'','style'=>'height:25px; width:98px; font-size:20px;','required'=>false,
                                                 ////'title'=>'ID have to be like [111-111-111] ',
                                               ),
                                    ));
                                ?>
                            </td>
                            <td><?php echo CHtml::textField('ach_passingYear[3]',$acHistory->ach_passingYear[3],array('class'=>'span-2','style'=>'height:25px; font-size:20px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                            <td><?php echo CHtml::checkBox('result[3]',yii::app()->session['stuCreateResult3'], array('value'=>1, 'uncheckValue'=>0,'rel'=>'3','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if(yii::app()->session['stuCreateResult3']==1)
                                {
                                    echo CHtml::dropDownList('ach_result[3]',$acHistory->ach_result[3],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[3]',$acHistory->ach_result[3],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4,'title'=>'It should be GPA like 5.0','class'=>'span-2','style'=>'height:25px; font-size:20px;')); 
                                }    
                                    ?>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                
            </div>
            
            
        </div>
        <div id="step4">
            <hr/>
            <div class="title">
                <h4>Job Experience Details</h4>
                
            </div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th><?php echo $form->labelEx($jobExp,'joe_employer'); ?></th>
                            <th><?php echo $form->labelEx($jobExp,'joe_address'); ?></th>
                            <th><?php echo $form->labelEx($jobExp,'joe_contact'); ?></th>
                            <th><?php echo $form->labelEx($jobExp,'joe_position'); ?></th>
                            <th><?php echo $form->labelEx($jobExp,'joe_startDate'); ?></th>
                            <th><?php echo $form->labelEx($jobExp,'joe_endDate'); ?></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            <td><?php echo CHtml::textField('joe_employer[0]',$jobExp->joe_employer[0],array("style"=>"width:150px;")); ?></td>
                            <td><?php echo CHtml::textArea('joe_address[0]',$jobExp->joe_address[0],array('style'=>'width:150px;')); ?></td>
                            <td><?php echo CHtml::textField('joe_contact[0]',$jobExp->joe_contact[0],array("style"=>"width:80px;",'pattern'=>'\d{1,14}','title'=>'It Should be Numeric')); ?></td>
                            <td><?php echo CHtml::textField('joe_position[0]',$jobExp->joe_position[0],array("style"=>"width:100px;")); ?></td>
                            
                             <td>
                                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                          
                                            'name'=>'joe_startDate[0]',
                                            'value'=>$jobExp->joe_startDate[0],
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'dd-mm-yy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date','style'=>'width:70px'),
                                    )
                                    );?>
                             </td>
                             <td>
                                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                        
                                            'name'=>'joe_endDate[0]',
                                            'value'=>$jobExp->joe_endDate[0],
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'dd-mm-yy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date','style'=>'width:70px'),
                                    )
                                    );  ?>
                             </td>
                        </tr>
                        
                        <tr>
                            
                            <td><?php echo CHtml::textField('joe_employer[1]',$jobExp->joe_employer[1],array("style"=>"width:150px;")); ?></td>
                            <td><?php echo CHtml::textArea('joe_address[1]',$jobExp->joe_address[1],array('style'=>'width:150px;')); ?></td>
                            <td><?php echo CHtml::textField('joe_contact[1]',$jobExp->joe_contact[1],array("style"=>'width:80px;','pattern'=>'\d{1,14}','title'=>'It Should be Numeric')); ?></td>
                            <td><?php echo CHtml::textField('joe_position[1]',$jobExp->joe_position[1],array("style"=>"width:100px;")); ?></td>
                            
                             <td>
                                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                          
                                            'name'=>'joe_startDate[1]',
                                            'value'=>$jobExp->joe_startDate[1],
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'dd-mm-yy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date','style'=>'width:70px'),
                                    )
                                    );?>
                             </td>
                             <td>
                                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                        
                                            'name'=>'joe_endDate[1]',
                                        'value'=>$jobExp->joe_endDate[1],
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'dd-mm-yy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date','style'=>'width:70px'),
                                    )
                                    );  ?>
                             </td>
                        </tr>       
                   
                    </tbody>
                </table>
                
            </div>
            
            
        </div>
	<div class="row buttons">
		
            <?php 
           echo CHtml::hiddenField('preview', 1);
            echo CHtml::submitButton('Preview', array('class' => 'btn btn-primary btn-large','data-loading-text'=>'Loading....'));
            
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
    //---------------------//
    $( "#hasPreDegree").on( "click", function()
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
            $("#Person_per_spouseName").attr('required',false);
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
    
    
    
    //---------------------//
    $( ".result").on( "click", function()
    {
        //alert('ok');
        //alert($(this).attr('rel'));
        
        if ( !$(this).prop('checked') ){
            //alert('ok');
            var id = 'ach_result_'+$(this).attr('rel');
            //$(id).hide('slow');
            $('#'+id).replaceWith("<input id='"+id+"' type='text' name='ach_result["+$(this).attr('rel')+"]' pattern='\d{1}[.]\d{1,2}'  title='It should be GPA like 5.0' class='span-2' style='height:25px; font-size:20px;'></input>");
            
        }
        else 
        {
            var id = 'ach_result_'+$(this).attr('rel');
            //$(id).hide('slow');
            $('#'+id).replaceWith( "<select id='"+id+"' name='ach_result["+$(this).attr('rel')+"]' value='0' style='width:60px;'><option value=''>--</option><option value='1st'>1st</option><option value='2nd'>2nd</option><option value='3rd'>3rd</option></select>" );
            
        }
        

    } );
    
    </script>
</div><!-- form -->