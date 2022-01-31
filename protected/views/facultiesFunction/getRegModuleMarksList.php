<?php
/* @var $this ModuleController */
/* @var $model Module */

            
        if(yii::app()->session['mreUrlFlag']==1)
        {
            $this->breadcrumbs=array(
                'Department\'s Activities'=>array('headsFunction/index'),
                'Result Authentication'=>array('headsFunction/courseAuthentication'),
                'Marks Entry'
                );
        }
        elseif(yii::app()->session['mreUrlFlag']==2)
        {
            $this->breadcrumbs=array(
                'Department Activities'=>array('HeadsFunction/index'),
                'Marks Entry By Batch'=>array('headsFunction/GetRegisteredModuleForBatch'),
                'Marks Entry (Data Entry)'
                );
        }
        else
        {
            
            $this->breadcrumbs=array(
                'Faculty Activities'=>array('index'),
                
                'Marks Entry'
                );
        }
        
      
?>
<?php 
    $markingScheme = MarkingScheme::model()->findByPk($moduleReg[0]['markingSchemeID']?$moduleReg[0]['markingSchemeID']:1);
    $firstHalfMarks = $markingScheme->mrs_attendance+ $markingScheme->mrs_classTest+$markingScheme->mrs_midterm; 
$secondHalfMarks= $markingScheme->mrs_final;
      
$ofm = Offeredmodule::model()->findByPk(yii::app()->session['mreOfmID']);
$saveFlag=FALSE;       
//if($ofm->ofm_publish!=1 && FormUtil::getSuperAdminFlag(yii::app()->user->getState('role'), yii::app()->session['mreTerm'], yii::app()->session['mreYear']))
        if($ofm->ofm_publish!=1)
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
            <h3 >Marks Entry</h3>

            <h4> <?php echo FormUtil::getBatchTermHTMLspan(yii::app()->session['mreSection'],yii::app()->session['mreBatch'],yii::app()->session['mreProCode'] ); ?></h4>
            <h4><strong>Course: </strong><span class="label label-success"><?php echo yii::app()->session['mreModule']; ?></span></h4>
            <h4><strong>Faculty Name: </strong><span class="label label-info"><?php echo yii::app()->session['mreFacultyName']; ?></span></h4>
            
            
              
        </div>
        <div class="span-7">
            <h4><strong>Term: </strong><span class="label label-warning"> <?php echo FormUtil::getTerm(yii::app()->session['mreTerm']); ?>  </span><strong>Year: </strong><span class="label label-info"> <?php echo yii::app()->session['mreYear']; ?></span></h4>
            <h6>Programme:  <?php  echo DBhelper::getProgrammeByCode(yii::app()->session['mreProCode']); ?></h6>
            <h6> <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Final Examination ".yii::app()->session['mreYear'];?></h6>
<?php 

if(yii::app()->session['mreUrlFlag']==1)
{
    $backUrl=Yii::app()->controller->createUrl('headsFunction/courseAuthentication');
    $backTitle='Result Authentication';
}
elseif(yii::app()->session['mreUrlFlag']==2)
{
    $backUrl=Yii::app()->controller->createUrl('headsFunction/GetRegisteredModuleForBatch');
    $backTitle='Select Modules';
}
else {
    $backUrl=Yii::app()->controller->createUrl('index');
    $backTitle='Faculty Activities';
}

//$backUrl = (!yii::app()->session['mreUrlFlag']?Yii::app()->controller->createUrl('index') : Yii::app()->controller->createUrl('headsFunction/courseAuthentication'));
//$backTitle = (!yii::app()->session['mreUrlFlag']?'Faculty Activities' : 'Result Authentication');


