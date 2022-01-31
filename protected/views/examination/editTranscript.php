<?php
/* @var $this AdministrativeReportController */

$this->breadcrumbs=array(
   'Examination'=>array('site/ExamDepartment'),    
   'Transcript'=>array('index'),
   'Transcript',
);
?>
<div class="title">
    <h3>Transcript</h3>    
    <h4><strong>Student ID: </strong> <span  class="label label-important" > <?php  echo  $sid; ?></span></h4>
</div>
 <?php  if ($rows !== null):
        $model = new Examination();
     ?>
    
 
  
                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                            array(
                            'id' => 'inlineForm',
                            'type' => 'inline',
                            'method'=>'POST',
                            'htmlOptions'=>(array('autocomplete'=>'off')),
                            
                            'action'=>CController::createUrl('updateTranscript'),
                        )
                            );
                   ?>
        <table class="table table-bordered span-24">
         <thead>
	<tr>
                <th >
		      Code		
                </th>
		        <th >
		      Title	
                </th>
                <th>Edit</th>

                <th >
                    Group
                     <?php echo CHtml::hiddenField('sid', $sid);?>
                </th>
                <th>Credit Hour</th>
                <th>Grade</th>
                <th>Grade Point</th>  
                <th>Remove</th>               
                
        </tr>
    </thead>
    <tbody>
        <?php 
            $pos = 0;
            foreach($rows as $row):  $i = $row['c_modulecode'];   
                            
        ?>
        <tr>
           <td style="font-weight:bold;" class="span-4">
			<?php echo $row['c_modulecode']; 
                          echo CHtml::hiddenField("code[".$row['c_modulecode']."]", $row['c_modulecode']);                                                     

                              
                        ?>
	   </td>
        
            <td style="font-weight:bold;" class="span-8">
			<?php 
                     //   echo CHtml::textField("attendance[".$row['c_title']."]", ($row['c_title']==0?null:$row['c_title']),array('class'=>'','style'=>'font-size:16px; width:35px; padding:5px 8px 5px 8px;','disabled'=>true,'required'=>false,'id'=>"attendance-".$row['c_title']));
                        echo $row['c_title'];
                        echo CHtml::hiddenField("title[".$row['c_title']."]", $row['c_title']);                                                     
                     
                        ?>
	    </td>
            
           <td class="span-2">
            <?php echo CHtml::checkBox('pass['.$row['c_modulecode'].']',false,array('id'=>'pass-'.$row['c_modulecode']));?>             
              <script type="text/javascript">
    



                            $(function(){

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



                                if( range<0)
                                {

                                $("#classTest-<?php echo $i; ?>").attr('disabled','true');
                                $("#midterm-<?php echo $i; ?>").attr('disabled','true');
                                    $("#save").attr('disabled','true');
                                    $("#error-<?php echo $i; ?>").html('out of range');
                                }
                                else 
                                {

                                $("#classTest-<?php echo $i; ?>").removeAttr('disabled');
                                $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#save").removeAttr('disabled');
                                    $("#error-<?php echo $i; ?>").html('');
                                }

                            });


                             $(document).on('keyup','#classTest-<?php echo $i; ?>',function() {

                                var range = parseFloat($("#classTest-<?php echo $i; ?>").val());

                                //alert(attendance);



                                if(range<0)
                                {
                                    $("#attendance-<?php echo $i; ?>").attr('disabled','true');

                                $("#midterm-<?php echo $i; ?>").attr('disabled','true');
                                    $("#save").attr('disabled','true');
                                    $("#error-<?php echo $i; ?>").html('out of range');
                                }
                                else 
                                {
                                    $("#attendance-<?php echo $i; ?>").removeAttr('disabled');

                                $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#save").removeAttr('disabled');
                                    $("#error-<?php echo $i; ?>").html('');
                                }

                            });

                             $(document).on('keyup','#midterm-<?php echo $i; ?>',function() {

                                var range = parseFloat($("#midterm-<?php echo $i; ?>").val());

                                //alert(attendance);



                                if( range<0)
                                {
                                    $("#attendance-<?php echo $i; ?>").attr('disabled','true');
                                $("#classTest-<?php echo $i; ?>").attr('disabled','true');

                                    $("#save").attr('disabled','true');
                                    $("#error-<?php echo $i; ?>").html('out of range');
                                    
                                }
                                else 
                                {
                                    $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#classTest-<?php echo $i; ?>").removeAttr('disabled');

                                    $("#save").removeAttr('disabled');
                                    $("#error-<?php echo $i; ?>").html('');
                                }

                            });

                        $( "#pass").on( "click", function()
                            {


                                if ( $(this).prop('checked') ){

                                    $("#save").removeAttr('disabled');
                                    
                                    $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
                                   
                                    $("#classTest-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                                   
                                    $("#pass-<?php echo $i; ?>").attr('checked','true');
                                }
                                else 
                                {
                                    $("#save").attr('disabled','true');
                                    $("#attendance-<?php echo $i; ?>").attr('disabled','true');
                                    $("#classTest-<?php echo $i; ?>").attr('disabled','true');
                                    $("#midterm-<?php echo $i; ?>").attr('disabled','true');
                                    $("#pass-<?php echo $i; ?>").removeAttr('checked');
                                }


                            } );

                            $( "#pass-<?php echo $i; ?>").on( "click", function()
                            {


                                if ( $(this).prop('checked') ){                                   
                                    $("#save").removeAttr('disabled');
                                    $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#classTest-<?php echo $i; ?>").removeAttr('disabled');
                                }
                                else 
                                {
                                    $("#save").attr('disabled','true');
                                    $("#attendance-<?php echo $i; ?>").attr('disabled','true');
                                    $("#midterm-<?php echo $i; ?>").attr('disabled','true');
                                    $("#classTest-<?php echo $i; ?>").attr('disabled','true');
                                }


                            } );

                            $( "#save").on( "click", function()
                            {


                                    $("#attendance-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#midterm-<?php echo $i; ?>").removeAttr('disabled');
                                    $("#classTest-<?php echo $i; ?>").removeAttr('disabled');


                            } );
                           
                        });

                    </script>
                </td>
            <td class="span-2">
              
              <?php     
              echo CHtml::dropDownList('group['.$row['c_modulecode'].']', $row['c_mod_group'], 
              DBhelper::getGroupOptions(),
              array('empty' => $row['c_mod_group'], 'style'=>'font-size:16px;','disabled'=>false));
               ?>         
                
            </td>
 
            <td class="span-1">
                
                <?php

                echo CHtml::textField('credithour['.$row['c_modulecode'].']',$row['c_mod_credithour'],array('size'=>2,'id' => 'credithour'));
                
                ?>
                
                
            </td>
              <td>
                <?php echo $row['c_lettergrade']; ?>
            </td>
            <td>
                <?php echo $row['c_cgpa']; ?>
                   <?php 
             echo CHtml::hiddenField("id[".$row['c_modulecode']."]",$row['c_modulecode']);
             $i= $row['c_modulecode'];   
            ?>
            </td>
            <td><?php echo CHtml::checkBox('remove['.$pos.']',false,array('id'=>'remove-'.$pos));?></td>
        </tr>
          <?php $pos = $pos + 1;  endforeach; ?>
        <tr>
            <td></td><td></td><td></td><td></td>            
            <td><?php echo CHtml::submitButton('Continue to generate transcript',array('class'=>'btn btn-large btn-success','style'=>'text-align:center; display:inline; width:300px;','data-toggle'=>'tooltip','title'=>'Continue to generate transcript','disabled'=>false,'id'=>'save'));?>
           </td>
           
        </tr>
    </tbody>
        
   
        <?php     
        $this->endWidget();
        endif; 
        ?>
 
        </table>
