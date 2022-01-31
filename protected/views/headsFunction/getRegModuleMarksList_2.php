<?php
/* @var $this ModuleController */
/* @var $model Module */
if(yii::app()->user->getState('role')==='head'){
    

    $this->breadcrumbs=array(
        'Heads Functionalities'=>array('headsFunction/index'),

        'Marks Entry'
        );
}
else if(yii::app()->user->getState('role')==='faculty')
{
        $this->breadcrumbs=array(
        'Faculties Functionalities'=>array('facultiesFunction/index'),

        'Marks Entry'
        );
}
else if(yii::app()->user->getState('role')==='super-admin'){
    

    $this->breadcrumbs=array(
        'Heads Functionalities'=>array('headsFunction/index'),

        'Marks Entry'
        );
}



?>
<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 
$secondHalfMarks= $markingScheme->mrs_final;
    
    
    ?>


    <div class="title ">
        <div class="span-16">
            <h3 >Marks Entry For: [<?php echo $firstHalfMarks; ?>] </h3>
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['mreTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['mreYear']; ?></span></h4>
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            <h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['MainFacultyName']; ?></span></h4>
            
            
              
        </div>
        <div class="span-7">
            <h4><strong>Batch: </strong><span class="label label-success"> <?php echo yii::app()->session['mreBatch'].FormUtil::getBatchNameSufix(yii::app()->session['mreBatch']); ?>  </span><strong>Section: </strong><span class="label label-important"> <?php echo yii::app()->session['mreSection']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
<?php 
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
        array('label'=>'Generate 60 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('Generate60PDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	array('label'=>'Result Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('resultSheet'),  'visible'=>true),	
	),
));


    
                        

$range01=10;
$range02=20;
$range03=30;
$range04=40;

    



?>
        </div>
    </div>
<div class="span-24">
    <?php  if ($moduleReg !== null):?>
    
    
  
                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                            array(
                            'id' => 'inlineForm',
                            'type' => 'inline',
                            'method'=>'POST',
                            'htmlOptions'=>(array('autocomplete'=>'off')),
                            
                            'action'=>CController::createUrl('headsFunction/saveTotalMarks'),
                        )
                            );
                    ?>

