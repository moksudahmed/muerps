<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo yii::app()->session['mreExaminationID'];

yii::app()->session['regOldStu'.$i] = serialize($regOldStu);
$range04=40;
$range06=60;

?>

<?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                            array(
                            'id' => 'inlineFormFinal'.$i,
                            'type' => 'inline',
                                'method'=>'GET',
                           'htmlOptions'=>(array('autocomplete'=>'off',)),
                            )
                        ); ?>
                        
                        <a id="edit-<?php echo $i; ?>" class="btn btn-warning" style="display: inline-table;" href="#" data-toggle="tooltip" title="Edit Marks"><i class="icon-white icon-pencil"></i></a>
                        <?php 
                        
                        
                        echo CHtml::textField('subTotal-'.$i, $regOldStu['subTotal'],array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>(!$regOldStu['absent']?false:true),'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>5, 'disabled'=>true,'required'=>true));
                        echo CHtml::textField('final-'.$i, $regOldStu['final'],array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>(!$regOldStu['absent']?false:true),'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>5, 'disabled'=>true,'required'=>true));
                        
                         echo CHtml::textField('grandTotal-'.$i, ($regOldStu['absent']=='t'?'AB':$regOldStu['subTotal']+$regOldStu['final']),array('class'=>'span-2','style'=>'font-weight:bold; font-size:16px; text-align:right;','disabled'=>true));
                        echo CHtml::hiddenField('i',$i);
                        echo CHtml::hiddenField('moduleRegistrationID',$regOldStu['moduleRegistrationID']);
                        ?>
                        
                        
                        
                            <?php 
                        echo CHtml::ajaxSubmitButton('Save', CController::createUrl('examRegistration/saveTest'), array('update'=>'#inlineFormFinal'.$i),array('class'=>'btn btn btn-danger','style'=>'display:none;','data-toggle'=>'tooltip','title'=>'Save Marks','id'=>'save-'.$i,));
                        ?>
                        
                        <a id="cancel-<?php echo $i; ?>" class="btn btn-success" style="display: none;" data-placement='right' href="#" data-toggle="tooltip" title="cancel editing"><i class="icon-white icon-refresh"></i></a>    
                         <div id="ab-<?php echo $i; ?>" class="span-4" style="display: none; padding: 0px 0px 0px 0px; ">
                             <span id="error-<?php echo $i; ?>"  style="float:left; color: #EE5757; "> </span>
                            <span style="float:right" > <?php  // echo   CHtml::radioButtonList('absent-'.$i,$regSup['absent'],array(1=>'present',0=>'absent'),array('labelOptions'=>array('style'=>'display:inline; padding-right:10px'), 'separator'=>'  ',));
                                echo CHtml::checkBox('absent-'.$i, $regOldStu['absent']);
                                ?><strong>absent</strong> </span>
                         
                            
                         </div>
                        
                        
                        
                        <?php
                        $this->endWidget();
                        unset($form);
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
            $('#ab-<?php echo $i; ?>').show('slow');
            $('#cancel-<?php echo $i; ?>').show('slow');
            $("#subTotal-<?php echo $i; ?>").removeAttr('disabled');
            
            
            //alert($("#absent-<?php echo $i; ?>").val());
        if (!$("#absent-<?php echo $i; ?>").prop('checked')){
            $("#final-<?php echo $i; ?>").removeAttr('disabled');
        }
        
        
           
        });
        
        $(document).on('click','#cancel-<?php echo $i; ?>',function() {
            
            //alert('<?php echo $i; ?>');
            $('#edit-<?php echo $i; ?>').show('slow');
            $('#save-<?php echo $i; ?>').hide('slow');
            $('#cancel-<?php echo $i; ?>').hide('slow');
            $('#ab-<?php echo $i; ?>').hide ('slow');
            $("#final-<?php echo $i; ?>").attr('disabled','true');
           
        });
        
        $(document).on('keypress','#final-<?php echo $i; ?>',function() {
            var final = $("#final-<?php echo $i; ?>").val();
            var total =$("#subTotal-<?php echo $i; ?>").val();
            
            var grandTotal = parseFloat(final) +parseFloat(total);
            
            //alert(total);
            $("#grandTotal-<?php echo $i; ?>").val(grandTotal);
        });
        
        
        $(document).on('keyup','#final-<?php echo $i; ?>',function() {
            var range = parseFloat($("#final-<?php echo $i; ?>").val());
            
            if(range><?php echo $range04; ?> || range<0)
            {
             
            
                $("#save-<?php echo $i; ?>").attr('disabled','true');
                       $("#absent-<?php echo $i; ?>").attr('disabled','true');
                $("#error-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
            
                $("#save-<?php echo $i; ?>").removeAttr('disabled');
                       $("#absent-<?php echo $i; ?>").removeAttr('disabled');
                $("#error-<?php echo $i; ?>").html('');
            }
            
            
            
            
        });
        
        $(document).on('keypress','#subTotal-<?php echo $i; ?>',function() {
            var final = $("#final-<?php echo $i; ?>").val();
            var total =$("#subTotal-<?php echo $i; ?>").val();
            var grandTotal = parseFloat(final) +parseFloat(total);
            /*
            var attendance = 100*parseFloat(total)/20;
            alert(attendance);
            var classTest = 100*parseFloat(total)/30;
            var midterm = 100*parseFloat(total)/50;
            
           
            //alert(total);
            
            $("#attendance-<?php echo $i; ?>").val(attendance);
            $("#classTest-<?php echo $i; ?>").val(classTest);
            $("#midterm-<?php echo $i; ?>").val(midterm);
            */
            $("#grandTotal-<?php echo $i; ?>").val(grandTotal);
        });
        
        
        $(document).on('keyup','#subTotal-<?php echo $i; ?>',function() {
            var range = parseFloat($("#subTotal-<?php echo $i; ?>").val());
            
            if(range><?php echo $range06; ?> || range<0)
            {
             
            
                $("#save-<?php echo $i; ?>").attr('disabled','true');
                       $("#absent-<?php echo $i; ?>").attr('disabled','true');
                $("#error-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
            
                $("#save-<?php echo $i; ?>").removeAttr('disabled');
                       $("#absent-<?php echo $i; ?>").removeAttr('disabled');
                $("#error-<?php echo $i; ?>").html('');
            }
            
            
            
            
        });
        
    
    $( "#absent-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            $("#final-<?php echo $i; ?>").val(0);
            $("#grandTotal-<?php echo $i; ?>").val('AB');
            $("#final-<?php echo $i; ?>").attr('disabled','true');
        }
        else 
        {
            $("#grandTotal-<?php echo $i; ?>").val($("#subTotal-<?php echo $i; ?>").val());
            $("#final-<?php echo $i; ?>").removeAttr('disabled');
        }
        

    } );
        
    
    
    
    
    });
    
</script>