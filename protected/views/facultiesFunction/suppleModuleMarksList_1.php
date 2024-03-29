<?php
/* @var $this ModuleController */
/* @var $model Module */

        
            $this->breadcrumbs=array(
                'Faculty Activities'=>array('facultiesFunction/index'),
                
                'Supplementary Marks Entry'
                );
        


?>
<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 
$secondHalfMarks= $markingScheme->mrs_final;
    
    if(FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['suppleTerm'], yii::app()->session['suppleYear']))
    {
        $saveFlag=TRUE;
    }
    else
    {
        $saveFlag=FALSE;
    }
    
    ?>


    <div class="title ">
        <div class="span-16">
            <h3 >Supplementary Marks Entry</h3>

            <!--h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['mreSection'],yii::app()->session['mreBatch'],yii::app()->session['mreProCode'] ); ?></h4-->
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            <!--h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['mreFacultyName']; ?></span></h4-->
            
            
              
        </div>
        <div class="span-7">
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['suppleTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['suppleYear']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
            <h6> <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Supplementary Examination ".yii::app()->session['mreYear'];?></h6>
<?php 

//$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('facultiesFunction/index') : Yii::app()->controller->createUrl('headsFunction/courseAuthentication'));
//$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Course Authentication');

$backUrl = Yii::app()->controller->createUrl('facultiesFunction/index');
$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Course Authentication');

if($saveFlag){
    $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'pills',
            'items'=>array(

            //array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>$backTitle,), 'visible'=>true),	
            //array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
              //  array('label'=>'XLS-template', 'icon'=>'icon-arrow-right' , 'url'=>Yii::app()->controller->createUrl('supplyTemplateXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'go to template',), 'visible'=>true),
                array('label'=>'XLSX-template', 'icon'=>'icon-download' , 'url'=>'#', 'linkOptions'=>array('id'=>'xlsx','style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download Template',), 'visible'=>true),
            ),
    ));
}
else 
{
    $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'pills',
            'items'=>array(

            //array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>$backTitle,), 'visible'=>true),	
            //array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
              //  array('label'=>'XLS-template', 'icon'=>'icon-arrow-right' , 'url'=>Yii::app()->controller->createUrl('supplyTemplateXLS'), 'linkOptions'=>array('style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'go to template',), 'visible'=>true),
    //            array('label'=>'XLSX-template', 'icon'=>'icon-download' , 'url'=>'#', 'linkOptions'=>array('id'=>'xlsx','style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download Template',), 'visible'=>true),
            ),
    ));
    
    
}
?>
           
  
        <?php if($saveFlag): ?>
            
            <form>
                <div class="custom-file">
                    <input type="file" class="fileinput-button" id="customFile" title="XLSX file to upload" />
                  <!--label class="custom-file-label" for="customFile">Choose file</label-->
                </div>
                
            </form>
        <?php endif ?>
              <script type="text/javascript">
             
      
            
    
              $('#customFile').on("change",function(e){
                         
                var files = e.target.files, f = files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                  var data = new Uint8Array(e.target.result);
                  var wb = XLSX.read(data, {type: 'array'});
                  console.log(wb);
                  wb.SheetNames.forEach((item)=>{
                      var ws =  wb.Sheets[item];
                      
                     console.log(renderData(ws));
                     
                // var allData = XLSX.utils.sheet_to_csv(ws, { strip: true, blankrows: false })
                 
              //      console.log(allData);
                    
                  });

                 

    
                  /* DO SOMETHING WITH workbook HERE */
                };
                reader.readAsArrayBuffer(f);
              
               
                //$('#wrapper')[0].innerHTML += htmlstr;
               
                  
              });
              
              
              function renderData(ws) {
                    var allData = XLSX.utils.sheet_to_csv(ws, { strip: true, blankrows: true });

                    var dataRaw = allData.split("\n");
                    
                    var insertString='';
                    var programme;
                    var batch;
                    var section;
                    var code;


                    var patt = new RegExp("^[0-9]{3}-[0-9]{3}-[0-9]{3}$");
             //       var counter = 0;
                    var counter2 = 0;
                    /*
                    dataRaw.forEach((i) => {
                        var dataCell = i.split(',');

                        if (dataCell[0].toLowerCase().trim() == 'programme name:') programme = dataCell[1];
                        if (dataCell[0].toLowerCase().trim() == 'batch name:') batch = dataCell[1];
                        if (dataCell[0].toLowerCase().trim() == 'section name:') section = dataCell[1];
                        if (dataCell[0].toLowerCase().trim() == 'course code:') code = dataCell[1];
                        if (patt.test(dataCell[0].trim())) counter++;

                    });
                    */
                    dataRaw.forEach((item) => {
                        var arr = item.split(',');

                        var    dataCell = arr.filter(item => item);


                        if (patt.test(dataCell[0])) {
                            counter2++;
                            //insertString += "('" + programme + "','" + batch + "','" + section + "','" + code + "','" + dataCell[0] + "'," + dataCell[1] + "," + dataCell[2] + "," + dataCell[3] + "," + dataCell[5] + ")" + (counter2 < counter ? ',' : ';');
                            
                            //insertString += "('" + dataCell[0] + "'," + dataCell[1] + "," + dataCell[2] + "," + dataCell[3] + "," + dataCell[4] +"," + dataCell[5] +"," + dataCell[6] + "),";
                            insertString += "('" + dataCell[0] + "'," + dataCell[1]+")";
                            
                            if(!nanToZero(dataCell[1]) ||  dataCell[1].toLowerCase().trim()=='ab')
                            {
                                $('#'+dataCell[0]).find("input[id^='grandTotal-']").val('AB');
                                $('#'+dataCell[0]).find("input[id^='fi-']").val(0);
                                
                                
                                $('#'+dataCell[0]).find("input[id^='absent-']").prop('checked',true);
                            }
                            else{
                                $('#'+dataCell[0]).find("input[id^='fi-']").val(dataCell[1]);
                                var total = $('#'+dataCell[0]).find("input[id^='total-']").val();
                                var grandTotal = nanToZero(parseFloat(total)) + nanToZero(parseFloat(dataCell[1]));
                                $('#'+dataCell[0]).find("input[id^='grandTotal-']").val(grandTotal);
                                $('#'+dataCell[0]).find("input[id^='grandPoint-']").val(gradePoint(grandTotal));
                            }
                        }
                    });
                    //console.log(counter);
                    //console.log(programme + " " + batch + " " + section + " " + code + "\n");
                    //console.log(insertString);
                    return insertString;
                }
              
              </script>
        </div>
            
    </div>