<table class="table table-bordered span-24">
    <thead>
	<tr>
                <th >
		      Student ID		
                </th>
		<th >
		      Name	
                </th>
 		<th  style="text-align:left;" >
                    
                    <?php echo CHtml::checkBox('pass',false,array('id'=>'pass'));?>
                    <span style="padding-left:0px;"> Att ( <?php echo $markingScheme->mrs_attendance; ?> ) -- CT ( <?php echo $markingScheme->mrs_classTest; ?> ) -- MT ( <?php echo $markingScheme->mrs_midterm; ?> )</span>
                    
                    <span style="font-size: 15px"> Total <?php echo $firstHalfMarks; ?></span>
                    
                </th>
                
                <th >
             <?php echo CHtml::checkBox('passFinal',false,array('id'=>'passFinal'));?>
                    <span style="font-size: 15px; padding: 0px 17px 0px 10px;"> Final  (<?php echo $secondHalfMarks; ?>) </span>
                   <span style="font-size: 15px; "> out of  <?php echo $secondHalfMarks+$firstHalfMarks; ?></span>
                </th>
        </tr>
    </thead>
    <tbody>
    
         
	<?php  foreach($moduleReg as $row): ?>
                         <?php $reg= ModuleRegistration::model()->findByPk($row['moduleRegistrationID']); 
                    $total = $reg->reg_attendence+$reg->reg_classTest+$reg->reg_midterm;
                    ?>
	<tr>
                <td style="font-weight:bold;" class="span-2">
			<?php echo $row['studentID']; ?>
		</td>
       		<td class="span-4">
			<?php echo $row['per_name']; ?>
		</td>
                
                <td class="span-19">
                    <span><?php echo CHtml::checkBox('pass['.$reg->moduleRegistrationID.']',false,array('id'=>'pass-'.$reg->moduleRegistrationID));?></sapn>
                <?php     $i= $reg->moduleRegistrationID;                  
                                    echo CHtml::hiddenField("id[".$reg->moduleRegistrationID."]",$reg->moduleRegistrationID);
                                    echo CHtml::textField("attendance[".$reg->moduleRegistrationID."]", ($reg->reg_attendence==0?null:$reg->reg_attendence),array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>false,'id'=>"attendance-".$reg->moduleRegistrationID));
                                    echo CHtml::textField("classTest[".$reg->moduleRegistrationID."]", ($reg->reg_classTest==0?null:$reg->reg_classTest),array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>false,'id'=>"classTest-".$reg->moduleRegistrationID));
                                    echo CHtml::textField("midterm[".$reg->moduleRegistrationID."]", ($reg->reg_midterm==0?null:$reg->reg_midterm),array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>false,'id'=>"midterm-".$reg->moduleRegistrationID));
                                    echo CHtml::textField("total[".$reg->moduleRegistrationID."]", ($total==0?null:$total),array('class'=>'span-2','style'=>'font-weight:bold; font-size:16px; text-align:right;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>2, 'required'=>false,'id'=>"total-".$reg->moduleRegistrationID));
                 ?>                
                
                    <span id="error-<?php echo $i; ?>" class="span-3" style="color: #EE5757; text-align: center;"> </span>  
               
         
                      
                      
                                            
                    <script type="text/javascript">
    



                            $(function(){





                            $(document).on('keypress','#attendance-<?php echo $i; ?>',function() {
                                var attendance = $("#attendance-<?php echo $i; ?>").val();
                                var classTest =$("#classTest-<?php echo $i; ?>").val();
                                var midTerm = $("#midterm-<?php echo $i; ?>").val();
                                var total = parseFloat(attendance) +parseFloat(classTest)+parseFloat(midTerm);

                               // alert(total);
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



                                if(range><?php echo $range02; ?> || range<0)
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



                                if(range><?php echo $range03; ?> || range<0)
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
                <td class="">
                    <?php
                    $examID=yii::app()->session['examinationID'];
                    $sql = "select * from vw_getsecondhalfmarkslist where \"moduleRegistrationID\"={$reg->moduleRegistrationID} and \"examinationID\"={$examID};";
                    
                    
                        //$regFinal= ModuleRegistration::model()->findBySql($sql,array(':regID'=>$reg->moduleRegistrationID,':examID'=>yii::app()->session['mreExaminationID'])); 
                    //echo $sql;    
                    $regFinal= ModuleRegistration::model()->findBySql($sql); 
                        
                      //echo $regFinal['subTotal'];
                        ?>
                       <span class=''><?php echo CHtml::checkBox('passFinal['.$i.']',false,array('id'=>'passFinal-'.$i));?></sapn>
                    <?php
                        echo CHtml::textField('fi['.$i.']', ($regFinal['final']==0?null:$regFinal['final']),array('class'=>'span-2','style'=>'font-size:16px;','disabled'=>(!$regFinal['absent']?false:true),'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>5, 'disabled'=>true,'required'=>false,'id'=>'fi-'.$i));
                        
                        echo CHtml::textField('grandTotal['.$i.']', ($regFinal['absent']=='t'?'AB':($regFinal['final']==0?null:$regFinal['subTotal']+$regFinal['final'])),array('class'=>'span-2','style'=>'font-weight:bold; font-size:16px; text-align:right;','disabled'=>true,'id'=>'grandTotal-'.$i));
                        echo CHtml::textField('grandPoint['.$i.']',  FormUtil::gradePoint($regFinal['subTotal']+$regFinal['final']),array('style'=>'font-weight:bold;width:30px; font-size:16px; text-align:right;','disabled'=>true,'id'=>'grandPoint-'.$i)); 
                        echo CHtml::hiddenField('moduleRegistrationID['.$i.']',$regFinal['moduleRegistrationID']);
                        ?>
                        
                        
                            <span style="float:right" > 
                                <?php  
                                echo CHtml::checkBox('absent['.$i.']', ($regFinal['absent']==1?'checked':''),array('disabled'=>true,'id'=>'absent-'.$i));
                                ?><strong>absent</strong> 
                            </span>
                       <span id="error2-<?php echo $i; ?>"  style="float:left; color: #EE5757; "> </span>
                                  <script type="text/javascript">
    
    
                    function gradePoint(totalmark){
                        
        if(totalmark>=80 && totalmark<=100){ return 'A+';}
	else if(totalmark>=75 && totalmark<80){return 'A';}
	else if (totalmark>=70 && totalmark<75){ 
		return 'A-';}
	else if (totalmark>=65 && totalmark<70) {
		return 'B+';}
	else if (totalmark>=60 && totalmark<65) {
		return 'B';}
	else if (totalmark>=55 && totalmark<60) {
		return 'B-';}
	else if (totalmark>=50 && totalmark<55) {
		return 'C+';}
	else if (totalmark>=45 && totalmark<50) {
		return 'C';}
	else if (totalmark>=40 && totalmark<45) {
		return 'D';}
	else { return 'F*';}

                    }
    
        $(function(){
    
    
        
        $(document).on('keypress','#fi-<?php echo $i; ?>',function() {
            var final = $("#fi-<?php echo $i; ?>").val();
            var total =$("#total-<?php echo $i; ?>").val();
            
            var grandTotal = parseFloat(final) +parseFloat(total);
            
            //alert(gradePoint(total));
            $("#grandTotal-<?php echo $i; ?>").val(grandTotal);
            $("#grandPoint-<?php echo $i; ?>").val(gradePoint(grandTotal));
            $("#grandPoint-<?php echo $i; ?>").css('');
        });
        
        
        $(document).on('keyup','#fi-<?php echo $i; ?>',function() {
            var range = parseFloat($("#fi-<?php echo $i; ?>").val());
            
            if(range><?php echo $range04; ?> || range<0)
            {
             
            //$("#fi-<?php echo $i; ?>").attr('disabled','true');
                $("#save").attr('disabled','true');
                       $("#absent-<?php echo $i; ?>").attr('disabled','true');
                $("#error2-<?php echo $i; ?>").html('out of range');
            }
            else 
            {
            //$("#fi-<?php echo $i; ?>").removeAttr('disabled');
                $("#save").removeAttr('disabled');
                       $("#absent-<?php echo $i; ?>").removeAttr('disabled');
                $("#error2-<?php echo $i; ?>").html('');
            }
            
            
            
            
        });
        
    
    $( "#absent-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            $("#fi-<?php echo $i; ?>").val(0);
            $("#grandTotal-<?php echo $i; ?>").val('AB');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
        }
        else 
        {
            $("#grandTotal-<?php echo $i; ?>").val($("#total-<?php echo $i; ?>").val());
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
        }
        

    } );
        
    $( "#passFinal").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
            $("#absent-<?php echo $i; ?>").removeAttr('disabled');
           
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
           
            $("#passFinal-<?php echo $i; ?>").attr('checked','true');
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").removeAttr('checked');
        }
        

    } );
        
    $( "#passFinal-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
            $("#absent-<?php echo $i; ?>").removeAttr('disabled');
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
            $("#passFinal-<?php echo $i; ?>").attr('checked','true');
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").removeAttr('checked');
        }
        

    } );
    
    $( "#save").on( "click", function()
                            {


                                    $("#fi-<?php echo $i; ?>").removeAttr('disabled');
                                    
                                    $("#absent-<?php echo $i; ?>").removeAttr('disabled');
                                

                            } );
    });
    
</script>
                  
                </td> 
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                     
                    <td style="text-align:center; padding-left: 60px;">
                        
                <?php  endforeach;
     echo CHtml::submitButton('Save',array('class'=>'btn btn-large btn-success','style'=>'text-align:center; display:inline; width:300px;','data-toggle'=>'tooltip','title'=>'Save Marks','disabled'=>true,'id'=>'save'));
                        $this->endWidget();
     ?>

                    </td>
                    
                    
                </tr>
                
    </tbody>
     

    </table>
<?php endif; ?>
    
    
</div>