$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		
	//array('label'=>'Generate 100 Mark Sheet', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateFirstHalfPDF'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
            array('label'=>'Back', 'icon'=>'icon-arrow-left' , 'url'=>$backUrl, 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>$backTitle,), 'visible'=>true),	
            
            array('label'=>'Next', 'icon'=>'icon-play-circle', 'url'=>Yii::app()->controller->createUrl('resultSheet'), 'linkOptions'=>array('data-toggle'=>'tooltip','data-placement'=>'right', 'title'=>'Get Result') , 'visible'=>true, ),	
            array('label'=>'XLSX-template', 'icon'=>'icon-download' , 'url'=>'#', 'linkOptions'=>array('id'=>'xlsx','style'=>'text-weight:bold;','data-toggle'=>'tooltip','data-placement'=>'top', 'title'=>'Download Template',), 'visible'=>true),
	),
));

            
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
                        //console.log(errList.length);
                        if(errList.length>6)
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
                    
                    errLog[0] =[['<?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Final Examination ".yii::app()->session['mreYear'];?>']];
                    errLog[1] =[['<?php echo "Pro Code: ".yii::app()->session['mreProCode']; ?>'],['<?php echo "Batch: ". yii::app()->session['mreBatch']; ?>'],['<?php echo "Section: ".yii::app()->session['mreSection']; ?>']];
                    errLog[2] =[['<?php echo "Faculty: ".yii::app()->session['mreFacultyName']; ?>']];
                    
                    errLog[3] =[['<?php echo yii::app()->session['mreModule']; ?>']]; 
                    errLog[4] =[['SheetName:'],[sheetName()]];
                    errLog[5] =[['StudentID'],['Att 10'],['CT 20'],['Mid 30'],['Final 40'],['Total 100']];
                    
                    var i =5;
                    
                    var patt = new RegExp("^[0-9]{3}-[0-9]{3}-[0-9]{3}$");
             
                   
                   
                    dataRaw.forEach((item) => {
                        var arr = item.split(',');

                        var    dataCell = arr.filter(item => item);
                        
                       

                        if (patt.test(dataCell[0])) {
                            
                            if(dataMatch.indexOf(dataCell[0])>-1)
                            {
                                insertString += "('" + dataCell[0] + "'," + dataCell[1]+ "'," + dataCell[2]+ "'," + dataCell[3]+"',"+dataCell[4] +")";
                            
                            
                                if(!nanToZero(dataCell[2]) ||  dataCell[2].toLowerCase().trim()=='ab')
                                {
                                    $('#'+dataCell[0]).find("input[id^='grandTotal-']").val('AB');
                                    $('#'+dataCell[0]).find("input[id^='fi-']").val(0);


                                    $('#'+dataCell[0]).find("input[id^='absent-']").prop('checked',true);
                                }
                                
                                else{
                                    //alert(dataCell[0]);
                                        $('#'+dataCell[0]).find("input[id^='attendance-']").val(dataCell[1]);
                                        $('#'+dataCell[0]).find("input[id^='classTest-']").val(dataCell[2]);
                                        $('#'+dataCell[0]).find("input[id^='midterm-']").val(dataCell[3]);
                                        $('#'+dataCell[0]).find("input[id^='fi-']").val(dataCell[4]);
                                        //var total = $('#'+dataCell[0]).find("input[id^='total-']").val();
                                        var total = nanToZero(parseFloat(dataCell[1]))+ nanToZero(parseFloat(dataCell[2]))+ nanToZero(parseFloat(dataCell[3]));
                                        $('#'+dataCell[0]).find("input[id^='total-']").val(total);
                                        var grandTotal = nanToZero(parseFloat(dataCell[1]))+ nanToZero(parseFloat(dataCell[2]))+ nanToZero(parseFloat(dataCell[3])) + nanToZero(parseFloat(dataCell[4]));
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
                                
                                var total =  nanToZero(parseFloat(dataCell[1]))+ nanToZero(parseFloat(dataCell[2]))+ nanToZero(parseFloat(dataCell[3]))+ nanToZero(parseFloat(dataCell[4])); 
                                i++;
                                errLog[i]=[[dataCell[0]],[dataCell[1]],[dataCell[2]],[dataCell[3]],[dataCell[4]],[total]];
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
                   // console.log('--'+errList.length);
                      if(errList.length>6){


                      var wb = XLSX.utils.book_new();
                      
                      //console.log(sheetName());
                      var ws_name = sheetName();
                           
                            var wsNew = XLSX.utils.aoa_to_sheet(errList);

                            /* Add the worksheet to the workbook */
                            XLSX.utils.book_append_sheet(wb, wsNew, ws_name); 
                            XLSX.writeFile(wb, '<?php echo yii::app()->session['mreModule']; ?>_<?php echo yii::app()->session['mreProCode']; ?>_<?php echo yii::app()->session['mreBatch']; ?>_<?php echo yii::app()->session['mreSection']; ?>_errList.xlsx');
                            //XLSX.writeFile(wb, '<?php echo yii::app()->session['mreModule']; ?>_errList.xlsx');
                            message.innerHTML =  "Extra Student ID's has been added to "+ "'<?php echo yii::app()->session['mreModule']; ?>_errList.xlsx' file. !!";
                        }
    
              }
              
              function sheetName(){
                
                
                var str = '<?php echo yii::app()->session['mreModule']; ?>';
                var batch= '<?php echo yii::app()->session['mreBatch'].yii::app()->session['mreSection']; ?>';
                var faculty = '<?php echo yii::app()->session['mreFacultyName']; ?>';    
                
                var res = str.split(":");

                var title = res[1].split(" ");
                var subtitle='_';

                for(var i=0; i<title.length;i++)
                {
                              subtitle = subtitle + title[i].substr(0, 1);
                }

                var fac = faculty.split(" ");
                var facTitle = "_"

                for(var i=1; i<fac.length;i++)
                {
                              facTitle = facTitle + fac[i].substr(0, 1);
                }

                return res[0]+subtitle+"_"+batch+facTitle;
              
              }
              </script>

<!--------------------------------------------------------------------------------------->


<div class="span-24">
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
                            
                            'action'=>CController::createUrl('saveTotalMarks'),
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
 		<th  style="text-align:left;" >
                    
                    <?php echo ($saveFlag?CHtml::checkBox('pass',false,array('id'=>'pass')):'');?>
                    
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
                
                <td class="span-10">
                    <?php  echo ($saveFlag ? CHtml::checkBox('pass['.$reg->moduleRegistrationID.']',false,array('id'=>'pass-'.$reg->moduleRegistrationID)):'');?>
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
               
         
                      
                      
                                            
                    <script type="text/javascript">
    

                        /*    function nanToZero(n){
                                        if (isNaN(n))n=0;
                                        return n;
                                    }
                        */
                            $(function(){



                            $('#attendance-<?php echo $i; ?>, #classTest-<?php echo $i; ?>, #midterm-<?php echo $i; ?>').on('input',function() {
                                var attendance = $("#attendance-<?php echo $i; ?>").val();
                                var classTest =$("#classTest-<?php echo $i; ?>").val();
                                var midTerm = $("#midterm-<?php echo $i; ?>").val();
                                var total = nanToZero(parseFloat(attendance)) +nanToZero(parseFloat(classTest))+nanToZero(parseFloat(midTerm));

                               // alert(total);
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
                <td class="span-4">
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
    
    /*
         function gradePoint(val),
         function nanToZero(), defined in js.functions.js file
    */
        $(function(){
    
    
        
        $('#fi-<?php echo $i; ?>').on('input',function() {
            var final = $("#fi-<?php echo $i; ?>").val();
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
                    <td>
                    </td>
                     
                    <td style="text-align:center; padding-left: 60px;">
                        
                <?php  endforeach; ?>
    
                <?php         
                
               
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
                               XLSX.writeFile(workbook, '<?php echo yii::app()->session['mreModule']; ?>_<?php echo yii::app()->session['mreProCode']; ?>_<?php echo yii::app()->session['mreBatch']; ?>_<?php echo yii::app()->session['mreSection']; ?>_template.xlsx');
                               //XLSX.writeFile(workbook, '<?php echo yii::app()->session['mreModule']; ?>_template.xlsx');
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
                <?php echo FormUtil::getTerm( yii::app()->session['mreTerm']);?> <?php echo "Term Final Examination ".yii::app()->session['mreYear'];?>
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
                    ATT 10
                </td>
                <td>
                    CT 20
                </td>
		<td>
                    MID 30
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
                  <?php  echo ($reg->reg_attendence==0?0:$reg->reg_attendence); ?>
                </td>
                <td class="span-1">      
                  <?php  echo ($reg->reg_classTest==0?0:$reg->reg_classTest); ?>
                </td>
                <td class="span-1">      
                  <?php  echo ($reg->reg_midterm==0?0:$reg->reg_midterm); ?>
                </td>
                <td class="span-1">      
                  <?php  echo ($regFinal['final']==0?0:$regFinal['final']); ?>
                </td>
             
               
         
                </tr>
                <?php  endforeach; ?>
              
                
   
     

    </table>
<?php endif; ?>




