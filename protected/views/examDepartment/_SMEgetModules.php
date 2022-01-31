<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

                <strong>Select Course:</strong>
            		
                <br/>
                <?php echo CHtml::dropDownList('offeredModuleID','', 
                        CHtml::listData(FormUtil::getSMEgetModules($ofmModule),'offeredModuleID','mod_name','mod_group')
                        ,array(
                        'prompt' => '--Please Select --',
                        'value' => '0',
                            'required'=>true,
                    
                          
                            )
                        ); ?>
<br/>
                  <?php 
                            //echo CHtml::ajaxLink('save', CController::createUrl('examRegistration/saveTest'),array('class'=>'btn btn btn-danger','style'=>'display:none;','data-toggle'=>'tooltip','title'=>'Save Marks','id'=>'save-',));
                       // echo  CHtml::ajaxSubmitButton('Student Id', CController::createUrl('examRegistration/getStudentID'), array('update'=>'#studentID'),array('class'=>'btn btn-large btn-info','style'=>'','data-toggle'=>'tooltip','title'=>'Save Marks',));
                 echo  CHtml::submitButton('Marks Entry Form', array('class'=>'btn btn-large btn-info','style'=>'',))."  ";
                 //echo  CHtml::link('Registered List',array('examRegistration/examRegisteredSuppleList'), array('class'=>'btn btn-large btn-success','style'=>''));
                        ?>