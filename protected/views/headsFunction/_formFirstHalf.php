<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$total = $reg->reg_attendence+$reg->reg_classTest+$reg->reg_midterm;
$range01=10;
$range02=20;
$range03=30;
yii::app()->session['reg'.$i] = serialize($reg);
?>

<?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                            array(
                            'id' => 'inlineForm-'.$i,
                            'type' => 'inline',
                            'method'=>'GET',
                            'htmlOptions'=>(array('autocomplete'=>'off')),
                            )
                        );?>

                        <a id="edit-<?php echo $i; ?>" class="btn btn-warning" style="display: inline-table;" href="#" data-toggle="tooltip" title="Edit Marks"><i class="icon-white icon-pencil"></i></a>
                        <?php
                      
                        echo CHtml::hiddenField('i',$i);
                        echo CHtml::hiddenField('moduleRegistrationID',$reg->moduleRegistrationID);
                        echo CHtml::textField('attendance-'.$i, $reg->reg_attendence,array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>true));
                        echo CHtml::textField('classTest-'.$i, $reg->reg_classTest,array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>true));
                        echo CHtml::textField('midterm-'.$i, $reg->reg_midterm,array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>true));
                        echo CHtml::textField('total-'.$i, $total,array('class'=>'span-2','style'=>'font-weight:bold; font-size:16px; text-align:right;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>2, 'required'=>true));
                        
                        ?>
                        
                        
                        
                            <?php 
                            //echo CHtml::ajaxLink('save', CController::createUrl('examRegistration/saveTest'),array('class'=>'btn btn btn-danger','style'=>'display:none;','data-toggle'=>'tooltip','title'=>'Save Marks','id'=>'save-',));
                        echo CHtml::ajaxSubmitButton('Save', CController::createUrl('facultiesFunction/saveMarks'), array('update'=>'#inlineForm-'.$i),array('class'=>'btn btn btn-danger','style'=>'display:none;','data-toggle'=>'tooltip','title'=>'Save Marks','id'=>'save-'.$i,));
                        ?>
                        
                        <a id="cancel-<?php echo $i; ?>" class="btn btn-success" style="display: none;" data-placement='right' href="#" data-toggle="tooltip" title="cancel editing"><i class="icon-white icon-refresh"></i></a>    <br/>
                        <span id="error-<?php echo $i; ?>" class="span-6" style="color: #EE5757; text-align: center;"> </span>
                        <?php
                        $this->endWidget();
                        unset($form);
                        unset($reg);
                       ?>
                        
<script type="text/javascript">
    
    
    
    
        $(function(){
        $(window).load(function () {
            //$("input[type=text]");
/*
            $("td:contains('modType')").remove(); 
            $("td:contains('Total Registered')").css('font-weight','bold');

            $("td:contains('Ready To Print')").siblings('td').children('input').replaceWith('<i class="icon-ok"></i>');


            $("td:contains('not')").siblings('td').children('a').remove();
            $("td:contains('not')").replaceWith('<td></td>');
*/
        });
    
        $(document).on('click','#edit-<?php echo $i; ?>',function() {
            
            //alert('<?php echo $i; ?>');
            $('#edit-<?php echo $i; ?>').hide('slow');
            $('#save-<?php echo $i; ?>').show('slow');
            $('#cancel-<?php echo $i; ?>').show('slow');
            $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
            $("#classTest-<?php echo $i; ?>").removeAttr('disabled');
            $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
        });
        
        $(document).on('click','#cancel-<?php echo $i; ?>',function() {
            
            //alert('<?php echo $i; ?>');
            $('#edit-<?php echo $i; ?>').show('slow');
            $('#save-<?php echo $i; ?>').hide('slow');
            $('#cancel-<?php echo $i; ?>').hide('slow');
            $("#attendance-<?php echo $i; ?>").attr('disabled','true');
            $("#classTest-<?php echo $i; ?>").attr('disabled','true');
            $("#midterm-<?php echo $i; ?>").attr('disabled','true');
        });
        
        $(document).on('click','#save-<?php echo $i; ?>',function() {
            
            //alert('<?php echo $i; ?>');
            $('#edit-<?php echo $i; ?>').show('slow');
            $('#save-<?php echo $i; ?>').hide('slow');
            $('#cancel-<?php echo $i; ?>').hide('slow');
            $("#attendance-<?php echo $i; ?>").attr('disabled','true');
            $("#classTest-<?php echo $i; ?>").attr('disabled','true');
            $("#midterm-<?php echo $i; ?>").attr('disabled','true');
            
            
            //-------------------------------------
        });
        
        $(document).on('keypress','#attendance-<?php echo $i; ?>',function() {
            var attendance = $("#attendance-<?php echo $i; ?>").val();
            var classTest =$("#classTest-<?php echo $i; ?>").val();
            var midTerm = $("#midterm-<?php echo $i; ?>").val();
            var total = parseFloat(attendance) +parseFloat(classTest)+parseFloat(midTerm);
            
            //alert(total);
            $("#total-<?php echo $i; ?>").val(total);
        });
        
        $(document).on('keypress','#classTest-<?php echo $i; ?>',function() {
            var attendance = $("#attendance-<?php echo $i; ?>").val();
            var classTest =$("#classTest-<?php echo $i; ?>").val();
            var midTerm = $("#midterm-<?php echo $i; ?>").val();
            var total = parseFloat(attendance) +parseFloat(classTest)+parseFloat(midTerm);
            
            //alert(total);
            $("#total-<?php echo $i; ?>").val(total);
        });
        
        $(document).on('keypress','#midterm-<?php echo $i; ?>',function() {
            var attendance = $("#attendance-<?php echo $i; ?>").val();
            var classTest =$("#classTest-<?php echo $i; ?>").val();
            var midTerm = $("#midterm-<?php echo $i; ?>").val();
            var total = parseFloat(attendance) +parseFloat(classTest)+parseFloat(midTerm);
            
            //alert(total);
            $("#total-<?php echo $i; ?>").val(total);
            
            
            
        });
        
        
     
         $(document).on('keyup','#attendance-<?php echo $i; ?>',function() {
            
            var range = parseFloat($("#attendance-<?php echo $i; ?>").val());
            
            //alert(attendance);
            
            
            
            if(range><?php echo $range01; ?> || range<0)
            {
                
            $("#classTest-<?php echo $i; ?>").attr('disabled','true');
            $("#midterm-<?php echo $i; ?>").attr('disabled','true');
                $("#save-<?php echo $i; ?>").attr('disabled','true');
                $("#error-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
                
            $("#classTest-<?php echo $i; ?>").removeAttr('disabled');
            $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                $("#save-<?php echo $i; ?>").removeAttr('disabled');
                $("#error-<?php echo $i; ?>").html('');
            }
            
        });
        
         $(document).on('keyup','#classTest-<?php echo $i; ?>',function() {
            
            var range = parseFloat($("#classTest-<?php echo $i; ?>").val());
            
            //alert(attendance);
            
            
            
            if(range><?php echo $range02; ?> || range<0)
            {
                $("#attendance-<?php echo $i; ?>").attr('disabled','true');
            
            $("#midterm-<?php echo $i; ?>").attr('disabled','true');
                $("#save-<?php echo $i; ?>").attr('disabled','true');
                $("#error-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
                $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
            
            $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                $("#save-<?php echo $i; ?>").removeAttr('disabled');
                $("#error-<?php echo $i; ?>").html('');
            }
            
        });
        
         $(document).on('keyup','#midterm-<?php echo $i; ?>',function() {
            
            var range = parseFloat($("#midterm-<?php echo $i; ?>").val());
            
            //alert(attendance);
            
            
            
            if(range><?php echo $range03; ?> || range<0)
            {
                $("#attendance-<?php echo $i; ?>").attr('disabled','true');
            $("#classTest-<?php echo $i; ?>").attr('disabled','true');
            
                $("#save-<?php echo $i; ?>").attr('disabled','true');
                $("#error-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
                $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
                $("#classTest-<?php echo $i; ?>").removeAttr('disabled');
            
                $("#save-<?php echo $i; ?>").removeAttr('disabled');
                $("#error-<?php echo $i; ?>").html('');
            }
            
        });
        
        
    
    });
    
</script>

