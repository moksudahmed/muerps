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

 <div class="span-24 title" style="font-size: 20px; padding-bottom: 20px;">Payment Method: <span class="label label-warning" style=""> Monthly Basis</span></div>
    
    
  
        <table border="1"  style="font-size:23px; text-align: left;">
       <thead>

                                <tr>
                                    <!--th>
                                        Head
                                    </th-->
                                    <th width="20%">
                                        Code
                                    </th >
                                    <th width="40%">
                                        Title
                                    </th>
                                    
                                    
                                    <th width="20%">
                                        Batch
                                    </th>
                                   
                                    
                                    
                                    <th width="20%">
                                        Amount
                                    </th>
                                </tr>
                            </thead>
            <tbody>
      
                <?php 
                $total=0; 
                $subTotal=0;
                $admissionFees=0;
                $termFees=0;
                $totalMonth =FormUtil::getMonthByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $waiver = FormUtil::getWaiverByStudentID2(yii::app()->session['studentID']);
                //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                $totalCredit = FormUtil::getCreditHourByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $monthlyFee = round(($creditFee*$totalCredit)/$totalMonth);
                $waivedMonthlyFee = $monthlyFee*4 -((($monthlyFee*4)*$waiver)/100);
                
                $total = $waivedMonthlyFee;
                
                foreach ($model as $item):?>
                <tr>
                    
                                    <td width="20%">
                                        <?php echo $item['moduleCode']; ?>
                                    </td>
                                    <td width="40%">
                                        <?php echo $item['mod_name']; ?>
                                    </td>
                                    
                                    
                                    <td width="20%">
                                        <?php echo $item['batchName']. FormUtil::getBatchNameSufix($item['batchName']). " ".$item['sectionName']."<strong>".(strtolower($item['reg_status'])=='retake'?' (Re)':'')."</strong>"; ?>
                                    </td>
                                    
                                  
                                    <td width="20%">
                                        
                                        
                                        <?php
                                        
                                        
                                        
                                        //echo $totalCreditFee;
                                        
                                        if(strtolower($item['reg_status'])=='retake')
                                        {
                                            
                                            
                                        $waiver2 = FormUtil::getWaiverByStudentID2(yii::app()->session['studentID'],$item['offeredModuleID']);
                                        //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                                        $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                                        $totalCreditFee = $creditFee * $item['mod_creditHour'];
                                        $waiverAmount=($totalCreditFee*$waiver2)/100 ;
                                        $afterWaived= $totalCreditFee-$waiverAmount;
                                            
                                            echo '( '.$item['mod_creditHour'].' * '.$creditFee.'  = '. $totalCreditFee.' ) - '. $waiverAmount.'  = '.$afterWaived;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            //$total = $total + $afterWaived;
                                        }
                                        else
                                        {
                                            echo "N/A";
                                        }
                                         
                                        ?>
                                    </td>
                                    
                                
                    
                </tr>
                
                <?php endforeach; ?>
                <tr>
                    <td width="80%">
                        
                        Total Extra Credit Fees
                    </td>
                    
                    <td width="20%">
                        
                        <?php  echo $subTotal.' /-'; ?>
                    </td>
                    
                 </tr>    
                 <tr>
                    <td width="30%">
                        
                        Total monthly fee
                    </td>
                    
                    <td width="50%">
                        
                        <?php  echo '( '.$totalCredit.' * '.$creditFee.' )/'.$totalMonth.' = '.$monthlyFee.' * 4'; ?>
                    </td>
                    <td width="20%">
                        <?php 
                        echo '= '.($monthlyFee*4).' /-';
                        ?>
                    </td>
                 </tr>
                 <tr>
                    <td >
                        
                        Waiver
                    </td>
                    <td width="50%">
                      ** no waiver will be calculated for retake course
                    </td>
                    <td >
                        
                        <?php  echo '- '.$waiver.'% '; ?>
                    </td>
                    
                 </tr>
                 <tr>
                    <td width="30%">
                        
                        After Waiver Monthly Fees
                    </td>
                    <td width="50%">
                        <?php  echo '( '.($total/4).' + '.($total/4).' + '.($total/4).' + '.($total/4).' )'; ?>
                    </td>
                    <td width="20%">
                        
                        <?php  echo $total.' /-'; ?>
                    </td>
                    
                 </tr>
                 <tr>
                    <td width="80%">
                        
                        Semester / Term Fee
                    </td>
                    
                    <td width="20%">
                        
                        <?php   echo $termFees= FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID'],'Semester Fee').' /-'; ?>
                    </td>
                    
                 </tr>
                 <?php 
                 
                // echo FormUtil::getTermNumberByStudentID(yii::app()->session['studentID'], yii::app()->session['traTermMod'],yii::app()->session['traYearMod']);
                 
                 if( $feeFlagAdd = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID'],1)):?>
                 <tr>
                    <td width="80%">
                        
                        Admission Fee
                    </td>
                    
                    <td width="20%">
                        
                        <?php   echo $admissionFees = FormUtil::getFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],'Admission Fee').' /-'; ?>
                    </td>
                    
                 </tr>
                 <?php endif; ?>
                 <tr>
                    <td width="80%">
                        
                        Net Payable
                    </td>
                    
                    <td width="20%">
                        
                        <?php   
                             $feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID']);
                                
                               echo ((float)$feeFlag?(float)$total:0)+(float)$subTotal+((float)$feeFlagAdd?(float)$admissionFees:0)+((float)$feeFlag?(float)$termFees:0).'/-'; ?>
                    </td>
                    
                 </tr>
            </tbody>
        </table>
   
</div>  
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
<!--  ----------------Office Copy-------------------------------- !-->