<div class="span-24">
    <div id="wrapper"></div>
    <?php 
    

            $range01=10;
            $range02=20;
            $range03=30;
            $range04=40;

    ?>
    <?php  if ($moduleReg !== null):?>
    
    
  
                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                            array(
                            'id' => 'inlineForm',
                            'type' => 'inline',
                            'method'=>'POST',
                            'htmlOptions'=>(array('autocomplete'=>'off')),
                            
                            'action'=>CController::createUrl('saveSuppleMarks'),
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
                    
                    <?php // echo CHtml::checkBox('pass',false,array('id'=>'pass','disabled'=>'true'));?>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> At <?php echo $markingScheme->mrs_attendance; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> Ct <?php echo $markingScheme->mrs_classTest; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> Mt <?php echo $markingScheme->mrs_midterm; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 33px; "> <?php echo $firstHalfMarks; ?></span>
                    
                </th>
                
                <th >
             <?php echo ($saveFlag ? CHtml::checkBox('passFinal',false,array('id'=>'passFinal')):'');?>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> Fi  <?php echo $secondHalfMarks; ?> </span>
                   <span style="font-size: 15px; padding: 0px 0px 0px 27px;">   <?php echo $secondHalfMarks+$firstHalfMarks; ?></span>
                   <span style="font-size: 15px; padding: 0px 0px 0px 33px;">   LG</span>
                </th>
        </tr>
    </thead>
    <tbody>
    
         
	<?php  foreach($moduleReg as $row): ?>
                         <?php $reg= ModuleRegistration::model()->findByPk($row['moduleRegistrationID']); 
                    $total = $reg->reg_attendence+$reg->reg_classTest+$reg->reg_midterm;
                    ?>
	<tr id="<?php echo $row['studentID']; ?>">
                <td style="font-weight:bold;" class="span-4">
			<?php echo $row['studentID']; ?>
		</td>
       		<td class="span-6">
			<?php echo $row['per_name']; ?>
		</td>
                
                <td  class="span-10">
                    <?php // echo CHtml::checkBox('pass['.$reg->moduleRegistrationID.']',false,array('id'=>'pass-'.$reg->moduleRegistrationID,'disabled'=>'true'));?>
                <?php     $i= $reg->moduleRegistrationID;                  
                                    echo CHtml::hiddenField("id[".$reg->moduleRegistrationID."]",$reg->moduleRegistrationID);
                                 ?>
                    <?php
                                    echo CHtml::textField("attendance[".$reg->moduleRegistrationID."]", ($reg->reg_attendence==0?null:$reg->reg_attendence),array('class'=>'','style'=>'font-size:16px; width:35px; padding:5px 8px 5px 8px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>false,'id'=>"attendance-".$reg->moduleRegistrationID));
                                    ?>
                    <?php
                                    echo CHtml::textField("classTest[".$reg->moduleRegistrationID."]", ($reg->reg_classTest==0?null:$reg->reg_classTest),array('class'=>'','style'=>'font-size:16px; width:35px; padding:5px 8px 5px 8px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>false,'id'=>"classTest-".$reg->moduleRegistrationID));
                                    ?>
                    <?php
                                    echo CHtml::textField("midterm[".$reg->moduleRegistrationID."]", ($reg->reg_midterm==0?null:$reg->reg_midterm),array('class'=>'','style'=>'font-size:16px; width:35px; padding:5px 8px 5px 8px;','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'required'=>false,'id'=>"midterm-".$reg->moduleRegistrationID));
                                    ?>
                    <?php
                                    echo CHtml::textField("total[".$reg->moduleRegistrationID."]", ($total==0?null:$total),array('class'=>'','style'=>'font-weight:bold; font-size:16px; width:35px; padding:5px 8px 5px 8px; ','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>2, 'required'=>false,'id'=>"total-".$reg->moduleRegistrationID));
                 ?>                
                
                    <span id="error-<?php echo $i; ?>" class="span-4" style="color: #EE5757; text-align: center;"> </span>  
               
         
                </td>
                <td  class="span-4">
                    <?php
                    
                    $examID=yii::app()->session['examinationID'];
                    
                    $sql = "select * from vw_getsecondhalfmarkslist where \"moduleRegistrationID\"={$reg->moduleRegistrationID} and \"examinationID\"={$examID};";
                    
                    
                        //$regFinal= ModuleRegistration::model()->findBySql($sql,array(':regID'=>$reg->moduleRegistrationID,':examID'=>yii::app()->session['mreExaminationID'])); 
                    //echo $sql;    
                    $regFinal= ModuleRegistration::model()->findBySql($sql); 
                        
                      //echo $regFinal['subTotal'];
                        ?>
                       <?php echo ($saveFlag ? CHtml::checkBox('passFinal['.$i.']',false,array('id'=>'passFinal-'.$i)):'');?></sapn>
                    <?php
                        echo CHtml::textField('fi['.$i.']', ($regFinal['final']==0?null:$regFinal['final']),array('class'=>'','style'=>'font-size:16px; width:35px; padding:5px 8px 5px 8px;','disabled'=>(!$regFinal['absent']?false:true),'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>5, 'disabled'=>true,'required'=>false,'id'=>'fi-'.$i));
                    ?>
                    <?php   
                        echo CHtml::textField('grandTotal['.$i.']', ($regFinal['absent']=='t'?'AB':($regFinal['final']==0?null:$regFinal['subTotal']+$regFinal['final'])),array('class'=>'','style'=>'font-weight:bold; font-size:16px; width:35px; padding:5px 8px 5px 8px; text-align:right;','disabled'=>true,'id'=>'grandTotal-'.$i));
                    ?>
                    <?php
                        echo CHtml::textField('grandPoint['.$i.']',  FormUtil::gradePoint($regFinal['subTotal']+$regFinal['final']),array('style'=>'font-weight:bold; width:35px; padding:5px 8px 5px 8px; font-size:16px; text-align:right;','disabled'=>true,'id'=>'grandPoint-'.$i)); 
                    ?>
                    <?php
                        echo CHtml::hiddenField('moduleRegistrationID['.$i.']',$regFinal['moduleRegistrationID']);
                        ?>
                        
                        
                            <span style="float:right" > 
                                <?php  
                                echo CHtml::checkBox('absent['.$i.']', ($regFinal['absent']==1?'checked':''),array('disabled'=>true,'id'=>'absent-'.$i));
                                ?><strong style="padding: 0px 10px 0px 10px;">AB</strong> 
                            </span>
                       <span id="error2-<?php echo $i; ?>"  style="float:left; color: #EE5757; "> </span>
    <script type="text/javascript">
    
    
                    
    
        $(function(){
    
    
        
        $('#fi-<?php echo $i; ?>').on('input',function() {
            //var final = $("#fi-<?php echo $i; ?>").val();
            var final = $(this).val();
            var total =$("#total-<?php echo $i; ?>").val();
            
            
            var grandTotal = nanToZero(parseFloat(final)) +nanToZero(parseFloat(total));
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
        
  /*  $( "#passFinal").on( "click", function()
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
        

    } ); */
    
    $( "#passFinal").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
           $("#absent-<?php echo $i; ?>").removeAttr('disabled');
            
            
            
            if ($("#grandTotal-<?php echo $i; ?>").val()!='AB'){
                
                 $("#fi-<?php echo $i; ?>").removeAttr('disabled');
            }
            
             
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
            $("#passFinal-<?php echo $i; ?>").prop('checked',true);
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").prop('checked',false);
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
                        
                <?php  endforeach; ?>
                <?php
                        if($saveFlag)
                        {
                            echo CHtml::submitButton('Save',array('class'=>'btn btn-large btn-success','style'=>'text-align:center; display:inline; width:300px;','data-toggle'=>'tooltip','title'=>'Save Marks','disabled'=>true,'id'=>'save'));
                        }
                        else
                        {
                            echo "<span class=\"span-6 label label-important\" style=\"padding:10px 5px 10px 5px;\" >Already Published<a href=\"#\" data-toggle=\"tooltip\" title=\"first tooltip\"> <a href=\"#\" data-toggle=\"tooltip\" title=\"Can Not Change Result\"><i class=\"icon-question-sign \"></i></a></span>";
                        }
                
                        
                        
                        $this->endWidget();
                ?>

                    </td>
                    
                    
                </tr>
                
    </tbody>
     

    </table>
<?php endif; ?>
    
    
</div>


<script type="text/javascript">
    $(document).on('ready',()=>{
        $('#data').hide();
    });
    $('#xlsx').on("click",()=>{
        
        var htmlstr = document.getElementById('data').outerHTML;
        var workbook = XLSX.read(htmlstr, {type:'string'});
        XLSX.writeFile(workbook, '<?php echo yii::app()->session['mreModule']; ?>_template.xlsx');
        });

</script>


    
<?php  if ($moduleReg !== null):?>
    
    
  
                    

<table id="data" class="table table-bordered span-24">
    <tr>
            <td colspan="6">
                <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Supplementary Examination ".yii::app()->session['mreYear'];?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                      <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                    <?php echo yii::app()->session['mreModule']; ?>
            </td>
        </tr>
	<tr>
                <td>
		      Student ID		
                </td>
		
                <td>
                    Final 40
                </td>
                
                
        </tr>
   
    
         
	<?php  foreach($moduleReg as $row): ?>
            
            <?php $reg= ModuleRegistration::model()->findByPk($row['moduleRegistrationID']); 
                    $total = $reg->reg_attendence+$reg->reg_classTest+$reg->reg_midterm;
                    
                    $examID=yii::app()->session['examinationID'];
                    
                    $sql = "select * from vw_getsecondhalfmarkslist where \"moduleRegistrationID\"={$reg->moduleRegistrationID} and \"examinationID\"={$examID};";
                    
                       
                    $regFinal= ModuleRegistration::model()->findBySql($sql); 
                    
                    
                    ?>
	<tr>
                <td style="font-weight:bold;" class="span-2">
			<?php echo $row['studentID']; ?>
		</td>
                
                            
                <td class="span-1">      
                  <?php  echo ($regFinal['final']==0?null:$regFinal['final']) ?>
                </td>
             
               
         
                </tr>
                <?php  endforeach; ?>
              
                
   
     

    </table>
<?php endif; ?>

