
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



<table border="1"  style="font-size:23px; text-align: left;">
    <thead>
         <tr>
            <th width="10%"><strong>Head</strong></th>
            <th width="10%"><strong>Course Code</strong></th>
            <th width="30%"><strong>Course Title</strong></th>
            <th width="10%"><strong>Credit hour</strong></th>
            <th width="10%"><strong>Section</strong></th>            
            <th width="20%"><strong>Routine</strong></th>            
            <th width="20%"><strong>Amnt.</strong></th>
        </tr>    
    </thead>
    
    <tbody>
      <?php
      
        foreach ($rows as $row):
      
          ?>
      
        <tr>
             <td width="10%"><?php echo 'Tuttion Fees'; ?></td>
             <td width="10%"><?php echo $row['moduleCode']; ?></td>
             <td width="30%"><?php echo $row['mod_name']; ?></td>
             <td width="10%"><?php echo $row['mod_creditHour']; ?></td>
             <td width="10%"><?php echo $row['sectionName']; ?></td>
             <th width="20%">
                 <?php $rou = Routine::model()->findAllByAttributes(array('offeredModuleID'=>$row['offeredModuleID'])); ?>
                 <?php foreach ($rou as $item2):?>
                              
                 <?php echo $item2['timeSlotCode'].','.$item2['roomCode']; ?>
                                      
                <?php endforeach;?>
                 
             </th>            
             <td  width="20%"> <?php  
                 $creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],$row['mod_creditHour']);
                                            $totalCreditFee = $creditFee * $row['mod_creditHour'];
                                           
                                            $waiver = FormUtil::getWaiverByStudentID(yii::app()->session['studentID'],$row['offeredModuleID']);
                                           
                                            $waiverAmount=($totalCreditFee*$waiver)/100 ;
                                            $afterWaived= $totalCreditFee-$waiverAmount;
                                            
                                         
                                            echo  $totalCreditFee;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            $total = $total + $afterWaived;
                                            
                ?>             
             </td>
             
        </tr>
       <?php endforeach;?>
    </tbody>
    
</table>

<table border="0"  style="font-size:23px; text-align: right;">
   <thead>
       <tr>            
            <th width="90%"><strong>Total Amount</strong></th>
            <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $subTotal; ?></strong></th>
         </tr>  
         <tr>            
            <th width="90%"><strong>Waiver</strong></th>
            <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $waiver.'%'; ?></strong></th>
         </tr>    
         <tr>
            <th width="90%"><strong>After Waived Total Payable</strong></th>
            <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $total;  ?></strong></th>
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


<br></br>

<table border="1"  style="font-size:23px; text-align: left;">
    <thead>
         <tr>
            <th width="10%"><strong>Head</strong></th>
            <th width="10%"><strong>Course Code</strong></th>
            <th width="30%"><strong>Course Title</strong></th>
            <th width="10%"><strong>Credit hour</strong></th>
            <th width="10%"><strong>Section</strong></th>            
            <th width="20%"><strong>Routine</strong></th>            
            <th width="20%"><strong>Amnt.</strong></th>
        </tr>    
    </thead>
    
    <tbody>
      <?php
      $total=0; 
                $subTotal=0;
                $admissionFees=0;
                $termFees=0;
                $waiver =0;
                $creditFee=0;
        foreach ($rows as $row):
      
          ?>
      
        <tr>
             <td width="10%"><?php echo 'Tuttion Fees'; ?></td>
             <td width="10%"><?php echo $row['moduleCode']; ?></td>
             <td width="30%"><?php echo $row['mod_name']; ?></td>
             <td width="10%"><?php echo $row['mod_creditHour']; ?></td>
             <td width="10%"><?php echo $row['sectionName']; ?></td>
             <th width="20%">
                 <?php $rou = Routine::model()->findAllByAttributes(array('offeredModuleID'=>$row['offeredModuleID'])); ?>
                 <?php foreach ($rou as $item2):?>
                              
                 <?php echo $item2['timeSlotCode'].','.$item2['roomCode']; ?>
                                      
                <?php endforeach;?>
                 
             </th>            
             <td  width="20%"> <?php  
                    $creditFee = FormUtil::getCreditFeesByBatch(yii::app()->session['batName'],yii::app()->session['proCode'],$row['mod_creditHour']);
                                            $totalCreditFee = $creditFee * $row['mod_creditHour'];
                                           
                                            $waiver = FormUtil::getWaiverByStudentID(yii::app()->session['studentID'],$row['offeredModuleID']);
                                           
                                            $waiverAmount=($totalCreditFee*$waiver)/100 ;
                                            $afterWaived= $totalCreditFee-$waiverAmount;
                                            
                                         
                                            echo  $totalCreditFee;
                                            $subTotal = $subTotal + $totalCreditFee;
                                            
                                            $total = $total + $afterWaived;
                           
                ?>             
             </td>
             
        </tr>
       <?php endforeach;?>
    </tbody>
    
</table>

<table border="0"  style="font-size:23px; text-align: right;">
   <thead>
       <tr>            
            <th width="90%"><strong>Total Amount</strong></th>
            <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $subTotal; ?></strong></th>
         </tr>  
         <tr>            
            <th width="90%"><strong>Waiver</strong></th>
            <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $waiver.'%'; ?></strong></th>
         </tr>    
         <tr>
            <th width="90%"><strong>After Waived Total Payable</strong></th>
            <th width="20%" style="font-size:25px; text-align: left;"><strong><?php echo $total; ?></strong></th>
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