<br></br>
<br></br>
<br></br>

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

 <div class="span-24 title" style="font-size: 20px; padding-bottom: 20px;">Payment Method: <span class="label label-warning" style=""> Monthly Basis</span></div>
    
    
  
        <table border="1"  style="font-size:23px; text-align: left;">
       <thead>

                                <tr>
                                    <!--th>
                                        Head
                                    </th-->
                                    <th width="20%">
                                        Code
                                    </th >
                                    <th width="40%">
                                        Title
                                    </th>
                                    
                                    
                                    <th width="20%">
                                        Batch
                                    </th>
                                   
                                    
                                    
                                    <th width="20%">
                                        Amount
                                    </th>
                                </tr>
                            </thead>
            <tbody>
      
                <?php 
                $total=0; 
                $subTotal=0;
                $admissionFees=0;
                $termFees=0;
                $totalMonth =FormUtil::getMonthByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $waiver = FormUtil::getWaiverByStudentID2(yii::app()->session['studentID']);
                //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $creditFee = FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID']);
                $totalCredit = FormUtil::getCreditHourByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                $monthlyFee = round(($creditFee*$totalCredit)/$totalMonth);
                $waivedMonthlyFee = $monthlyFee*4 -((($monthlyFee*4)*$waiver)/100);
                
                $total = $waivedMonthlyFee;
                
                foreach ($model as $item):?>
                <tr>
                    
                                    <td width="20%">
                                        <?php echo $item['moduleCode']; ?>
                                    </td>
                                    <td width="40%">
                                        <?php echo $item['mod_name']; ?>
                                    </td>
                                    
                                    
                                    <td width="20%">
                                        <?php echo $item['batchName']. FormUtil::getBatchNameSufix($item['batchName']). " ".$item['sectionName']."<strong>".(strtolower($item['reg_status'])=='retake'?' (Re)':'')."</strong>"; ?>
                                    </td>
                                    
                                  
                                    <td width="20%">
                                        
                                        
                                        <?php
                                        
                                        
                                        
                                        //echo $totalCreditFee;
                                        
                                        if(strtolower($item['reg_status'])=='retake')
                                        {
                                            
                                            
                                        $waiver2 = FormUtil::getWaiverByStudentID2(yii::app()->session['studentID'],$item['offeredModuleID']);
                                        //$creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode']);
                                        $totalCreditFee = $creditFee * $item['mod_creditHour'];
                                        $waiverAmount=($totalCreditFee*$waiver2)/100 ;
                                        $afterWaived= $totalCreditFee-$waiverAmount;
                                            
                                            echo '( '.$item['mod_creditHour'].' * '.$creditFee.'  = '. $totalCreditFee.' ) - '. $waiverAmount.'  = '.$afterWaived;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            //$total = $total + $afterWaived;
                                        }
                                        else
                                        {
                                            echo "N/A";
                                        }
                                         
                                        ?>
                                    </td>
                                    
                                
                    
                </tr>
                
                <?php endforeach; ?>
                <tr>
                    <td width="80%">
                        
                        Total Extra Credit Fees
                    </td>
                    
                    <td width="20%">
                        
                        <?php  echo $subTotal.' /-'; ?>
                    </td>
                    
                 </tr>    
                 <tr>
                    <td width="30%">
                        
                        Total monthly fee
                    </td>
                    
                    <td width="50%">
                        
                        <?php  echo '( '.$totalCredit.' * '.$creditFee.' )/'.$totalMonth.' = '.$monthlyFee.' * 4'; ?>
                    </td>
                    <td width="20%">
                        <?php 
                        echo '= '.($monthlyFee*4).' /-';
                        ?>
                    </td>
                 </tr>
                 <tr>
                    <td >
                        
                        Waiver
                    </td>
                    <td width="50%">
                      ** no waiver will be calculated for retake course
                    </td>
                    <td >
                        
                        <?php  echo '- '.$waiver.'% '; ?>
                    </td>
                    
                 </tr>
                 <tr>
                    <td width="30%">
                        
                        After Waiver Monthly Fees
                    </td>
                    <td width="50%">
                        <?php  echo '( '.($total/4).' + '.($total/4).' + '.($total/4).' + '.($total/4).' )'; ?>
                    </td>
                    <td width="20%">
                        
                        <?php  echo $total.' /-'; ?>
                    </td>
                    
                 </tr>
                 <tr>
                    <td width="80%">
                        
                        Semester / Term Fee
                    </td>
                    
                    <td width="20%">
                        
                        <?php   echo $termFees= FormUtil::getCreditFeesByStudentID(yii::app()->session['studentID'],'Semester Fee').' /-'; ?>
                    </td>
                    
                 </tr>
                 <?php 
                 
                // echo FormUtil::getTermNumberByStudentID(yii::app()->session['studentID'], yii::app()->session['traTermMod'],yii::app()->session['traYearMod']);
                 
                 if( $feeFlagAdd = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID'],1)):?>
                 <tr>
                    <td width="80%">
                        
                        Admission Fee
                    </td>
                    
                    <td width="20%">
                        
                        <?php   echo $admissionFees = FormUtil::getFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],'Admission Fee').' /-'; ?>
                    </td>
                    
                 </tr>
                 <?php endif; ?>
                 <tr>
                    <td width="80%">
                        
                        Net Payable
                    </td>
                    
                    <td width="20%">
                        
                        <?php   
                             $feeFlag = FormUtil::getFeeFlagByStudentID(yii::app()->session['studentID']);
                                
                               echo ((float)$feeFlag?(float)$total:0)+(float)$subTotal+((float)$feeFlagAdd?(float)$admissionFees:0)+((float)$feeFlag?(float)$termFees:0).'/-'; ?>
                    </td>
                    
                 </tr>
            </tbody>
        </table>
   
</div>  
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