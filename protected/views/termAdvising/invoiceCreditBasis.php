
<?php
$total=0; 
                $subTotal=0;
                $admissionFees=0;
                $termFees=0;
                $waiver =0;
                $creditFee=0;
?>                                                       
                
                
<table border="0"  style="font-size:25px; text-align: right;">
    <thead>
     <tr>
         <td style="font-size:25px; text-align: left;"><?php echo CHtml::image(dirname(Yii::app()->getBasePath()).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'MU.jpg', 'DORE',array("width"=>"130px")); ?></td>
         <td></td>
         <td border="1"  style="font-size:25px; text-align: right;"><strong>Student Copy</strong></td>        
    </tr>
     
</table>

<table border="0"  style="font-size:25px; text-align: left;">
    <thead>
     <tr>
         <th><strong>Advise to:</strong></th>
         <th style="font-size:25px; text-align: right;">Advice No:<?php echo yii::app()->session['termAdmissionID']; ?></th>        
         
     </tr>
    <tr>
         <th>Student ID:<strong> <?php echo  $rows2[0]['studentID']; ?> </strong></th>   
         
    </tr>
     <tr>
         <th>Name: <?php echo  $rows2[0]['per_name']; ?></th>        
         <th width="60%" style="font-size:25px; text-align: right;"><?php  echo DBhelper::getProgrammeNameById(yii::app()->session['proCode']); ?></th>
    </tr>
    <tr>
         <th>Address: <?php echo  $rows2[0]['per_presentAddress']; ?></th>        
         <th style="font-size:25px; text-align: right;"><?php echo FormUtil::getTerm(yii::app()->session['traTermMod']).' '; ?><?php echo yii::app()->session['traYearMod'];  ?></th>  
    </tr>
    
    </thead>    
</table>





<table border="0"  style="font-size:25px; text-align: left;">
    <thead>
   <tr>
       <th><strong>Date: </strong><?php $now = new DateTime(); echo $now->format('d-m-Y');?></th>        
       <th style="font-size:25px; text-align: right;"><?php    echo     FormUtil::getTermNumberWithSufix(yii::app()->session['batName'],yii::app()->session['proCode'],yii::app()->session['traTerm'],yii::app()->session['traYear']); ?></th>
    </tr>
    </thead>    
</table>
<div class="span-24 title" style="font-size: 20px;">Payment Method: <span class="label label-warning" style=""> Credit Hour Basis</span></div>


<table border="1"  style="font-size:23px; text-align: left;">
    <thead>
         <tr>
            <th width="10%"><strong>Status</strong></th>
            <th width="10%"><strong>Course Code</strong></th>
            <th width="20%"><strong>Course Title</strong></th>
            <th width="10%"><strong>Credit hour</strong></th>
            <th width="10%"><strong>With</strong></th>            
            <th width="15%"><strong>Routine</strong></th>            
            <th width="35%"><strong>Amnt.</strong></th>
        </tr>    
    </thead>
    
    <tbody>
      <?php
      
        foreach ($rows as $row):
      
          ?>
      
        <tr>
             <td width="10%"><?php echo $row['reg_status']; ?></td>
             <td width="10%"><?php echo $row['moduleCode']; ?></td>
             <td width="20%"><?php echo $row['mod_name']; ?></td>
             <td width="10%"><?php echo $row['mod_creditHour']; ?></td>
             <td width="10%"><?php echo $row['batchName']. FormUtil::getBatchNameSufix($row['batchName']). " ".$row['sectionName']; ?></td>
             <th width="15%">
                 <?php $rou = Routine::model()->findAllByAttributes(array('offeredModuleID'=>$row['offeredModuleID'])); ?>
                 <?php foreach ($rou as $item2):?>
                              
                 <?php echo $item2['timeSlotCode'].','.$item2['roomCode']; ?>
                                      
                <?php endforeach;?>
                 
             </th>
             
             <td  width="35%" style="text-align: right"> <?php  
                 //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],$row['mod_creditHour']);
                 $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                                            $totalCreditFee = $creditFee * $row['mod_creditHour'];
                                           
                                            $waiver = FormUtil::getWaiverByStudentID(yii::app()->session['studentID'],$row['offeredModuleID']);
                                            $waiver = (strtolower($row['reg_status'])=='regular'?$waiver:0);
                                            $waiverAmount=($totalCreditFee*$waiver)/100 ;
                                            $afterWaived= $totalCreditFee-$waiverAmount;
                                            echo '( '.$row['mod_creditHour'].' * '.$creditFee.'  = '. $totalCreditFee.' ) - '. $waiver.'%  = '.$afterWaived;
                                         
                                            //echo  $totalCreditFee;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            $total = $total + $afterWaived;
                                            
                ?>             
             </td>
             
        </tr>
       <?php endforeach;?>
    </tbody>
    
