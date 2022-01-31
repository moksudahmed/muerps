<?php
/* @var $this ModuleController */
/* @var $model Module */

            
        
            $this->breadcrumbs=array(
                'Department Activities'=>array('HeadsFunction/index'),
                'Marks Entry By Batch'=>array('headsFunction/GetRegisteredModuleForBatch'),
                'Marks Entry (Data Entry)'
                );
        
        


?>
<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 
    $secondHalfMarks= $markingScheme->mrs_final;
    
    
    $ofm = Offeredmodule::model()->findByPk(yii::app()->session['mreOfmID']);
    $saveFlag=FALSE;    
    
    if($ofm->ofm_publish!=1 && FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['caTerm'], yii::app()->session['caYear']))
        {
            $saveFlag=TRUE;
        }
        else
        {
            $saveFlag=FALSE;
        }
    
    yii::app()->session['mrePubFlag'] = $saveFlag;
    
?>


    <div class="title ">
        <div class="span-16">
            <?php if (yii::app()->user->getState('role')==='faculty'){
                ?><h3 >Marks Entry (Thesis/ Internship / Viva)</h3>
            <?php }
            else{
            ?>
            <h3 >Marks Entry (Data Entry)</h3>
            <?php }?>
            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['mreSection'],yii::app()->session['mreBatch'],yii::app()->session['mreProCode'] ); ?></h4>
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            <h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['mreFacultyName']; ?></span></h4>
            
            
              
        </div>
        <div class="span-7">
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['mreTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['mreYear']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
            <h6> <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Final Examination ".yii::app()->session['mreYear'];?></h6>
<?php 

if (yii::app()->user->getState('role')==='faculty'){
        $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'pills',
                'items'=>array(

                //array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
                array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('facultiesFunction/GetRegisteredModuleForBatch'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Marks Entry By Batch',), 'visible'=>true),	
                array('label'=>'XLSX-template', 'icon'=>'icon-download' , 'url'=>'#', 'linkOptions'=>array('id'=>'xlsx','style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download Template',), 'visible'=>true),
                //array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
                ),
        ));
}
else{
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'pills',
            'items'=>array(

            //array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>Yii::app()->controller->createUrl('headsFunction/GetRegisteredModuleForBatch'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Marks Entry By Batch',), 'visible'=>true),	
            array('label'=>'XLSX-template', 'icon'=>'icon-download' , 'url'=>'#', 'linkOptions'=>array('id'=>'xlsx','style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download Template',), 'visible'=>true),
            //array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
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
                <div id="errMsg" style="color:red"></div>
            </form>
            
        <?php endif ?>
        </div>
    </div>

<!-------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
             
      
            
    
              $('#customFile').on("change",function(e){
                     message = document.getElementById("errMsg");
                       // message.innerHTML = "TEst";
                     var studentID=[];
                     
                    $('#data tr.sid').each(function(i) {
                        
                        studentID[i] = $(this).find('td').html();
                        studentID[i]=studentID[i].trim();
                        
                     });
                     
                    // const data = studentID.indexOf('142-115-058');
                     
                     //res.send(data ? data : 'no data found!');
                     console.log(studentID);
                   //  console.log(data);
                     
               
                var files = e.target.files, f = files[0];
                
                    var reader = new FileReader();
                
                 
                  
                reader.onload = (e)=> {
                    var errList;
                    
                    var data = new Uint8Array(e.target.result);
                    
                    try
                    {
                       var wb = XLSX.read(data, {type: 'array'});


                  //console.log(wb);
                      
                        wb.SheetNames.forEach((item)=>{
                        var ws =  wb.Sheets[item];

                        errList =   renderData(ws,studentID);
                        if(errList.length>2)
                        {    
                              
                            var retVal = confirm("Do you want to download <?php echo yii::app()->session['mreModule']; ?>_errList.xlsx");
                            if( retVal == true ) {
                               // document.write ("User wants to continue!");
                               writeFile(errList);
                               return true;
                            } else {
                               // document.write ("User does not want to continue!");
                               return false;
                            }
                        }
                        else {
                            message.innerHTML =  "Data Imported Successfully !";
                        }
                      });
                    }
                    catch(err)
                    {
                          message.innerHTML =  err + ", may be file extention is not correct!!";
                    }
                };
                reader.readAsArrayBuffer(f);
              
                  
              });
              
              
              
              function renderData(ws,dataMatch) {
                    var allData = XLSX.utils.sheet_to_csv(ws, { strip: true, blankrows: true });

                    var dataRaw = allData.split("\n");
                    
                    var insertString='';
                   
                   
                    var errLog =[];
                    
                    
                    errLog[0] =[['<?php echo yii::app()->session['mreModule']; ?>'],['ID not match list']]; 
                    errLog[1] =[['StudentID'],['ATT+CT+Mid 60'],['Final 40']];
                    var i =1;
                    
                    var patt = new RegExp("^[0-9]{3}-[0-9]{3}-[0-9]{3}$");
             
                   
                   
                    dataRaw.forEach((item) => {
                        var arr = item.split(',');

                        var    dataCell = arr.filter(item => item);
                        
                       

                        if (patt.test(dataCell[0])) {
                            
                            if(dataMatch.indexOf(dataCell[0])>-1)
                            {
                                insertString += "('" + dataCell[0] + "'," + dataCell[1]+"',"+dataCell[2] +")";
                            
                            
                                if(!nanToZero(dataCell[2]) ||  dataCell[2].toLowerCase().trim()=='ab')
                                {
                                    $('#'+dataCell[0]).find("input[id^='grandTotal-']").val('AB');
                                    $('#'+dataCell[0]).find("input[id^='fi-']").val(0);


                                    $('#'+dataCell[0]).find("input[id^='absent-']").prop('checked',true);
                                }
                                
                                else{
                                    //alert(dataCell[0]);
                                        $('#'+dataCell[0]).find("input[id^='total-']").val(dataCell[1]);
                                        $('#'+dataCell[0]).find("input[id^='fi-']").val(dataCell[2]);
                                        //var total = $('#'+dataCell[0]).find("input[id^='total-']").val();
                                        var grandTotal = nanToZero(parseFloat(dataCell[1])) + nanToZero(parseFloat(dataCell[2]));
                                        $('#'+dataCell[0]).find("input[id^='grandTotal-']").val(grandTotal);
                                        $('#'+dataCell[0]).find("input[id^='grandPoint-']").val(gradePoint(grandTotal));


                                }
                                
                                if(!nanToZero(dataCell[1]) ||  dataCell[1].toLowerCase().trim()=='ab')
                                {
                                    $('#'+dataCell[0]).find("input[id^='total-']").val(0);
                                }
                            }
                            else
                            {
                                //console.log(i);
                                i++;
                                errLog[i]=[[dataCell[0]],[dataCell[1]],[dataCell[2]]];
                               // console.log(errLog[i]);
                            }
                        }
                        
                    });
                    //console.log(counter);
                    //console.log(programme + " " + batch + " " + section + " " + code + "\n");
                    //console.log(insertString);
                    //return insertString;
                    //console.log(errLog);
                    return errLog;
                }
              
                function writeFile(errList)
              {
                    console.log('--'+errList.length);
                      if(errList.length>2){


                      var wb = XLSX.utils.book_new();
                      var ws_name = "ErrorList";

                           
                            var wsNew = XLSX.utils.aoa_to_sheet(errList);

                            /* Add the worksheet to the workbook */
                            XLSX.utils.book_append_sheet(wb, wsNew, ws_name); 
                           
                            XLSX.writeFile(wb, '<?php echo yii::app()->session['mreModule']; ?>_errList.xlsx');
                            message.innerHTML =  "Extra Student ID's has been added to "+ "'<?php echo yii::app()->session['mreModule']; ?>_errList.xlsx' file. !!";
                        }
    
              }
              
              </script>

<!--------------------------------------------------------------------------------------->

<div class="span-24">
    <?php 
    

            $range01=10;
            $range02=20;
            $range03=30;
            
            $range04=40;
            $range05=$range01+$range02+$range03;
    ?>
    <?php  if ($moduleReg !== null):?>
    
    
  
                    <?php $form = $this->beginWidget(
                        'bootstrap.widgets.TbActiveForm',
                            array(
                            'id' => 'inlineForm',
                            'type' => 'inline',
                            'method'=>'POST',
                            'htmlOptions'=>(array('autocomplete'=>'off')),
                            
                            'action'=>CController::createUrl('saveTotalMarksDataEntry'),
                        )
                            );
                    ?>

<table class="table table-bordered span-24">
    <thead>
	<tr>
                <th></th>
                <th >
		      Student ID		
                </th>
		<th >
		      Name	
                </th>
 		<th  style="text-align:center;" class="span-20" >
                    
                    <?php // echo CHtml::checkBox('pass',false,array('id'=>'pass'));?>
                    <!--span style="font-size: 15px; padding: 0px 0px 0px 18px;"> At <?php echo $markingScheme->mrs_attendance; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> Ct <?php echo $markingScheme->mrs_classTest; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> Mt <?php echo $markingScheme->mrs_midterm; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 33px; "> <?php echo $firstHalfMarks; ?></span-->
                    
                <!--/th-->
                
                <!--th -->
             <?php echo ($saveFlag ? CHtml::checkBox('passFinal',false,array('id'=>'passFinal')):'');?>
                    <span style="font-size: 15px; padding: 0px 0px 0px 33px; "> <?php echo $firstHalfMarks; ?></span>
                    <span style="font-size: 15px; padding: 0px 0px 0px 18px;"> Fi  <?php echo $secondHalfMarks; ?> </span>
                   <span style="font-size: 15px; padding: 0px 0px 0px 27px;">   <?php echo $secondHalfMarks+$firstHalfMarks; ?></span>
                   <span style="font-size: 15px; padding: 0px 0px 0px 33px;">   LG</span>
                </th>
        </tr>
    </thead>
    <tbody>
    
         
	<?php $serial=1; foreach($moduleReg as $row): ?>
                         <?php $reg= ModuleRegistration::model()->findByPk($row['moduleRegistrationID']); 
                    $total = $reg->reg_attendence+$reg->reg_classTest+$reg->reg_midterm;
                    ?>
	<tr id="<?php echo $row['studentID']; ?>">
                <td class="span-1"><?php echo $serial ++; ?></td>
                <td style="font-weight:bold;" class="span-4">
			<?php echo $row['studentID']; ?>
		</td>
       		<td class="span-6">
			<?php echo $row['per_name']; ?>
		</td>
                
                <td class="span-20" >
                    
                    <?php     $i= $reg->moduleRegistrationID;                  
                             echo CHtml::hiddenField("id[".$reg->moduleRegistrationID."]",$reg->moduleRegistrationID);
                    ?>
                    
                                   
                
                    <span id="error-<?php echo $i; ?>" class="span-4" style="color: #EE5757; text-align: center;"> </span>  
               
         
                      
                      
                                        
                    <?php
                    
                    $examID=yii::app()->session['examinationID'];
                    
                    $sql = "select * from vw_getsecondhalfmarkslist where \"moduleRegistrationID\"={$reg->moduleRegistrationID} and \"examinationID\"={$examID};";
                    
                    
                        //$regFinal= ModuleRegistration::model()->findBySql($sql,array(':regID'=>$reg->moduleRegistrationID,':examID'=>yii::app()->session['mreExaminationID'])); 
                    //echo $sql;    
                    $regFinal= ModuleRegistration::model()->findBySql($sql); 
                        
                      //echo $regFinal['subTotal'];
                        ?>
                    <?php echo ($saveFlag? CHtml::checkBox('passFinal['.$i.']',false,array('id'=>'passFinal-'.$i)):'');?></sapn>
                    <?php
                         echo CHtml::numberField("total[".$reg->moduleRegistrationID."]", ($total==0?null:$total),array('class'=>'','style'=>'font-weight:bold; font-size:16px; width:40px; padding:5px 8px 5px 8px; ','disabled'=>true,'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>2, 'required'=>false,'id'=>"total-".$reg->moduleRegistrationID, 'min'=>0,'max'=>$range05,'step'=>.5));
                    ?> 
                           
                    <?php
                        echo CHtml::numberField('fi['.$i.']', ($regFinal['final']==0?null:$regFinal['final']),array('class'=>'','style'=>'font-size:16px; width:40px; padding:5px 8px 5px 8px;','disabled'=>(!$regFinal['absent']?false:true),'pattern'=>'([0-9]*\.?[0-9]*)$','maxlength'=>4, 'disabled'=>true,'required'=>false,'id'=>'fi-'.$i, 'min'=>0,'max'=>$range04,'step'=>.5));
                    ?>
                    <?php   
                        echo CHtml::textField('grandTotal['.$i.']', ($regFinal['absent']=='t'?'AB':($regFinal['final']==0?null:$regFinal['subTotal']+$regFinal['final'])),array('class'=>'','style'=>'font-weight:bold; font-size:16px; width:40px; padding:5px 8px 5px 8px; text-align:right;','disabled'=>true,'id'=>'grandTotal-'.$i));
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


                           
    

    $( "#passFinal").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
            $("#absent-<?php echo $i; ?>").removeAttr('disabled');
            $("#total-<?php echo $i; ?>").removeAttr('disabled');
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
           
            $("#passFinal-<?php echo $i; ?>").attr('checked','true');
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#total-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").removeAttr('checked');
        }
        

    } );
        
    $( "#passFinal-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            
            $("#save").removeAttr('disabled');
            $("#absent-<?php echo $i; ?>").removeAttr('disabled');
            $("#total-<?php echo $i; ?>").removeAttr('disabled');
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
            $("#passFinal-<?php echo $i; ?>").attr('checked','true');
        }
        else 
        {
            $("#save").attr('disabled','true');
            $("#absent-<?php echo $i; ?>").attr('disabled','true');
            $("#total-<?php echo $i; ?>").attr('disabled','true');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#passFinal-<?php echo $i; ?>").removeAttr('checked');
        }
        

    } );
    
    $(function(){
    
    
        
        $('#fi-<?php echo $i; ?>, #total-<?php echo $i; ?>').on('input',function() {
            var final = $("#fi-<?php echo $i; ?>").val();
            var total =$("#total-<?php echo $i; ?>").val();
            
            var grandTotal = nanToZero( parseFloat(final)) +nanToZero( parseFloat(total));
            
            //alert(gradePoint(total));
            $("#grandTotal-<?php echo $i; ?>").val(grandTotal);
            $("#grandPoint-<?php echo $i; ?>").val(gradePoint(grandTotal));
            $("#grandPoint-<?php echo $i; ?>").css('');
        
        
        
        
            
            
            
        });
        
    
    $( "#absent-<?php echo $i; ?>").on( "click", function()
    {
        
        
        if ( $(this).prop('checked') ){
            $("#fi-<?php echo $i; ?>").val(0);
            $("#grandTotal-<?php echo $i; ?>").val('AB');
            $("#fi-<?php echo $i; ?>").attr('disabled','true');
            $("#total-<?php echo $i; ?>").attr('disabled','true');
        }
        else 
        {
            $("#grandTotal-<?php echo $i; ?>").val($("#total-<?php echo $i; ?>").val());
            $("#fi-<?php echo $i; ?>").removeAttr('disabled');
            $("#total-<?php echo $i; ?>").removeAttr('disabled');
        }
        

    } );
        
    
    
    $( "#save").on( "click", function()
                            {

                                    $("#total-<?php echo $i; ?>").removeAttr('disabled');
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
                
               // $ofm = Offeredmodule::model()->findByPk(yii::app()->session['mreOfmID']);
                //echo $ofm->ofm_publish;
                //exit();
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
        var message = document.getElementById("errMsg");
        var htmlstr = document.getElementById('data').outerHTML;
        var workbook = XLSX.read(htmlstr, {type:'string'});
        var retVal = confirm("Are you sure to download <?php echo yii::app()->session['mreModule']; ?>_template.xlsx file");
                            if( retVal == true ) {
                               // document.write ("User wants to continue!");
                               XLSX.writeFile(workbook, '<?php echo yii::app()->session['mreModule']; ?>_template.xlsx');
                               message.innerHTML =  "<?php echo yii::app()->session['mreModule']; ?>_template.xlsx file has been downloaded !";
                               return true;
                            } else {
                               // document.write ("User does not want to continue!");
                               return false;
                            }
        
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
                    ATT+CT+MID 60
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
	<tr class="sid">
                <td style="font-weight:bold;"  >
			<?php echo $row['studentID']; ?>
		</td>
                <td class="span-1">      
                  <?php  echo ($total==0?0:$total) ?>
                </td>
                            
                <td class="span-1">      
                  <?php  echo ($regFinal['final']==0?0:$regFinal['final']); ?>
                </td>
             
               
         
                </tr>
                <?php  endforeach; ?>
              
                
   
     

    </table>
<?php endif; ?>




