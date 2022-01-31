<?php
/* @var $this AdministrationController */
/* @var $model Administration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-form1',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
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
                    <?php echo ZHtml::enumActiveDropDownList( $person,'per_title'); ?>
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
                    <?php echo $form->labelEx($person,'per_fathersName'); ?>
                    <?php echo $form->textField($person,'per_fathersName'); ?>
                    <?php echo $form->error($person,'per_fathersName'); ?>
            </div>


             <div class="row">
                    <?php echo $form->labelEx($person,'per_mothersName'); ?>
                    <?php echo $form->textField($person,'per_mothersName'); ?>
                    <?php echo $form->error($person,'per_mothersName'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_gender'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($person,'per_gender',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>     
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
                                            'dateFormat'=>'dd-mm-yyyy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date'),
                    )
                    );?>

                    <?php //echo $form->textField($persons,'per_dateOfBirth'); ?>
                    <?php echo $form->error($person,'per_dateOfBirth'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_bloodGroup'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList($person, 'per_bloodGroup',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>        
                    <?php echo $form->error($person,'per_bloodGroup'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($person,'per_nationality'); ?>
                    <?php echo $form->textField($person,'per_nationality'); ?>
                    <?php echo $form->error($person,'per_nationality'); ?>
            </div>

            <div class="row">
                    <?php echo $form->labelEx($person,'per_maritalStatus'); ?>
                    <?php echo ZHtml::enumActiveRadioButtonList( $person,'per_maritalStatus',array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',)); ?>
                    <?php echo $form->error($person,'per_maritalStatus'); ?>
            </div>

            <div id="maritalStatus" class="row" style="<?php echo ($person->per_maritalStatus=='married'?'display:inline':'display:none');  ?>">
                    <?php echo $form->labelEx($person,'per_spouseName'); ?>
                    <?php echo $form->textField($person,'per_spouseName'); ?>
                    <?php echo $form->error($person,'per_spouseName'); ?>
            </div>

            
            <div class="row">
                    <?php echo $form->labelEx($person,'per_permanentAddress'); ?>
                    <?php echo $form->textArea($person,'per_permanentAddress'); ?>
                    <?php echo $form->error($person,'per_permanentAddress'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($person,'per_postCode'); ?>
                    <?php echo $form->textField($person,'per_postCode'); ?>
                    <?php echo $form->error($person,'per_postCode'); ?>
            </div>


            <div class="row">
                
                    <?php echo $form->labelEx($person,'per_presentAddress'); ?>
<span>Same As Permanent Address</span>                
 <?php echo CHtml::checkBox('presentAddress',(isset($_REQUEST['presentAddress'])?$_REQUEST['presentAddress']:$_REQUEST['presentAddress']=''), array('value'=>1, 'uncheckValue'=>0)); ?>
<br/>                
                    <?php echo $form->textArea($person,'per_presentAddress'); ?>
                    <?php echo $form->error($person,'per_presentAddress'); ?>
            </div>

            


            
            <div class="row">
                    <?php echo $form->labelEx($person,'per_mobile'); ?>
                    <?php echo $form->textField($person,'per_mobile'); ?>
                    <?php echo $form->error($person,'per_mobile'); ?>
            </div>

             <div class="row">
                    <?php echo $form->labelEx($person,'per_email'); ?>
                    <?php echo $form->textField($person,'per_email',array('required'=>true)); ?>
                    <?php echo $form->error($person,'per_email'); ?>
            </div>

             <div class="row">
                    <?php echo $form->labelEx($person,'per_telephone'); ?>
                    <?php echo $form->textField($person,'per_telephone'); ?>
                    <?php echo $form->error($person,'per_telephone'); ?>
            </div> 
            
   
            <div class="row">
                    <?php echo $form->labelEx($person,'per_criminalConviction'); ?>
                    <?php echo $form->checkBox($person,'per_criminalConviction', array('value'=>1, 'uncheckValue'=>0)); ?>
                    <?php echo $form->error($person,'per_criminalConviction'); ?>
            </div>
            
            <div id="crimiCon" class="row" style="<?php echo ($person->per_criminalConviction==1?'display:inline':'display:none');  ?>">
                    <?php echo $form->labelEx($person,'per_convictionDetails'); ?>
                    <?php echo $form->textArea($person,'per_convictionDetails'); ?>
                    <?php echo $form->error($person,'per_convictionDetails');  ?>
            </div>
        
        </div>
        <hr/>
        <div id="step2">
            <div class="title">
                <h4>Official Details</h4>
                
            </div>
            
            <div class="row">
                    <?php echo $form->labelEx($employee,'emp_joining'); ?>
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                            'attribute'=>'emp_joining',
                                            'model'=>$employee,
                                            'options' => array(
                                            'mode'=>'focus',
                                            'dateFormat'=>'dd-mm-yyyy',
                                            'showAnim' => 'slideDown',
                                            ),
                                            'htmlOptions'=>array('size'=>30,'class'=>'date'),
                    )
                    );?>
                    <?php echo $form->error($employee,'emp_joining'); ?>
            </div>
            
            <div class="row">
                    <?php echo $form->labelEx($employee,'emp_designations'); ?>
                    <?php echo $form->textField($employee,'emp_designations'); ?>
                    <?php echo $form->error($employee,'emp_designations'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($employee,'emp_supervisoryRole'); ?>
                    <?php echo $form->textField($employee,'emp_supervisoryRole'); ?>
                    <?php echo $form->error($employee,'emp_supervisoryRole'); ?>
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
                            <th><?php echo $form->labelEx($acHistory,'ach_institution'); ?></th>
                            <th><?php echo $form->labelEx($acHistory,'ach_passingYear'); ?></th>
                            <th></th>
                            <th><?php echo $form->labelEx($acHistory,'ach_result'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[0]',$acHistory->ach_degree[0],  ZHtml::$Degree,array('prompt' => '--Select Degree--','value' => '0','style'=>'width:145px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[0]',$acHistory->ach_group[0],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[0]',$acHistory->ach_board[0], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::textField('ach_institution[0]',$acHistory->ach_institution[0],array("style"=>"width:100px;")); ?></td>
                            <td><?php echo CHtml::textField('ach_passingYear[0]',$acHistory->ach_passingYear[0],array('style'=>'width:30px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                            <td><?php echo CHtml::checkBox('result[0]',(isset($_REQUEST['result'][0])?$_REQUEST['result'][0]:$_REQUEST['result'][0]=''), array('value'=>1, 'uncheckValue'=>0,'rel'=>'0','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if($_REQUEST['result'][0]==1)
                                {
                                    echo CHtml::dropDownList('ach_result[0]',$acHistory->ach_result[0],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[0]',$acHistory->ach_result[0],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'\d{1}[.]\d{1,2}','title'=>'It should be GPA like 5.0')); 
                                }    
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[1]',$acHistory->ach_degree[1],ZHtml::$Degree,array('prompt' => '--Select Degree--','value' => '0','style'=>'width:145px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[1]',$acHistory->ach_group[1],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[1]',$acHistory->ach_board[1], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::textField('ach_institution[1]',$acHistory->ach_institution[1],array("style"=>"width:100px;")); ?></td>
                            <td><?php echo CHtml::textField('ach_passingYear[1]',$acHistory->ach_passingYear[1],array('style'=>'width:30px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                            <td><?php echo CHtml::checkBox('result[1]',(isset($_REQUEST['result'][1])?$_REQUEST['result'][1]:$_REQUEST['result'][1]=''), array('value'=>1, 'uncheckValue'=>0,'rel'=>'1','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if($_REQUEST['result'][1]==1)
                                {
                                    echo CHtml::dropDownList('ach_result[1]',$acHistory->ach_result[1],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[1]',$acHistory->ach_result[1],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'\d{1}[.]\d{1,2}','title'=>'It should be GPA like 5.0')); 
                                }    
                                    ?>
                            </td>
                        </tr>  
                          <tr>
                            <td ><?php echo CHtml::dropDownList('ach_degree[2]',$acHistory->ach_degree[2],ZHtml::$Degree,array('prompt' => '--Select Degree--','value' => '0','style'=>'width:145px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[2]',$acHistory->ach_group[2],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[2]',$acHistory->ach_board[2], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::textField('ach_institution[2]',$acHistory->ach_institution[2],array("style"=>"width:100px;")); ?></td>
                            <td><?php echo CHtml::textField('ach_passingYear[2]',$acHistory->ach_passingYear[2],array('style'=>'width:30px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                           <td><?php echo CHtml::checkBox('result[2]',(isset($_REQUEST['result'][2])?$_REQUEST['result'][2]:$_REQUEST['result'][2]=''), array('value'=>1, 'uncheckValue'=>0,'rel'=>'2','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if($_REQUEST['result'][2]==1)
                                {
                                    echo CHtml::dropDownList('ach_result[2]',$acHistory->ach_result[2],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[2]',$acHistory->ach_result[2],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'\d{1}[.]\d{1,2}','title'=>'It should be GPA like 5.0')); 
                                }    
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo CHtml::dropDownList('ach_degree[3]',$acHistory->ach_degree[3],ZHtml::$Degree,array('prompt' => '--Select Degree--','value' => '0','style'=>'width:145px;')); ?></td>
                        
                            <td><?php echo CHtml::dropDownList('ach_group[3]',$acHistory->ach_group[3],  ZHtml::$Group, array('prompt' => '--Select Group--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::dropDownList('ach_board[3]',$acHistory->ach_board[3], ZHtml::$Board, array('prompt' => '--Select Board--','value' => '0','style'=>'width:145px;')); ?></td>
                            <td><?php echo CHtml::textField('ach_institution[3]',$acHistory->ach_institution[3],array("style"=>"width:100px;")); ?></td>
                            <td><?php echo CHtml::textField('ach_passingYear[3]',$acHistory->ach_passingYear[3],array('style'=>'width:30px;','pattern'=>'\d{4}','title'=>'It Should be Year like 2013',)); ?></td>
                            <td><?php echo CHtml::checkBox('result[3]',(isset($_REQUEST['result'][3])?$_REQUEST['result'][3]:$_REQUEST['result'][3]=''), array('value'=>1, 'uncheckValue'=>0,'rel'=>'3','class'=>'result','title'=>'GPA/Division')); ?></td>
                            
                            <td><?php
                                if($_REQUEST['result'][3]==1)
                                {
                                    echo CHtml::dropDownList('ach_result[3]',$acHistory->ach_result[3],array('1st'=>'1st','2nd'=>'2nd','3rd'=>'3rd') ,array('prompt' => '--','value' => '0','style'=>'width:60px;'));
                                }
                                else{
                                    echo CHtml::textField('ach_result[3]',$acHistory->ach_result[3],array('type'=>'number',"style"=>"width:25px;",'pattern'=>'\d{1}[.]\d{1,2}','title'=>'It should be GPA like 5.0')); 
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
                                            'dateFormat'=>'yy-mm-dd',
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
                                            'dateFormat'=>'yy-mm-dd',
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
                                            'dateFormat'=>'yy-mm-dd',
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
                                            'dateFormat'=>'yy-mm-dd',
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
           echo CHtml::hiddenField('preview', true);
           echo CHtml::hiddenField('flag', true);
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
    //---------------------//
    $( ".result").on( "click", function()
    {
        //alert('ok');
        //alert($(this).attr('rel'));
        
        if ( !$(this).prop('checked') ){
            //alert('ok');
            var id = 'ach_result_'+$(this).attr('rel');
            //$(id).hide('slow');
            $('#'+id).replaceWith("<input id='"+id+"' type='text' name='ach_result["+$(this).attr('rel')+"]' pattern='\d{1}[.]\d{1,2}' style='width:25px;' title='It should be GPA like 5.0'></input>");
            
        }
        else 
        {
            var id = 'ach_result_'+$(this).attr('rel');
            //$(id).hide('slow');
            $('#'+id).replaceWith( "<select id='"+id+"' name='ach_result["+$(this).attr('rel')+"]' value='0' style='width:60px;'><option >--</option><option value='1st'>1st</option><option value='2nd'>2nd</option><option value='3rd'>3rd</option></select>" );
            
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
        

    } );
    
    //-----------------
    
    
    
    </script>
</div><!-- form -->