</table>

<table border="0"   style="font-size:23px; text-align: right;">
   <thead>
          
         <tr>
            <th width="90%"><strong>After Waived Total Tuition Fees:</strong></th>
            <th width="20%" style="font-size:25px; text-align: right;"><strong>
                <?php echo $total.'/-';  ?></strong></th>
          </tr>    
          <tr>
            <th width="90%"><strong>Semester Fee/ Term Fee:</strong></th>
                    <th width="20%" style="font-size:25px; text-align: right;"><strong>
                             <?php   echo $termFees= FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID'],'Semester Fee').'/-'; ?>
                </strong></th>
              
          </tr> 
          <?php  
            $feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID'],1);
          ?>
          <?php if ($feeFlag):?>
          <tr>
            <th width="90%"><strong>Admission Fee:</strong></th>
                    <th width="20%" style="font-size:25px; text-align: right;"><strong>
                            <?php   echo $admissionFees = FormUtil::getFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],'Admission Fee').'/-'; ?>
                </strong></th>
              
          </tr>
          <?php endif ?>
          <tr>
            <th width="90%"><strong>Nat payable:</strong></th>
                    <th width="20%" style="font-size:25px; text-align: right;"><strong>
                             <?php 
                            //$feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID']);
                            
                            echo (float)$total+(float)$admissionFees+(float)$termFees.'/-'; 
                        
                            //echo $total+$admissionFees+$termFees.'/-'; 
                            ?>
                </strong></th>
              
          </tr>
    </thead>    
</table>
<br></br>
<table border="0"  style="font-size:23px;">
    
    <tr>
        <td width ="100%"><strong>
                <?php 
                
                echo "* Per credit hour fee taka: ".$creditFee;                
                ?> 
                </strong></td>
    </tr>
    <tr>
        <td width ="100%"><strong>
                <?php 
                $instalment = $total / 4;
                echo "* Can pay in 4 installments,  taka: ".$instalment.' + '.$instalment.' + '.$instalment.' + '.$instalment.' = '.$total;                
                ?> 
                </strong></td>
    </tr>
   <tr>
        <td width ="100%"><strong>
                ** no waiver will be calculated for retake course
                </strong></td>
    </tr>
</table>

<br></br>


<br></br>
<table border="0"  style="font-size:25px; text-align: left;">
    <thead>
     <tr>
        <th>----------------------------------------</th>
        <th style="text-align: right;">----------------------------------------</th>        
    </tr>
    <tr>
        <th>Signature of the Student</th>
        <th style="text-align: right;">Signature of the Advisor</th>        
    </tr>
    </thead>
    
</table>

<p>---------------------------------------------------------------------------------------------------------------------------------</p>
<!--  ----------------Student Copy-------------------------------- !-->


<?php
$total = 0;
?>


<table border="0"  style="font-size:25px; text-align: right;">
    <thead>
     <tr>
         <td style="font-size:25px; text-align: left;"><?php echo CHtml::image(dirname(Yii::app()->getBasePath()).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'MU.jpg', 'DORE',array("width"=>"130px")); ?></td>
         <td></td>
         <td border="1"  style="font-size:25px; text-align: right;"><strong>Office Copy</strong></td>        
    </tr>
     
</table>

<table border="0"  style="font-size:25px; text-align: left;">
    <thead>
        
     <tr>
         <th><strong>Advise to:</strong></th><th style="font-size:25px; text-align: right;">Advice No:<?php echo yii::app()->session['termAdmissionID']; ?></th>        
         
    </tr>
    <tr>
        <th>Student ID:<strong> <?php echo  $rows2[0]['studentID']; ?></strong></th>   
    </tr>
     <tr>
         <th>Name: <?php echo  $rows2[0]['per_name']; ?></th>     
         <th width="60%" style="font-size:25px; text-align: right;"><?php  echo DBhelper::getProgrammeNameById(yii::app()->session['proCode']); ?></th>
    </tr>
    <tr>
         <th>Address: <?php echo  $rows2[0]['per_presentAddress']; ?></th>   
         <th style="font-size:25px; text-align: right;"><?php echo FormUtil::getTerm(yii::app()->session['traTerm']).' '; ?><?php echo yii::app()->session['traYear'];  ?></th>  
    </tr>
    
    </thead>    
</table>



<br></br>

<table border="0"  style="font-size:25px; text-align: left;">
    <thead>
   <tr>
       <th><strong>Date: </strong><?php $now = new DateTime(); echo $now->format('d-m-Y');?></th>        
       <th style="font-size:30px; text-align: right;"><?php    echo     FormUtil::getTermNumberWithSufix(yii::app()->session['batName'],yii::app()->session['proCode'],yii::app()->session['traTerm'],yii::app()->session['traYear']); ?></th>
    </tr>
    
    </thead>    
