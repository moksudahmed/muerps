<?php
//$data = FormUtil::countCompletedCredit(yii::app()->session['trnsStudentID']);
//$credit_complete_this_uni = $credits[0]['sum'] - $credit_exemption;
?>
<table border="0"  style="font-size:30px; text-align: left;">
   <thead>
        <tr colspan ="1" >
            <th><strong>Total credit hours required for the degree: <?php echo $headerData[0]['syl_maxCreditHour']?></strong></th>
         </tr>
         <?php if ($credit_exemption > 0){?>
         <tr colspan ="1" >
            <th><strong>Credit exempted: <?php echo $credit_exemption ?></strong></th>
         </tr>
         <?php }?>
         <tr colspan ="1" >
            <th><strong>Credit completed in this University: <?php echo $credits[0]['sum']- $credit_exemption ?></strong></th>
         </tr>
         <?php if($status == 'Complete') {?>
        <tr colspan ="1" >
                <th><strong>CGPA: <?php echo $rows[0]['cgpa']?></strong></th>
         </tr>       
	
      
         <tr colspan ="1" >
                <th><strong>Grade: <?php echo $rows[0]['grade']?></strong></th>
         </tr>
         <?php }?>
        <tr colspan ="1" >
            <th><strong>Issued at Sylhet, Bangladesh.</strong></th>                
         </tr>
                     	
    </thead>
</table>