</table>
<div class="span-24 title" style="font-size: 20px;">Payment Method: <span class="label label-warning" style=""> Credit Hour Basis</span></div>

<br></br>
<table border="1"  style="font-size:23px; text-align: left;">
    <thead>
         <tr>
            <th width="10%"><strong>Status</strong></th>
            <th width="10%"><strong>Course Code</strong></th>
            <th width="20%"><strong>Course Title</strong></th>
            <th width="10%"><strong>Credit hour</strong></th>
            <th width="10%"><strong>With</strong></th>            
            <th width="15%"><strong>Routine</strong></th>            
            <th width="35%"><strong>Amnt.</strong></th>
        </tr>    
    </thead>
    
    <tbody>
      <?php
      
        foreach ($rows as $row):
      
          ?>
      
        <tr>
             <td width="10%"><?php echo $row['reg_status']; ?></td>
             <td width="10%"><?php echo $row['moduleCode']; ?></td>
             <td width="20%"><?php echo $row['mod_name']; ?></td>
             <td width="10%"><?php echo $row['mod_creditHour']; ?></td>
             <td width="10%"><?php echo $row['batchName']. FormUtil::getBatchNameSufix($row['batchName']). " ".$row['sectionName']; ?></td>
             <th width="15%">
                 <?php $rou = Routine::model()->findAllByAttributes(array('offeredModuleID'=>$row['offeredModuleID'])); ?>
                 <?php foreach ($rou as $item2):?>
                              
                 <?php echo $item2['timeSlotCode'].','.$item2['roomCode']; ?>
                                      
                <?php endforeach;?>
                 
             </th>
             
             <td  width="35%" style="text-align: right"> <?php  
                 //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],$row['mod_creditHour']);
                 $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                                            $totalCreditFee = $creditFee * $row['mod_creditHour'];
                                           
                                            $waiver = FormUtil::getWaiverByStudentID(yii::app()->session['studentID'],$row['offeredModuleID']);
                                            $waiver = (strtolower($row['reg_status'])=='regular'?$waiver:0);
                                            $waiverAmount=($totalCreditFee*$waiver)/100 ;
                                            $afterWaived= $totalCreditFee-$waiverAmount;
                                            echo '( '.$row['mod_creditHour'].' * '.$creditFee.'  = '. $totalCreditFee.' ) - '. $waiver.'%  = '.$afterWaived;
                                         
                                            //echo  $totalCreditFee;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            $total = $total + $afterWaived;
                                            
                ?>             
             </td>
             
        </tr>
       <?php endforeach;?>
    </tbody>
    
</table>

<table border="0"   style="font-size:23px; text-align: right;">
   <thead>
          
         <tr>
            <th width="90%"><strong>After Waived Total Tuition Fees:</strong></th>
            <th width="20%" style="font-size:25px; text-align: right;"><strong>
                <?php echo $total.'/-';  ?></strong></th>
          </tr>
          
          <tr>
            <th width="90%"><strong>Semester Fee/ Term Fee:</strong></th>
                    <th width="20%" style="font-size:25px; text-align: right;"><strong>
                             <?php   echo $termFees= FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID'],'Semester Fee').'/-'; ?>
                </strong></th>
              
          </tr> 
          <?php  
            $feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID'],1);
          ?>
          <?php if ($feeFlag):?>
          <tr>
            <th width="90%"><strong>Admission Fee:</strong></th>
                    <th width="20%" style="font-size:25px; text-align: right;"><strong>
                            <?php   echo $admissionFees = FormUtil::getFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],'Admission Fee').'/-'; ?>
                </strong></th>
              
          </tr>
          <?php endif ?>
          <tr>
            <th width="90%"><strong>Nat payable:</strong></th>
                    <th width="20%" style="font-size:25px; text-align: right;"><strong>
                             <?php 
                            //$feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID']);
                            
                            echo (float)$total+(float)$admissionFees+(float)$termFees.'/-'; 
                        
                            //echo $total+$admissionFees+$termFees.'/-'; 
                            ?>
                </strong></th>
              
          </tr>
    </thead>    
</table>

<br></br>
<br></br>

<table border="0"  style="font-size:25px; text-align: left;">
    <thead>
     <tr>
        <th>----------------------------------------</th>
        <th style="text-align: right;">----------------------------------------</th>        
    </tr>
    <tr>
        <th>Signature of the Student</th>
        <th style="text-align: right;">Signature of the Advisor</th>        
    </tr>
    </thead>
    
</table>


